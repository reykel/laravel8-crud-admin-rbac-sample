@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Create Rol</h1>
</div>
@endsection

@section('content')
<div class="container">
    {!! Form::open(array( 'route' => 'roles.store', 'method' => 'POST')) !!}
        @csrf
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-8">
                {!! Form::text('name', null, array('class'=>'form-control')) !!}
            </div>
        </div>     
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Permisos</label>
            <div class="col-sm-8">
                @foreach ($model as $value)
                    <label>
                        {!! Form::checkbox('permission[]', $value->id, null, ['class' => 'mr-1']) !!}
                        {{ $value->name }}
                    </label><br/>
                @endforeach
            </div>
        </div> 
        <div align = "center">
            <a href="/roles" class="btn btn-danger" tabindex="6">Cancel</a>
            <button type="submit" class="btn btn-primary" tabindex="5">Save</a>    
        </div>    
    {!! Form::close() !!}
</div>
@endsection