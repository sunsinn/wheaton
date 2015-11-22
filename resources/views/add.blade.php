@extends('layouts.master')

@section('title')
    Add a recipe
@stop

@section('head')
    {{-- <link href="/css/books/create.css" type='text/css' rel='stylesheet'> --}}
@stop

@section('content')
<h1> Add a new recipe! </h1>
<form method='POST' action='edit'>

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>

    <div class='form-group'>
        <label>URL:</label>
        <input
            type='text'
            id='url'
            name='url'
            value='{{ old('url','') }}'
        >
    </div>

    <div class='form-group'>
        <label for='tags'> Tags:</label>
        <input
            type='text'
            id='tags'
            name="tags"
            value='{{ old('tags','') }}'
        >
    </div>
    <button type="submit" class="btn btn-primary">Add it!</button>
</form>
@stop
