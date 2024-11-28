@extends('layouts.app')

@section('content')

<div class="jumbotron text-center">
    <h1 class="display-4">{{ $status->name }}</h1>
    <p class="lead">
        <b>Font Awesome Icon:</b> {{ $status->fa_icon }} <span class="fa {{ $status->fa_icon }}"></span><br />
        <b>Color:</b> {{ $status->color }}
    </p>
</div>

@endsection
