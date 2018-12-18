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
            			<td>Brand ID</td>
            			<td>Brand Name</td>
            			<td colspan="2">Auth</td>
            		</tr>
            		@foreach($brands as $brand)
                    <tr>
                        <td><div class="post" >{{ $brand->id }}</div></td>
                        <td>{{ $brand->name }}</td>
                        <td><a href="{{ route('edit_brand', [$brand->id]) }}">Edit</a></td>
                        <td>
                            <form id="delete-brand" action="{{ route('delete_brand', [$brand]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" name="button_submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>         
                
                <div class="container">
                    <form action="{{route('add_brand')}}" method="GET">
                        <button type="submit">ADD</button>
                    </form>
                </div>
                
            </div>

        </div>
    </div>
@endsection