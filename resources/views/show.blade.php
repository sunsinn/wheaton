@extends('layouts.master')

@section('title')
    Results
@stop

@section('head')
      {{-- css --}}
@stop

@section('content')


@if (isset($recipes))
  <h1>All Recipes</h1>
  @foreach($recipes as $recipe)
    <a href = '/show/{{ $recipe->id }}'>{{ $recipe->title }}</a><br>
  @endforeach
@elseif (isset($ingredients))
  <h1>All Ingredients</h1>
  @foreach($ingredients as $ingredient)
    <a href = '/showrec/{{ $ingredient->id }}'>{{ $ingredient->name }}</a><br>
  @endforeach
@elseif(isset($recipe))
  Url: {{ $recipe->url }}<br>
  Title: {{ $recipe->title }}</br>
  Ingredients: {{ $ingredients }}<br>
  <a href = '/edit'><button type="button">Edit or Delete</button></a>  
@endif


@stop
