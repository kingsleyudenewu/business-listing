@if ($message = session('success'))
    @if(is_array($message))
        @foreach( $message as $msg )
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $msg }}</strong>
                @if( !$loop->last )
                    <br>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
@endif


@if ($message = session('error'))
    @if(is_array($message))
        @foreach( $message as $msg )
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $msg }}</strong>
                @if( !$loop->last )
                    <br>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
@endif


@if ($message = session('warning'))
    @if(is_array($message))
        @foreach( $message as $msg )
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $msg }}</strong>
                @if( !$loop->last )
                    <br>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
@endif


@if ($message = session('info'))
    @if(is_array($message))
        @foreach( $message as $msg )
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $msg }}</strong>
                @if( !$loop->last )
                    <br>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif
