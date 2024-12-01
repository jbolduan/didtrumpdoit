@extends('layouts.app')

@section('content')

<div class="h1 text-center m-2">{{ $statement->title }}</div>
<!-- <hr class="border-4" style="color: #efa00b;"> -->
<div class="table-responsive mt-4">
<table class="table">
    <tbody>
        <tr class="p-4 border-top">
            <td class="p-4"><span class="fw-bold fs-5 align-middle">Statement Description:</span></td>
            <td class="align-middle p-4">{{ $statement->description }}</td>
        </tr>
        <tr class="p-4">
            <td class="p-4"><span class="fw-bold fs-5 align-middle">Statement Status:</s></td>
            <td class="align-middle p-4">{{ $statement->status->name }}</td>
        </tr>
        <tr>
            <td class="p-4"><span class="fw-bold fs-5 align-middle">Statement Status Details:</span></td>
            <td class="align-middle p-4">{{ $statement->status_details }}</td>
        </tr>
        <tr class="p-4">
            <td class="p-4"><span class="fw-bold fs-5 align-middle">Categories:</span></td>
            <td class="align-middle p-4">
                @if($statement->category->count() > 0)
                @foreach($statement->category as $category)
                <span class="badge rounded-pill category-pill-{{ $category->id }}">{{ $category->name }}</span>
                @endforeach
                @else
                N/A
                @endif
            </td>
        </tr>
        <tr class="p-4">
            <td class="p-4"><span class="fw-bold fs-5 align-middle">Statement URLs:</span></td>
            <td class="align-middle p-4">
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
</div>

@endsection
