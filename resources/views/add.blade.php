@extends('layouts.master')

@section('title')
    Add a recipe
@stop

@section('head')
  {{-- css --}}  
@stop

@section('content')
<h1> Add a new recipe! </h1>
<form method='POST' action='/add'>

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>

    <div class='form-group'>
        <label>Title:</label>
        <input
            type='text'
            id='title'
            name='title'
            value='{{ old('title','') }}'
        >
    </div>

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
        <label for='tags'> Ingredients (separated by commas):</label>
        <input
            type='text'
            id='ingredients'
            name="ingredients"
            value='{{ old('ingredients','') }}'
        >
    </div>
    <button type="submit" class="btn btn-primary">Add it!</button>
</form>
@stop
