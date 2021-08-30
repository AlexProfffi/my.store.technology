@extends('layouts.app')

@section('title', 'Все категории')

@section('content')
	<div class="container">
		<div class="starter-template">
			@foreach($categories as $category)
				<div class="panel">
					<a href="{{ route('category', $category->slug) }}">
						<img src="http://internet-shop.tmweb.ru/storage/categories/mobile.jpg">
						<h2>{{ $category->name }}</h2>
					</a>
					<p>
						{{ $category->description }}
					</p>
				</div>
			@endforeach
		</div>
	</div>
@endsection