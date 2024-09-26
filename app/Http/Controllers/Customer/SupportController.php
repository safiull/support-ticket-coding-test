<?php

namespace App\Http\Controllers\Customer;

use App\Models\Support;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Mail\SendSupportMail;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    use HasUploader;

    public function index()
    {
        $tickets = Support::whereUserId(auth()->id())->latest()->paginate();
        return view('customer.supports.index', compact('tickets'));
    }

    public function create()
    {
        return view('customer.supports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'reference_code' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', Rule::in(['Low', 'Medium', 'High'])],
            'details' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'array'],
            'image.*' => ['nullable', 'image', 'max:2048'], // Each image 2MB
        ]);

        $images = [];
        foreach ($request->image ?? [] as $key => $image) {
            $images[] = $this->upload($request, 'image.' . $key);
        }

        Support::create([
            'images' => $images,
            'user_id' => auth()->id(),
        ] + $validated);

        $data = [
            'title' => "New support ticket created",
            'message' => "Title: {$request->subject}",
            'url' => route('admin.supports.index'),
            'subject' => "Support Ticket Created",
        ];

        if (env('QUEUE_MAIL')) {
            Mail::to(auth()->user()->email)->queue(new SendSupportMail($data));
        } else {
            Mail::to(auth()->user()->email)->send(new SendSupportMail($data));
        }

        return response()->json([
            'message' => __('Support Ticket Created Successfully'),
            'redirect' => route('customer.supports.index'),
        ]);
    }

    public function show(Support $support)
    {
        abort_if($support->user_id !== auth()->id(), 404);
        $support->load('meta.sender:id,name,avatar');
        $replies = $support->meta()->with('sender')->latest()->limit(10)->get();

        return view('customer.supports.show', compact('support', 'replies'));
    }

    public function update(Request $request, Support $support)
    {
        if (!$support->status) {
            return $request->wantsJson() ?
            response()->json([
                'message' => __('Ticket status has been closed'),
                'redirect' => route('customer.supports.show', $support->id),
            ], 403)
            : to_route('customer.supports.show', $support->id)->with('error', __('Ticket status has been closed'));
        }

        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $reply = $support->meta()->create([
            'type' => 0,
            'sender_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        $reply = view('customer.supports.reply', compact('reply'))->render();

        return response()->json([
            'message' => __('Reply sent successfully'),
            'reply' => $reply,
        ]);
    }

    public function destroy(Support $support)
    {
        abort_if($support->user_id !== auth()->id(), 404);
        $support->delete();

        return redirect()->back()->with('success', __('Ticket Deleted Successfully'));
    }
}
