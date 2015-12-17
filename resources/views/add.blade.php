@extends('layouts.master')

@section('title')
    Add a recipe
@stop

@section('head')
  {{-- css --}}
@stop

@section('content')
<h1> Add a new recipe! </h1>

@if(count($errors) > 0)
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form method='POST' action='/add'>

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>

    <div class='form-group'>
        <label>Title:</label>
        <input
            type='text'
            size='75'
            id='title'
            name='title'
            value='{{ old('title','') }}'
        >
    </div>

    <div class='form-group'>
        <label>URL:</label>
        <input
            type='text'
            size='75'
            id='url'
            name='url'
            value='{{ old('url','') }}'
        >
    </div>


    <div class='form-group'>
        <label for='tags'> Ingredients:</label>
        <input
            type='text'
            size='75'
            id='ingredients'
            name="ingredients"
            value='{{ old('ingredients','') }}'
        >
        <br>(Enter ingredients in singular form, without spaces and separated by commas. Example: carrot,broccoli,onion,tomato)
    </div>
    <button type="submit" class="btn btn-primary">Add it!</button>
</form>
@stop
