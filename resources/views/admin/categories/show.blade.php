@extends('layouts.app')

@section('content')

<div class="jumbotron text-center">
    <h1 class="display-4">{{ $category->name }}</h1>
    <p class="lead">
        <b>Font Awesome Icon:</b> {{ $category->fa_icon }} <span class="fa {{ $category->fa_icon }}"></span>
    </p>
</div>

@endsection
