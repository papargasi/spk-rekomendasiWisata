@extends('layout')
@section('tittle','Kategori OWI')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel data bobot kriteria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"  class="text-decoration-none" style="color:grey">Home</a></li>
                        <li class="breadcrumb-item active">Tabel bobot kriteria</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 h-100">
                    <a href="{{ route('wisata.create') }}"  class="text-decoration-none" style="color:black">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1" id="edit-icon"><i class="fas fa-plus"></i></span>
                            <div class="info-box-content equal-box">
                                <span class="info-box-number" id="edit-text">Tambah data</span>
                                <span class="info-box-text" id="edit-text-kecil">Ketuk untuk menambah</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-noborder">
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            <th>Bobot</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $data)
                                        <tr>
                                            <td>{{$data->kriteria}}</td>
                                            <td>{{$data->bobot}} ⭐</td>
                                            <td align="center">
                                                <a href="{{route('wisata.detail',['id'=>$data->id])}}" class="btn btn-sm btn-info font-weight-bold">Detail OWI</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</section>
@endsection