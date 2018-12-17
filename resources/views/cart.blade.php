@extends('layouts.app')

@section('content')



<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                    @endif

                                    <p>You are logged in!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

    <div class="container">
        <div class="row">
            <!-- <a href="{{ url('/home') }}">Filter by My Followed Categories</a> -->
            <div class="contentSeg" id="postSection" >
                Items in cart: {{ $posts->count() }}
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
        <!-- <a href="{{ url('/home') }}">Filter by My Followed Categories</a> -->
            <div class="contentSeg" id="postSection" >
                @foreach ($posts as $post)
                    <div style="padding: 4px; display:block;">
                        <img src="{{ url('/storage/'.$post->image) }}" width="128" height="128">
                        <div>
                            Title: {{ $post->title }}<br>
                            Price: {{ $post->price }}<br>
                            Owner: {{ $post->user->name }}<br>
                            <form action="{{ route('removeFromCart', [$post->id]) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            Total Price: Rp. {{ $posts->sum('price') }}
            <form action="{{ route('checkout') }}" method="post">
                {{ csrf_field() }}
                <button type="submit">Checkout</button>
            </form>
        </div>
    </div>
@endsection
