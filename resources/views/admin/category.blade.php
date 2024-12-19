@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 style="color: white">Add Category</h1>
        <ol class="breadcrumb mb-4">
            <form action="{{ url('add_category') }}" method="POST">
                @csrf
                <div class="">
                    <input type="text" name="category">

                    <input type="submit" value="Add Category" class="btn btn-primary">
                </div>
            </form>
        </ol>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->category_name }}</td>
                            <td><a href="{{ url('delete_category', $data->id) }}" class="btn btn-danger"
                                    onclick="confirmation(event)">Hapus</a>
                                <a class="btn btn-success" href="{{ url('edit_category', $data->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
