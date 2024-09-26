<div class="row">
    <div class="col-12">
        <div class="shadow-sm rounded-2 p-2">
            <div class="row d-flex justify-content-between">
                <div class="col-sm-7 ticket-header">
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
                <div class="col-sm-4 form-group">
                    <label for="status">{{ __("Ticket Status") }}</label>
                    <select name="status" id="status" data-id="{{ $support->id }}" class="form-control">
                        <option value="1" @selected($support->status)>{{ __("Open") }}</option>
                        <option value="0" @selected(!$support->status)>{{ __("Closed") }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ticket-description mb-5 mt-4">
    <ul class="list-unstyled">
        <li>{{ __("Ticket Number: :number", ['number' => $support->ticket_no] ) }}</li>
        <li>{{ __("Reference Code: :code", ['code' => $support->reference_code] ) }}</li>
    </ul>

    <div class="mb-5">
        <h5>{{ __("Details") }}</h5>
        {{ $support->details }}
    </div>

    @if($support->images)
        <h5>{{ __("Attachments") }}</h5>
        <div class="gallery">
            @foreach($support->images as $image)
                <a target="_blank" href="{{ asset($image) }}">
                    <img src="{{ asset($image) }}" class="table-image" alt="{{ $support->subject }}">
                </a>
            @endforeach
        </div>
    @endif

    <div class="ticket-divider"></div>

    <div class="ticket-form mt-4">
        <form action="{{ route('admin.supports.reply', $support->id) }}" method="post" class="replyForm">
            <div class="row">
                <div class="col-12">
                    <textarea name="reply" class="form-control" required placeholder="{{ __("Type a reply ...") }}"></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="reset" class="btn btn-outline-danger btn-sm mx-1 mt-3">
                        <i class='bx bx-reset'></i>
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary ajax-btn btn-sm mx-1 mt-3">
                        <i class='bx bx-save'></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div id="replies">
        @foreach($replies as $reply)
            @include('admin.support.reply', compact('reply'))
        @endforeach
    </div>
</div>
