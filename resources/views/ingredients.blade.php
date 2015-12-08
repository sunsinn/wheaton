@extends('layouts.master')

@section('title')
    Confirm ingredients
@stop

@section('head')
  {{-- css --}}
@stop

@section('content')
<h1> Confirm ingredients </h1>
<form method='POST' action='/add'>

    <input type='hidden' value='{{ csrf_token() }}' name='_token'>

    @foreach ($ingredients as $ingredient)
    <div class='form-group'>
      <input type="checkbox" name="{{$ingredient->name}}" value="{{$ingredient->id}}"> {{$ingredient->name}}<br>
    </div>
    @endforeach 

    <button type="submit" class="btn btn-primary">Add ingredients</button>
</form>
@stop
