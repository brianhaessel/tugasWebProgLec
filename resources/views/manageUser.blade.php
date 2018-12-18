@extends('layouts.app')

@section('extraHead')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="contentSeg" id="postSection" >
                <table class="fullTable">
                    <tr class="tableHeader">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Gender</td>
                        <td>Auth</td>
                    </tr>
                    @foreach ($users as $user)
                        @if ($user->role != 'admin')
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td><a href="{{ route('edit_user', [$user->id]) }}">Edit</a></td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>

        </div>
    </div>

@endsection