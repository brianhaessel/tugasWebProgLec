@extends('layouts.app')

@section('extraHead')
<!-- <link rel="icon" href="images/ProjectHCI_64x64_Logo.png"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/gallery.css') }}">
@endsection


@section('content')
<div class="container">
	<div class="postDet">
		<h3>{{ $post->user->name }}</h3>
		@auth
			@if (Gate::check('isAdmin') || Auth::id() !== $post->user_id)
				@if (!in_array($post->id, session()->get('id', [])))
					<form action="{{ route('addToCart', [$post->id]) }}" method="post">
						{{ csrf_field() }}
						<button type="submit">Add to Cart</button>
					</form>
				@else
					Added to cart
				@endif
			@endif
			@if (Gate::check('isAdmin') || Auth::id() === $post->user_id)
				<form action="{{ route('delete', [$post]) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit">Delete Post</button>
				</form>
			@endif
		@endauth

		<h2>{{ $post->title }}</h3>
		<p>{{ $post->brand->name }}</p>
		<div class="postImage">
			<img src="{{ url('/storage/'.$post->image) }}" />
		</div>
		<p>{{ $post->caption }}</p>
		@auth
			<p><b>Comment</b></p>
			@foreach($post_comments as $comment)
				<div class="comment">
					<div class="commenterPP">
						<img src="{{ url('/storage/'.$comment->user->profile_picture) }}" width="32" height="32" class="pp">
						<b>{{ $comment->user->name }}</b>
					</div>
				
					<p>{{ $comment->comment}}</p>
				</div>
			@endforeach
			<p>{{'Add your comment...'}}</p>
			<form action="{{ url('/addComment') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<textarea class="form-control" name="comment" style="width: 100%;" required></textarea>

				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<button type="submit" class="btn btn-primary">
					Submit
				</button>
			</form>
		@endauth
	</div>
</div>
@endsection
