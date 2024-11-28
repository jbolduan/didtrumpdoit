@php use App\Enums\UserLevel; @endphp

@extends('layouts.app')

@section('content')

@session('success')
<div class="alert alert-success">
    {{ $value }}
</div>
@endsession

<!-- If there are creation errors, they will show here -->
@if($errors->any())
<div class="alert alert-danger">
    <b>Error</b>: Please fix the following errors
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2>Change User Level</h2>

<div class="content">
    <h3>{{ $user->name }}</h3>
    <p>Update the user level of {{ $user->level }}</p>
    <form method="post" action="{{ route('userlevels.update', $user) }}">
        @csrf
        @method('PUT')
        <label for="level" value="User Level" />
        <select name="level" id="level">
            @foreach(UserLevel::cases() as $levelOption)
            <option value="{{ $levelOption }}" @if ($levelOption==$user->level) selected="selected" @endif>
                {{$levelOption->name}}
            </option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Update User Level</button>
    </form>
</div>

@endsection
