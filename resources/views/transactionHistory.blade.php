@extends('layouts.app')

@section('extraHead')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (Route::currentRouteName() == 'all_transaction')
                    <h1>All Transactions</h1>
                @endif
                @foreach ($transactions as $transaction)
                    <div class="perTransaction">
                        <p>
                            Transaction ID: {{ $transaction->id }}<br>
                            Buyer: {{ $transaction->user->name }}<br>
                            Total Price: {{ $transaction->posts->sum('price') }}<br>
                            Transaction Date: {{ $transaction->transaction_date }}
                        </p>
                        <table class="fullTable">
                            <tr class="tablenHeader">
                                <td>Image</td>
                                <td>Name</td>
                                <td>Price</td>
                            </tr>
                            @foreach ($transaction->posts as $post)
                                <tr>
                                    <td>
                                        <img src="{{ url('/storage/'.$post->image) }}" width="128" height="128">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->price }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endforeach
                <div class="contentSeg">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection