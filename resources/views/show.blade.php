@extends('layouts.master')

@section('title')
    Results
@stop

@section('head')
      {{-- css --}}
@stop

@section('content')


@if(isset($recipes))
  <h1>All Recipes</h1>
  @foreach($recipes as $recipe)
    <a href = '/show/{{ $recipe->id }}'>{{ $recipe->title }}</a><br>
  @endforeach
@elseif(isset($ingredients))
  <h1>All Ingredients</h1>
  @foreach($ingredients as $ingredient)
    <a href = '/showrecipes/{{ $ingredient->id }}'>{{ $ingredient->name }}</a><br>
  @endforeach
@elseif(isset($singleRecipe))
  Url: <a href = '{{ $singleRecipe->url }}'>{{ $singleRecipe->url }}</a><br>
  Title: {{ $singleRecipe->title }}</br>
  Ingredients: {{ $ingredientString }}<br>
  <a href = '/edit/{{ $singleRecipe->id }}'><button type="button">Edit or Delete</button></a>
@endif


@stop
