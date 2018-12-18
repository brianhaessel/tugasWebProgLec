@extends('layouts.app')

@section('extraHead')
<link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}">
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="contentSeg" >
			<div>
                @if (Route::currentRouteName() == 'profile')
                    <table class="profileTable">
                        <tr>
                            <td rowspan="2">
                                <img src="{{ url('/storage/'.$user->profile_picture) }}" width="256" height="256" class="pp"/>
                            </td>
                            <td><h1>{{ $user->name }}</h1></td>
                        </tr>
                        <tr>
                                <td><h3>{{ $user->email }}</h3></td>
                        </tr>
                    </table>
                    <br><br>
                    <div class="container">
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Profile</button> <a href="{{ url('/followedBrands') }}">Brands</a>
                        </div>
                    </div>
                @elseif (Route::currentRouteName() == 'edit_user')
                    <h1>Personal Data</h1>
                    <img src="{{ url('/storage/'.$user->profile_picture) }}" width="256" height="256" class="pp"/>
                @endif
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (Route::currentRouteName() == 'profile')
                <form class="form-horizontal" method="POST" action="{{ route('updateProfile') }}">
            @elseif (Route::currentRouteName() == 'edit_user')
                <form class="form-horizontal" method="POST" action="{{ route('updateProfileAdmin', [$user]) }}">
            @endif
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                    <label for="id" class="col-md-4 control-label">ID : </label>

                    <div class="col-md-6">
                        <input type="text" name="" class="form-control" value="{{$user->id}}" disabled>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name : </label>

                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                   
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Email : </label>

                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" value="{{$user->email}}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if (Route::currentRouteName() == 'profile')
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password : </label>

                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control" value="{{$user->password}}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">Gender</label>

                    <div class="col-md-6">
                        <select name="gender" class="form-control" placeholder="Select one">
                            <option value="Male" {{ $user->gender == 'Male' ? 'selected="selected"' : '' }}>Male</option>
                            <option value="Female" {{ $user->gender == 'Female' ? 'selected="selected"' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" name="button_submit" class="btn btn-primary" value="save">
                            Save Changes
                        </button>
                        <button type="submit" name="button_submit" class="btn btn-primary" value="discard">
                            Discard Changes
                        </button>
                        @if (Route::currentRouteName() == 'edit_user')
                            <button type="submit" name="button_submit" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-user').submit();">
                                Delete User
                            </button>
                        @endif
                    </div>
                </div>
            </form>

            <form id="delete-user" action="{{ route('delete_user', [$user]) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
        </div>
    </div>
</div>
@endsection