<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/ui-toasts.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/validation-setup/validation-setup.js') }}"></script>
<script src="{{ asset('assets/plugins/toastifyjs/toastify.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/notification.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/form.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/custom.js') }}"></script>

@stack('js')

@if(Session::has('message'))
    <script>
        Notify('success', null, "{{ Session::get('message') }}");
    </script>
@endif
@if(Session::has('error'))
    <script>
        Notify('error', null, "{{ Session::get('error') }}");
    </script>
@endif
@if($errors->any())
<script>
    Notify('warning', null, "{{ Session::get('message') }}");
</script>
@endif
