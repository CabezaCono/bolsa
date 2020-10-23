@if (Session::has('message'))
    <div class="alert alert-success" style="margin-top: 65px;">
        <strong>{{ Session::get('message') }}</strong>
    </div>
@endif