@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-info">{{ session('message') }}</div>
@endif

<div class="">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>fa_icon</td>
                <td>Color</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->fa_icon }} <span class="fa {{ $status->fa_icon }}"></span></td>
                <?php
                $bgColor = colority()->fromHex($status->color);
                $textColor = $bgColor->getBestForegroundColor();
                ?>
                <td style="background-color: {{ $bgColor->getValueColor() }}; color: {{ $textColor->getValueColor() }};"><b>{{ $status->color }}</b></td>
                <td>
                    <ul class="list-group list-group-horizontal list-unstyled">
                        <li class="list-group-item-light">
                            <a class="btn btn-small btn-success" href="{{ URL::to('admin/statuses/' . $status->id) }}">View</a>&nbsp;
                        </li>
                        <li class="list-group-item-light">
                            <a class="btn btn-small btn-info" href="{{ URL::to('admin/statuses/' . $status->id . '/edit') }}">Edit</a>&nbsp;
                        </li>
                        <li class="list-group-item-light">
                            <form class="" action="{{ URL::to('admin/statuses/' . $status->id) }}" method="post">
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
