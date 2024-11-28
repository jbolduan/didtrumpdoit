<?php
$statuses = App\Models\Status::all();
$categories = App\Models\Category::all();
?>
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
    <form name="edit-statement-form" id="edit-statement-form" method="post" action="{{ route('admin.statements.update', $statement) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $statement->title }}" required>

            <label for="description">Description</label>
            <textarea style="height: 200px;" name="description" id="description" class="form-control" required>{{ $statement->description }}</textarea>

            <label for="status_id">Status</label>
            <select name="status_id" id="status_id" class="form-select" required>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if($status->id == $statement->status->id) selected @endif>{{ $status->name }}</option>
                @endforeach
            </select>

            <label for="status_details">Status Details</label>
            <textarea style="height: 200px;" name="status_details" id="status_details" class="form-control" required>{{ $statement->status_details }}</textarea>

            <label for="is_public">Public</label>
            <select name="is_public" id="is_public" class="form-select" required>
                <option value="1" @if($statement->is_public) selected @endif>Yes</option>
                <option value="0" @if(!$statement->is_public) selected @endif>No</option>
            </select>

            <label for="category">Category</label>
            <select name="category[]" id="category" class="form-select" multiple="multiple" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @if($statement->category->contains($category->id)) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            <hr />

            <label for="urls">URLs (one per line)</label>
            <textarea style="height: 200px;" name="urls" id="link" class="form-control" required>{{ $statement->urls }}</textarea>

        </div>
        <button type="submit" class="btn btn-primary">Edit Statement</button>

        <script>
            $(document).ready(function() {
                $('#category').multiselect();
            });
        </script>

        @endsection
