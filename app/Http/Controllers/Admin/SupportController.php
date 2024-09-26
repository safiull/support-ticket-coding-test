<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Mail\SendSupportMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function index()
    {
        $supports = Support::with(['meta.sender', 'user'])->latest()->paginate(5);
        $replies = $supports->first() ? $supports->first()->meta()->with('sender')->latest()->limit(10)->get() : [];
        return view('admin.support.index', compact('supports', 'replies'));
    }

    public function getSupport(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:supports'],
        ]);

        $support = Support::findOrFail($request->input('id'));
        $support->load('meta.sender:id,name,avatar');
        $replies = $support->meta()->with('sender')->latest()->limit(10)->get();

        return view('admin.support.ticket', compact('support', 'replies'))->render();
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:supports'],
            'status' => ['boolean'],
        ]);

        $support = Support::findOrFail($request->input('id'));
        $status = $request->input('status');
        $support->update([
            'status' => $status,
        ]);

        if (!$status) {
            $data = [
                'title' => "Your support ticket has been closed",
                'url' => route('customer.supports.index'),
                'subject' => "Support closed",
            ];

            if (env('QUEUE_MAIL')) {
                Mail::to(auth()->user()->email)->queue(new SendSupportMail($data));
            } else {
                Mail::to(auth()->user()->email)->send(new SendSupportMail($data));
            }
        }

        return response()->json([
            'message' => __("Support has been :status", ['status' => $status ? __('opened') : __('closed')]),
        ]);
    }

    public function reply(Request $request, Support $support)
    {
        $request->validate([
            'reply' => ['required', 'string'],
        ]);

        $reply = $support->meta()->create([
            'type' => 1,
            'comment' => $request->input('reply'),
            'sender_id' => Auth::id(),
        ]);

        $reply = view('admin.support.reply', compact('reply'))->render();

        return response()->json([
            'message' => __('Reply sent successfully'),
            'reply' => $reply,
        ]);
    }
}
