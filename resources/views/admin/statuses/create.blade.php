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
    <form name="add-status-form" id="add-status-form" method="post" action="{{ url('admin/statuses') }}">
        @csrf
        <div class="form-group">
            <label for="status_name">Status Name</label>
            <input type="text" name="status_name" id="status_name" class="form-control" placeholder="Enter Status Name" required>

            <label for="fa_icon">Font Awesome Icon (fa-iconname)</label>
            <input type="text" name="fa_icon" id="fa_icon" class="form-control" placeholder="Enter Font Awesome Icon" required>

            <label for="status_color">Status Color</label>
            <input style="height: 50px" type="color" name="status_color" id="status_color" class="form-control" placeholder="Enter Status Color" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Status</button>
    </form>
</div>

@endsection
