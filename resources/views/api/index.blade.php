@extends('layouts.subpage')

@section('subpage-content')

<span class="h1">API</span>

<p class="mt-4">All the data is publically accessable for anyone who would like to pull everything from the site. 
    Specific entries can be pulled one at a time using /api/statement/{id} where {id} is the id 
    for the statement.  Every statement can be pulled as well using /api/statements which will return 
    a full dump of every statement and its associated data.</p>

@endsection
