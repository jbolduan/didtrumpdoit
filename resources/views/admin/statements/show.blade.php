@extends('layouts.app')

@section('content')

<div class="jumbotron text-center">
    <h1 class="display-4">{{ $statement->title }}</h1>
</div>
<p><b>Statement Description: </b>{{ $statement->description }}</p>
<p><b>Statement Status: </b>{{ $statement->status->name }}</p>
<p><b>Statement Status Details: </b>{{ $statement->status_details }}</p>
<p><b>Created By: </b><?php $statement->user->username ?? 'N/A'; ?></p>
<p><b>Public: </b><?php $statement->is_public ? 'Yes' : 'No'; ?></p>
@if($statement->category->count() > 0)
<p><b>Categories: </b>
    @foreach($statement->category as $category)
<h5><span class="badge rounded-pill bg-primary">{{ $category->name }}</span></h5>
@endforeach
</p>
@else
<p><b>Categories: </b>N/A</p>
@endif
<?php
$urls = array_filter(preg_split("/\r\n|\n|\r/", $statement->urls));
$urlsCount = count($urls);
?>
<b>Statement URLs:</b><br />
@if($urlsCount > 0)
<?php $counter = 0; ?>
@foreach($urls as $link)
<a href="{{ $link }}">{{ $link }}</a><br />
<?php $counter++; ?>
@endforeach
@else
N/A
@endif

@endsection
