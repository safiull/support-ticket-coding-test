@extends('layouts.customer.app', [
    'title' => 'View support messages',
    'buttons' => [['name' => 'View List', 'link' => route('customer.supports.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if($support->images)
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="fw-bold">
                                        {{__('Ticket No.') }}
                                        <span class="fw-bold text-dark">#{{ $support->ticket_no }}</span>
                                    </h6>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset($support->user->avatar ?? 'assets/img/avatars/default-user.jpg') }}" class="rounded-2" alt="image" width="70px" height="70px">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>
                                                {{ str($support->subject)->words() }}
                                                @if($support->priority == 'High')
                                                <span class="badge bg-label-danger float-end">{{ $support->priority }}</span>
                                                @elseif($support->priority == 'Medium')
                                                    <span class="badge bg-label-warning float-end">{{ $support->priority }}</span>
                                                @else
                                                    <span class="badge bg-label-primary float-end">{{ $support->priority }}</span>
                                                @endif
                                            </h6>
                                            <div class="ticket-title d-flex justify-content-between">
                                                <h6 class="mb-0">{{ $support->user->name }}</h6>
                                                <p class="mb-0">{{ $support->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h6 class="fw-bold">{{__('Attachments')}}</h6>
                                    <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                                        @foreach($support->images as $image)
                                            <div class="timeline-block">
                                                <span class="timeline-step badge-success">
                                                <i class="fa fa-file"></i>
                                                </span>
                                                <div class="timeline-content">
                                                    <div class="d-flex justify-content-between pt-1">
                                                        <div>
                                                            <a target="_blank" href="{{ asset($image) }}">
                                                                <img src="{{ asset($image) }}" class="table-image" alt="{{ $support->subject }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($support->status)
                <div class="card border-0 mt-4">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col">
                                <h5>{{ __("Reply") }}</h5>
                            </div>
                            <div class="col text-end">
                                @if($support->status)
                                <span class="badge bg-label-primary">
                                    <i class='bx bx-lock-open'></i>
                                    {{ __('Open') }}
                                </span>
                                @else
                                <span class="badge bg-label-danger">
                                    <i class='bx bx-lock'></i>
                                    {{ __('Closed') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('customer.supports.update', $support->id) }}" method="post" class="replyForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <textarea name="comment" class="form-control" required placeholder="{{ __("Type a reply ...") }}"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="reset" class="btn btn-outline-danger btn-sm mx-1 mt-3">
                                        <i class='bx bx-reset'></i>
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm ajax-btn mx-1 mt-3">
                                        <i class='bx bx-save'></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <div class="card border-0 mt-4">
                    <h5 class="card-header ">@lang('Support Messages')</h5>
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <div id="replies">
                                @foreach($replies as $reply)
                                    @include('customer.supports.reply', compact('reply'))
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/support.js') }}"></script>
@endpush
