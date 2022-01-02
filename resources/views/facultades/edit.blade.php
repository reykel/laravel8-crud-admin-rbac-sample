@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Edit Facultad</h1>
</div>
@endsection

@section('content')
<div class="container">
    <form action="/facultades/{{$model->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="descripcion" name="descripcion" tabindex="1" required="required" value="{{$model->descripcion}}">
            </div>
        </div>
  
        <a href="/facultades" class="btn btn-danger" tabindex="6">Cancel</a>
        <button type="submit" class="btn btn-primary" tabindex="5">Save</a>        
    </form>
</div>
@endsection