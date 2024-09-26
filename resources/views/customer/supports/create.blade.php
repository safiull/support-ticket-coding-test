@extends('layouts.customer.app', [
    'title' => 'Create new support',
    'buttons' => [['name' => 'View List', 'link' => route('customer.supports.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('customer.supports.store') }}" method="post" class="custom-reload-form">
    @csrf

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h5 class="card-header">@lang('Create new support')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label class="form-label">{{ __("Subject") }}</label>
                            <input type="text" name="subject" class="form-control" placeholder="{{ __("Enter subject") }}" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">{{ __('Reference') }}</label>
                            <input type="text" name="reference_code" class="form-control" placeholder="{{ __("Transaction reference number") }}">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">{{ __("Priority") }}</label>
                            <select class="form-control select" name="priority" required>
                                <option value="Low">{{ __("Low") }}</option>
                                <option value="Medium">{{ __("Medium") }}</option>
                                <option value="High">{{ __("High") }}</option>
                            </select>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label class="form-label">{{ __("Attachments") }}</label>
                            <input type="file" class="form-control" id="customFileLang" name="image[]" accept="image/*" multiple>
                        </div>

                        <div class="mb-2 col-md-12">
                            <label class="form-label">{{ __("Enter Message") }}</label>
                            <textarea name="details" class="form-control" required placeholder="{{ __("Enter Message") }}"></textarea>
                        </div>

                        <div class="col-12 text-center">
                            <button type="reset" class="btn btn-outline-danger mx-1 mt-3"><i class='bx bx-reset'></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary ajax-btn mx-1 mt-3"><i class='bx bx-save'></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
