@php use App\Enums\UserLevel; @endphp
@extends('layouts.app')

@section('content')

<div class="header">
    <h2>Users</h2>
</div>

<div class="body">
    <table class="table table-striped table-bordered">
        <thead>
            <td>id</td>
            <td>username</td>
            <td>email</td>
            <td>Level</td>
            <td>Actions</td>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td><span @class(['p-1 bg-success text-white rounded-pill fw-bold'=> UserLevel::Standard == $user->level, 'p-1 bg-warning text-dark rounded-pill fw-bold'=> UserLevel::Moderator == $user->level, 'p-1 bg-danger text-dark rounded-pill fw-bold'=> UserLevel::Administrator == $user->level])>{{ $user->level->name }}</span></td>
                <td>
                    <ul class="list-group list-group-horizontal list-unstyled">

                        @can('updateLevel', $user)
                        <li class="list-group-item-light"><a class="pt-0 pb-0 btn btn-small btn-primary" href="{{ route('userlevels.edit', $user) }}">Edit</a></li>&nbsp;
                        @endcan

                        @can('delete', $user)
                        <li class="list-group-item-light">
                            <form class="" action="{{ route('users.destroy', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="pt-0 pb-0 btn btn-small btn-danger" type="submit">Delete</button>
                            </form>
                        </li>
                        @endcan
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
