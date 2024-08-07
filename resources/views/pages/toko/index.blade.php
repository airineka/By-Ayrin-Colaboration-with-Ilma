@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Toko</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Toko</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->nama_toko }}</td>
                    <td>{{ $data->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
