@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}" align="center" style="margin-bottom: 0px;">
        {{ Session::get('flash_notification.message') }}
    </div>
@endif