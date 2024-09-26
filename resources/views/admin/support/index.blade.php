@extends('layouts.admin.app', [
    'title' => 'Support Tickets'
])

@section('contents')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ __("Support Tickets") }}</h4>
                    <div class="card-header-action"></div>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-primary btn-icon icon-left btn-lg btn-block mb-4 d-md-none" data-toggle-slide="#ticket-items">
                        <i class="fas fa-list"></i> {{ __("All Tickets") }}
                    </a>
                    @if($supports->count() > 0)
                        <div class="tickets">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="ticket-items" id="ticket-items">
                                        @foreach($supports as $support)
                                            @if($loop->first)
                                                @php
                                                    $firstID = $support->id;
                                                @endphp
                                            @endif
                                            <div @class(['d-flex align-items-center ticket-item mb-2 rounded-2', 'active' => $loop->first]) data-id="{{ $support->id }}">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset($user->avatar ?? 'assets/img/avatars/default-user.jpg') }}" class="rounded-circle table-image" alt="user-image">
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
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="ticket-content" id="getTicket">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="shadow-sm rounded-2 p-2">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-sm-7 ticket-header">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <img src="{{ asset($supports[0]->user->avatar ?? 'assets/img/avatars/default-user.jpg') }}" class="rounded-2" alt="image" width="70px" height="70px">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6>
                                                                        {{ str($supports[0]->subject)->words() }}
                                                                        @if($supports[0]->priority == 'High')
                                                                        <span class="badge bg-label-danger float-end">{{ $supports[0]->priority }}</span>
                                                                        @elseif($supports[0]->priority == 'Medium')
                                                                            <span class="badge bg-label-warning float-end">{{ $supports[0]->priority }}</span>
                                                                        @else
                                                                            <span class="badge bg-label-primary float-end">{{ $supports[0]->priority }}</span>
                                                                        @endif
                                                                    </h6>
                                                                    <div class="ticket-title d-flex justify-content-between">
                                                                        <h6 class="mb-0">{{ $supports[0]->user->name }}</h6>
                                                                        <p class="mb-0">{{ \Carbon\Carbon::parse($supports[0]->created_at)->diffForHumans() }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="status">{{ __("Ticket Status") }}</label>
                                                            <select name="status" id="status" data-id="{{ $supports[0]->id }}" class="form-control">
                                                                <option value="1" @selected($supports[0]->status)>{{ __("Open") }}</option>
                                                                <option value="0" @selected(!$supports[0]->status)>{{ __("Closed") }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ticket-description mb-5 mt-4">
                                            <ul class="list-unstyled">
                                                <li>{{ __("Ticket Number: :number", ['number' => $supports[0]->ticket_no] ) }}</li>
                                                <li>{{ __("Reference Code: :code", ['code' => $supports[0]->reference_code] ) }}</li>
                                            </ul>

                                            <div class="mb-5">
                                                <h5>{{ __("Details") }}</h5>
                                                {{ $supports[0]->details }}
                                            </div>

                                            @if($supports[0]->images ?? false)
                                                <h5>{{ __("Attachments") }}</h5>
                                                <div class="gallery">
                                                    @foreach($supports[0]->images ?? [] as $image)
                                                    <a target="_blank" href="{{ asset($image) }}">
                                                        <img src="{{ asset($image) }}" class="table-image" alt="{{ $supports[0]->subject }}">
                                                    </a>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="ticket-divider"></div>

                                            <div class="ticket-form mt-4">
                                                <form action="{{ route('admin.supports.reply', $firstID) }}" method="post" class="replyForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <textarea name="reply" class="form-control" placeholder="{{ __("Type a reply ...") }}" required></textarea>
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

                                            <div id="replies">
                                                @foreach($replies as $reply)
                                                    @include('admin.support.reply', compact('reply'))
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{ __("No support tickets found!") }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="support_status_url" value="{{ route('admin.supports.update-status') }}">
    <input type="hidden" id="support_get_ticket_url" value="{{ route('admin.supports.get-ticket') }}">
@endsection

@push('js')
    <script src="{{ asset('assets/js/support.js') }}"></script>
@endpush
