@if ($flash = session('message'))
    <div id="flash-message" class="callout callout-success" role="alert">
        {{$flash}}

    </div>


@endif

@if ($flash = session('error'))
    <div id="flash-message" class="callout callout-danger" role="alert">
        {{$flash}}

    </div>


@endif