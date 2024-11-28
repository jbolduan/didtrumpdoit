@extends('layouts.app')

@section('content')

<!-- Used to show messages -->
@if (session('message'))
<div class="alert alert-info">{{ session('message') }}</div>
@endif

<div class="">
    <h1>Categories</h1>
    <a class="btn btn-small btn-success" href="{{ URL::to('admin/categories/create') }}">Create</a>
    <table class="table table-striped table-bordered">
        <thead>
            <td>id</td>
            <td>name</td>
            <td>fa_icon</td>
            <td>color</td>
            <td>Actions</td>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->fa_icon }} <span class="fa {{ $category->fa_icon }}"></span></td>
                <?php
                $bgColor = colority()->fromHex($category->color);
                $textColor = $bgColor->getBestForegroundColor();
                ?>
                <td style="background-color: {{ $bgColor->getValueColor() }}; color: {{ $textColor->getValueColor() }};"><b>{{ $category->color }}</b></td>
                <td>
                    <ul class="list-group list-group-horizontal list-unstyled">
                        <li class="list-group-item-light">
                            <a class="btn btn-small btn-success" href="{{ URL::to('admin/categories/' . $category->id) }}">View</a>&nbsp;
                        </li>
                        <li class="list-group-item-light">
                            <a class="btn btn-small btn-info" href="{{ URL::to('admin/categories/' . $category->id . '/edit') }}">Edit</a>&nbsp;
                        </li>
                        <li class="list-group-item-light">
                            <form class="" action="{{ URL::to('admin/categories/' . $category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-small btn-danger" type="submit">Delete</button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
