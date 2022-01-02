@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Edit Usuario</h1>
</div>
@endsection

@section('content')
<div class="container">
    <form action="/users/{{$model->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" name="name" tabindex="1" required="required" value="{{$model->name}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="email" name="email" tabindex="1" required="required" value="{{$model->email}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Roles</label>
            <div class="col-sm-8">
                <select class="form-control" name="roles" id="roles">
                    <option hidden>Roles</option>
                    @foreach ($roles as $item)
                        @if ( $item->id == $model->hasRole($item->name) )
                            <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div align = "center">      
            <a href="/users" class="btn btn-danger" tabindex="6">Cancel</a>
            <button type="submit" class="btn btn-primary" tabindex="5">Save</a> 
        </div>       
    </form>
</div>
@endsection