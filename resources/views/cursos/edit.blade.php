@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Edit Curso</h1>
</div>
@endsection

@section('content')
<div class="container">
    <form action="/cursos/{{$model->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nombre" name="nombre" tabindex="1" required="required" value="{{$model->nombre}}">
            </div>
        </div>

        <input type="hidden" class="form-control" id="hidden_producto" name="hidden_producto" value="{{$model->id_producto}}">
        <input type="hidden" class="form-control" id="hidden_categoria" name="hidden_categoria" value="{{$model->productos->categorias->id}}">

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Categorias</label>
            <div class="col-sm-8">
                <select class="form-control" name="" id="category">
                    <option hidden>Categoria</option>
                    @foreach ($categorias as $item)
                        @if ( $item->id == $model->productos->categorias->id )
                            <option value="{{ $item->id }}" selected="selected">{{ $item->descripcion }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Productos</label>
            <div class="col-sm-8">
                <select class="form-control" name="id_producto" id="id_producto"></select>
            </div>
        </div>
        <div align = "center">
            <a href="/cursos" class="btn btn-danger" tabindex="6">Cancel</a>
            <button type="submit" class="btn btn-primary" tabindex="5">Save</button>
        </div>  
    </form>
</div>
@endsection

@section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function() {

               var categoryID = $('#hidden_categoria').val();
               if(categoryID) {
                   $.ajax({
                       url: '/getProducto/'+categoryID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#id_producto').empty();
                            $('#id_producto').append('<option hidden>Choose Producto</option>'); 
                            $.each(data, function(key, producto){
                                if(producto.id == $('#hidden_producto').val())
                                    $('select[name="id_producto"]').append('<option value="'+ producto.id +'" selected="selected">' + producto.descripcion+ '</option>');
                                else
                                    $('select[name="id_producto"]').append('<option value="'+ producto.id +'">' + producto.descripcion+ '</option>');
                            });
                        }else{
                            $('#id_producto').empty();
                        }
                     }
                   });
               }else{
                 $('#id_producto').empty();
               }

            $('#category').on('change', function() {
               var categoryID = $(this).val();
               if(categoryID) {
                   $.ajax({
                       url: '/getProducto/'+categoryID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#id_producto').empty();
                            $('#id_producto').append('<option hidden>Choose Producto</option>'); 
                            $.each(data, function(key, producto){
                                $('select[name="id_producto"]').append('<option value="'+ producto.id +'">' + producto.descripcion+ '</option>');
                            });
                        }else{
                            $('#id_producto').empty();
                        }
                     }
                   });
               }else{
                 $('#id_producto').empty();
               }
            });
            });
        </script>
@endsection

