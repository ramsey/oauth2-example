@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    @if ($instagramUser)

                        <h1>Hello, {{{ $instagramUser->getName() }}}</h1>
                        <p>{{{ $instagramUser->getDescription() }}}</p>
                        <p><a href="/forget-instagram">Forget Instagram token</a></p>

                        <h2>Your Instagram Feed</h2>
                        @forelse ($instagramFeed->data as $item)
                            <div style="float: left; padding: 10px;">
                                <a href="{{{ $item->link }}}">
                                    <img src="{{{ $item->images->thumbnail->url }}}">
                                </a>
                            </div>
                        @empty
                            <p>No photos found in feed. Follow some friends in Instagram.</p>
                        @endforelse

                    @else
                        <p>
                            <a href="{{{ $instagramAuthUrl }}}">
                                Click here to authorize with Instagram
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
