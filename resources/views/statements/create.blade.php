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
    <form name="add-statement-form" id="add-statement-form" method="post" action="{{ url('/statements') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="" required>

            <label for="description">Description</label>
            <textarea style="height: 200px;" name="description" id="description" class="form-control" required></textarea>

            <label for="status_id">Status</label>
            <select name="status_id" id="status_id" class="form-select" required>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>

            <label for="status_details">Status Details</label>
            <textarea style="height: 200px;" name="status_details" id="status_details" class="form-control" required></textarea>

            <!-- <label for="is_public">Public</label>
            <select name="is_public" id="is_public" class="form-select" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select> -->

            <label for="category">Category</label>
            <select name="category[]" id="category" class="form-select" multiple="multiple" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <hr />

            <label for="urls">URLs (one per line)</label>
            <textarea style="height: 200px;" name="urls" id="link" class="form-control" required></textarea>

        </div>
        <button type="submit" class="btn btn-primary">Create Statement</button>

        <script>
            $(document).ready(function() {
                $('#category').multiselect();
            });
        </script>

        @endsection
