@extends('layouts.main')

@section('content_header')
<div class="container">
    <h1>Create Curso</h1>
</div>
@endsection

@section('content')
<div class="container">
    <form action="/cursos" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nombre" name="nombre" tabindex="1" required="required">
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Categorias</label>
            <div class="col-sm-8">
                <select class="form-control" name="" id="category">
                    <option hidden>Categoria</option>
                    @foreach ($model as $item)
                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
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
  
        <a href="/cursos" class="btn btn-danger" tabindex="6">Cancel</a>
        <button type="submit" class="btn btn-primary" tabindex="5">Save</a>        
    </form>
</div>
@endsection

@section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function() {
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
