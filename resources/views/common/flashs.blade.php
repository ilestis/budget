@if (count($errors) > 0)
        <!-- Form Error List -->
<div class="alert alert-danger">
    <strong>{{ trans('app.error') }}</strong>

    <br><br>

    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <strong>{{ trans('app.error') }}</strong>

        <br><br>

        {{ trans(session('error')) }}
    </div>
@endif

@if (session('info'))
<div class="alert alert-info">

    {{ trans(session('info')) }}
</div>
@endif

@if (session('success'))
        <!-- Form Error List -->
<div class="alert alert-success">
    {{ trans(session('success')) }}
</div>
@endif