@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('update_categoryy', [$category]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                    <label for="id" class="col-md-4 control-label">ID : </label>

                    <div class="col-md-6">
                        <input type="text" name="" class="form-control" value="{{$category->id}}" disabled>
                    </div>
                </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name : </label>

                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" value="{{$category->name}}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" >
                                    UPDATE
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection