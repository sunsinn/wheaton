@extends('layouts.master')

@section('title')
    Edit Recipe
@stop


@section('content')

    <h1>Edit</h1>

    @if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form method='POST' action='edit'>

        <input type='hidden' value='{{ csrf_token() }}' name='_token'>

        <input type='hidden' name='id' value='{{ $recipe->id }}'>

        <div class='form-group'>
            <label for='title'>Title:</label>
            <input
                type='text'
                size='75'
                id='title'
                name="title"
                value='{{$recipe->title}}'
                >
        </div>

        <div class='form-group'>
            <label>URL:</label>
            <input
                type='text'
                size='75'
                id='url'
                name='url'
                value='{{$recipe->url}}'
            >
        </div>

        <div class='form-group'>
            <label for='Ingredients'>Ingredients:</label>
            <input
                type='text'
                size='75'
                id='ingredients'
                name='ingredients'
                value='{{$ingredients}}'
                >
        </div>
        <br>
        <button type="submit">Save changes</button>
        <button type="submit" formaction="/delete">Delete recipe</button>
    </form>

@stop
