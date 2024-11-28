@extends('layouts.app')

@section('content')

<h1>Create Category</h1>

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
    <form name="add-category-form" id="add-category-form" method="post" action="{{ url('admin/categories') }}">
        @csrf
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" required>

            <label for="fa_icon">Font Awesome Icon (fa-iconname)</label>
            <input type="text" name="fa_icon" id="fa_icon" class="form-control" placeholder="Enter Font Awesome Icon" required>

            <label for="color">Color</label>
            <input style="height: 50px;" type="color" name="color" id="color" class="form-control" value="#000000" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>


@endsection
