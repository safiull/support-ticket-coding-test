@extends('layouts.customer.app', [
    'title' => 'Supports List',
    'buttons' => [['name' => 'Open Ticket', 'link' => route('customer.supports.create'), 'icon' => 'bx bx-plus-circle']],
])

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-sm-6">
                        <h5>Supports List</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." aria-describedby="button-addon2" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class='bx bx-search-alt-2'></i></button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>SL.</th>
                            <th>{{ __("Subject") }}</th>
                            <th>{{ __("Priority") }}</th>
                            <th>{{ __("Type") }}</th>
                            <th>{{ __('Reference') }}</th>
                            <th>{{ __('Details') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __("Created At") }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->priority }}</td>
                                <td>{{ $ticket->type }}</td>
                                <td>{{ $ticket->reference_code }}</td>
                                <td>{{ str($ticket->details)->words(30) }}</td>
                                <td>
                                    @if($ticket->status)
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
                                </td>
                                <td>{{ formatted_date($ticket->created_at) }}</td>
                                <td>
                                    <a href="{{ route('customer.supports.show', $ticket->id) }}" class="btn btn-primary btn-sm">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mx-2 mt-2">
                <div class="col-sm-12">
                    {{ $tickets->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
