@extends('layouts.app')

@section('content')

<!-- Used to show messages -->
@if (session('message'))
<div class="alert alert-info">{{ session('message') }}</div>
@endif

<div class="">
    <table class="table table-striped table-bordered">
        <thead>
            <td>id</td>
            <td>title</td>
            <td>description</td>
            <td>status</td>
            <td>status details</td>
            <td>categories</td>
            <td>statement urls</td>
            <td>Is Public?</td>
            <td>URLs</td>
            <td>Actions</td>
        </thead>
        <tbody>
            @foreach($statements as $statement)
            <?php $username = $statement->user->username ?? 'N/A'; ?>
            <?php $public = $statement->is_public ? 'Yes' : 'No'; ?>

            <tr>
                <td>{{ $statement->id }}</td>
                <td>{{ $statement->title }}</td>
                <td>
                    @if(strlen($statement->description) > 250)
                    {{ substr($statement->description, 0, 250) }}...
                    @else
                    {{ $statement->description }}
                    @endif
                </td>
                <?php
                $bgColor = colority()->fromHex($statement->status->color);
                $textColor = $bgColor->getBestForegroundColor();
                ?>
                <td style="background-color: {{ $bgColor->getValueColor() }}; color: {{ $textColor->getValueColor() }};">{{ $statement->status->name }}</td>
                <td>
                    @if(strlen($statement->status_details) > 250)
                    {{ substr($statement->status_details, 0, 250) }}...
                    @else
                    {{ $statement->status_details }}
                    @endif
                </td>
                <td>
                    @if($statement->category->count() > 0)
                    @foreach($statement->category as $category)
                    <?php
                    $bgColor = colority()->fromHex($category->color);
                    $textColor = $bgColor->getBestForegroundColor();
                    ?>
                    <span class="badge rounded-pill" style="background-color: {{ $bgColor->getValueColor() }}; color: {{ $textColor->getValueColor() }};">{{ $category->name }}</span>
                    @endforeach
                    @else
                    <span class="badge rounded-pill bg-secondary">N/A</span>
                    @endif
                </td>
                <td>{{ $username }}</td>
                <td>{{ $public }}</td>
                <td>
                    <?php
                    $urls = array_filter(preg_split("/\r\n|\n|\r/", $statement->urls));
                    $urlsCount = count($urls);
                    ?>
                    @if($urlsCount > 0)
                    <?php $counter = 0; ?>
                    @foreach($urls as $link)
                    <sup><a href="{{ $link }}">{{ ($counter + 1) }}</a></sup>
                    <?php $counter++; ?>
                    @endforeach
                    @else
                    N/A
                    @endif
                </td>

                <td>
                    <ul class="list-group list-group-horizontal list-unstyled">
                        <li class="list-group-item-light"><a class="btn btn-small btn-success" href="{{ URL::to('admin/statements/' . $statement->id) }}">View</a></li>&nbsp;
                        <li class="list-group-item-light"><a class="btn btn-small btn-info" href="{{ URL::to('admin/statements/' . $statement->id . '/edit') }}">Edit</a></li>&nbsp;
                        <li class="list-group-item-light">
                            <form class="" action="{{ URL::to('admin/statements/' . $statement->id) }}" method="post">
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
