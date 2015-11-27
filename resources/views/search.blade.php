@extends('layouts.master')

@section('title')
    Find a recipe
@stop

@section('head')
      {{-- css --}}
@stop

@section('content')
<h1>Find a recipe! </h1>
<form method='POST' action='/add'>

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>

    <div class='form-group'>
        <label>Search by title:</label>
        <input
            type='text'
            id='title'
            name='title'
            value='{{ old('title','') }}'
        >
    </div>

    <div class='form-group'>
        <label>Search by ingredient:</label>
        <input
            type='text'
            id='ingredient'
            name='ingredient'
            value='{{ old('ingredient','') }}'
        >
    </div>
    <button type="submit">Search</button>
</form>
<br>
Or: <a href = "/browserec"><button type = "button">Browse all recipes</a></browse>
    <a href = "/browseing"><button type = "button">Browse all ingredients</a></browse>
@stop
