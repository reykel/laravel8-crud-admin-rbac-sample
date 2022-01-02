@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endsection

@section('content_header')
    <div class="container">
        <h1>List Cursos</h1>
    </div>
@endsection

@section('content')
    <div class="container">
        <div align = "right">
            @can('cursos.create')
            <a href="cursos/create" class="btn btn-lg btn-primary mb-3"><i class="fas fa-fw fa-plus icon-white"></i> Add new record</a>
            @endcan
        </div>

        <table id="cursos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width:2%" scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Categoria</th>                    
                    <th style="width:15%" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($model as $key)
                    <tr>
                        <td>{{$key->id}}</td>
                        <td>{{$key->nombre}}</td>
                        <td>{{$key->productos->descripcion}}</td>
                        <td>{{$key->productos->categorias->descripcion}}</td>
                        <td>
                            <form action="{{ route ('cursos.destroy', $key->id) }}" method="POST" id="delete-record" class="deleteclass">
                                @can('cursos.edit')
                                    <a href="/cursos/{{$key->id}}/edit" class="btn btn-info">Edit</a>
                                @endcan
                                @csrf
                                @method('DELETE')
                                @can('cursos.edit')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @endcan
                            </form>                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('deleted') == '-1')
        <script>
            Swal.fire(
                'Deleted!',
                'Your record has been deleted.',
                'success'
            )            
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#cursos').DataTable();
        });

        $('.deleteclass').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
</script>    
@endsection