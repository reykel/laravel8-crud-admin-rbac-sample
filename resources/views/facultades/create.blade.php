@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Create Facultad</h1>
</div>
@endsection

@section('content')
<div class="container">
    <form action="/facultades" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Descripcion</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="descripcion" name="descripcion" tabindex="1" required="required">
            </div>
        </div>
    
        <a href="/facultades" class="btn btn-danger" tabindex="6">Cancel</a>
        <button type="submit" class="btn btn-primary" tabindex="5">Save</a>        
    </form>
</div>
@endsection