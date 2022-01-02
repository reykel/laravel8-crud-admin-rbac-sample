@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endsection

@section('content_header')
    <div class="container">
        <h1>List Articulos</h1>
    </div>
@endsection

@section('content')
    <div class="container">
        <a href="articulos/create" class="btn btn-lg btn-primary mb-3">Create</a>

        <table id="articulos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($model as $key)
                    <tr>
                        <td>{{$key->id}}</td>
                        <td>{{$key->codigo}}</td>
                        <td>{{$key->descripcion}}</td>
                        <td>{{$key->cantidad}}</td>
                        <td>{{$key->precio}}</td>
                        <td>
                            <form action="{{ route ('articulos.destroy', $key->id) }}" method="POST" id="delete-record" class="deleteclass">
                                <a href="/articulos/{{$key->id}}/edit" class="btn btn-info">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
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

    <script>
        $(document).ready(function() {
            $('#articulos').DataTable();
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

@if (session('deleted') == '-1')
        <script>
            Swal.fire(
                'Deleted!',
                'Your record has been deleted.',
                'success'
            )            
        </script>
    @endif
@endsection