@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Create Usuario</h1>
</div>
@endsection

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <span class="badge badge-danger"> {{$error}}</span>
            @endforeach
    </div>
    @endif
    <form action="/users" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name" name="name" tabindex="1" required="required">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="email" name="email" tabindex="1" required="required">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" tabindex="1" required="required">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Repetir contraseña</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" tabindex="1" required="required">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Roles</label>
            <div class="col-sm-8">
                <select class="form-control" name="roles" id="roles">
                    <option hidden></option>
                    @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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