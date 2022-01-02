@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Edit Articulo</h1>
</div>
@endsection

@section('content')
<div class="container">
    <form action="/articulos/{{$model->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Codigo</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="codigo" name="codigo" tabindex="1" required="required" value="{{$model->codigo}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="descripcion" name="descripcion" tabindex="2" required="required" value="{{$model->descripcion}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Cantidad</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="cantidad" name="cantidad" tabindex="3" required="required" value="{{$model->cantidad}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" step="any" id="precio" name="precio" tabindex="4" required="required" value="{{$model->precio}}">
            </div>
        </div>
        <div align = "center">        
            <a href="/articulos" class="btn btn-danger" tabindex="6">Cancel</a>
            <button type="submit" class="btn btn-primary" tabindex="5">Save</a>  
        </div>      
    </form>
</div>
@endsection