@extends('layouts.master')

@section('title')
    WhEatOn
@stop

@section('head')
    {{-- css --}}
@stop

@section('content')
    <h1>WhEatOn</h1>
    <h3>What to Eat Online</h3>
    <br><p>Keep track of the recipes you find online and find new recipes by ingredient!</p>
    <br><h4>Newest recipes:</h4>
    @foreach ($recipes as $recipe)
      <a href = '/show/{{ $recipe->id }}'>{{ $recipe->title }}</a><br>
    @endforeach
    <br><br>
    <p></p>Inspired by the work of <a href = "http://www.nytimes.com/2015/11/01/magazine/the-archive-of-eating.html?_r=0">Barbara Kectcham Wheaton</a></p></p>
@stop
