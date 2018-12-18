@extends('layouts.app')

@section('extraHead')
<link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}">
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="contentSeg" >
			<div class="pp">
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
               	        <a href="{{ url('/profile') }}">Profile</a>
                        <button type="submit" class="btn btn-primary">Brands</button>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form class="form-horizontal" action="{{ route('updateFollowBrand') }}" method="post">
                                {{ csrf_field() }}

                                @foreach ($brands as $cat)
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ $cat->name }}</label>

                                        <div class="col-md-6">
                                            <input type="checkbox" class="form-control" name="{{ 'cat'.$cat->id }}" {{ in_array($cat->id, $followed_ids) ? 'checked' : '' }}>Following
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                   
            </div>
        </div>
    </div>
</div>
@endsection