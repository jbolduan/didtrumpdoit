@extends('layouts.app')

@section('content')

<div class="h1 text-center">{{ $statement->title }}</div>
<table class="table">
    <tbody>
        <tr>
            <td><b>Statement Description:</b></td>
            <td>{{ $statement->description }}</td>
        </tr>
        <tr>
            <td><b>Statement Status:</b></td>
            <td>{{ $statement->status->name }}</td>
        </tr>
        <tr>
            <td><b>Statement Status Details:</b></td>
            <td>{{ $statement->status_details }}</td>
        </tr>
        <tr>
            <td><b>Categories:</b></td>
            <td>
                @if($statement->category->count() > 0)
                @foreach($statement->category as $category)
                <span class="badge rounded-pill category-pill-{{ $category->id }}">{{ $category->name }}</span>
                @endforeach
                @else
                N/A
                @endif
            </td>
        </tr>
        <tr>
            <td><b>Statement URLs:</b></td>
            <td>
                <?php
                $urls = array_filter(preg_split("/\r\n|\n|\r/", $statement->urls));
                $urlsCount = count($urls);
                ?>
                @if($urlsCount > 0)
                <?php $counter = 0; ?>
                @foreach($urls as $link)
                <a href="{{ $link }}">{{ $link }}</a><br />
                <?php $counter++; ?>
                @endforeach
                @else
                N/A
                @endif
            </td>
        </tr>
    </tbody>
</table>

@endsection
