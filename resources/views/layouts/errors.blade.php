@if(count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul>
            @if(is_object($errors))
                @foreach($errors->all() as $err)
                    <li>{{$err}}</li>
                @endforeach
            @elseif(is_string($errors))
                <li>{{$errors}}</li>
            @endif
        </ul>
    </div>
@endif