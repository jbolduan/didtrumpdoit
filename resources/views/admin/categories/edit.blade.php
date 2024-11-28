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

<div class="card-body">
    <form name="edit-category-form" id="edit-category-form" method="post" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->name }}" required>

            <label for="fa_icon">Font Awesome Icon (fa-iconname)</label>
            <input type="text" name="fa_icon" id="fa_icon" class="form-control" value="{{ $category->fa_icon }}" required>

            <label for="color">Color</label>
            <input style="height: 50px;" type="color" name="color" id="color" class="form-control" value="{{ $category->color }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit Category</button>
    </form>
</div>
@endsection
