@extends('layouts.master')

@section('title')
    Edit Recipe
@stop


@section('content')

    <h1>Edit</h1>

    @include('errors')

    <form method='POST' action='edit'>

        <input type='hidden' value='{{ csrf_token() }}' name='_token'>

        <input type='hidden' name='id' value='{{ $recipe->id }}'>

        <div class='form-group'>
            <label for='title'>Title:</label>
            <input
                type='text'
                id='title'
                name="title"
                value='{{$recipe->title}}'
                >
        </div>

        <div class='form-group'>
            <label>URL:</label>
            <input
                type='text'
                id='url'
                name='url'
                value='{{$recipe->rul}}'
            >
        </div>

        <div class='form-group'>
            <label for='Ingredients'>Ingredients:</label>
            <input
                type='text'
                id='ingredients'
                name='ingredients'
                value='{{$recipe->ingredients}}'
                >
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>

@stop