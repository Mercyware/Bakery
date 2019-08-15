<div class="form-group">
    @if(count($errors))

        <div class="callout-danger callout">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
