@extends('layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6 mb-2">
                <h1><strong>Tabel data objek Wisata</strong></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#" style="color:grey">Home</a></li>
                    <li class="breadcrumb-item">Tabel data OWI</li>
                </ol>
            </div>
            <div class="row">
                <a href="{{route('wisata.create')}}" class="btn btn-success btn-sm mr-2"><strong>Tambah data</strong></a>
                <a href="#" class="btn btn-info btn-sm"><strong>Edit data</strong></a>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th>Nama OWI</th>
                          <th>Rating OWI</th>
                          <th>Longitude</th>
                          <th>Latitude</th>
                          <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->rating}} ⭐</td>
                            <td>{{$data->longitude}}</td>
                            <td>{{$data->latitude}}</td>
                            <td align="center"><a href="{{route('wisata.detail',['id'=>$data->id])}}" class="btn btn-sm btn-info font-weight-bold">Detail OWI</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection