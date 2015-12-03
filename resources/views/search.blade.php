@extends('layouts.master')

@section('title')
    Find a recipe
@stop

@section('head')
      {{-- css --}}
@stop

@section('content')
<h1>Find a recipe! </h1>
<form method='POST' action='/search' class="form-horizontal">

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>
    <fieldset>
    <div class='form-group'>
      <div class="col-lg-10">
        <label>Search by title:</label>
        <input
            type='text'
            id='title'
            name='title'
            value='{{ old('title','') }}'
        >
      </div>
    </div>

    <div class='form-group'>
      <div class="col-lg-10">
        <label>Search by ingredient:</label>
        <input
            type='text'
            id='ingredient'
            name='ingredient'
            value='{{ old('ingredient','') }}'
        >
      </div>
    </div>

    @if(Auth::check())
    <div class="form-group">
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="mineall" id="mine" value="mine" checked="">
            My recipes
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="mineall" id="all" value="all">
            All recipes
          </label>
        </div>
      </div>
    </div>
    @endif

    <div class="form-group">
      <div class="col-lg-10">
        <button type="submit">Search</button>
      </div>
    </div>
  </fieldset>
</form>
<br>
Or:
@if(Auth::check())
<a href = "/browsemyrecipes"><button type = "button">Browse my recipes</button></a>
@endif
<a href = "/browserecipes"><button type = "button">Browse all recipes</button></a>
<a href = "/browseingredients"><button type = "button">Browse all ingredients</button></a>

<p><p>
@if (isset($recipes))
<h2> Results </h2><br>
  @foreach($recipes as $recipe)
    <a href = '/show/{{ $recipe->id }}'>{{ $recipe->title }}</a><br>
  @endforeach
@endif

@stop
