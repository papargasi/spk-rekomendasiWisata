@extends('layout')
@section('tittle', '| Edit Objek Wisata')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1 class="m-0">Edit informasi <br><b>{{$data->nama}}</b></h1>
                </div>
                <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"  class="text-decoration-none" style="color:grey">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/dataOwi"  class="text-decoration-none" style="color:grey">Tabel data OWI</a></li>
                        <li class="breadcrumb-item  active"><a href="{{route('wisata.detail',['id'=>$data->id])}}"  class="text-decoration-none" style="color:grey">Detail data {{$data->nama}}</a></li>
                        <li class="breadcrumb-item  active">Edit informasi {{$data->nama}}</li>
                        
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 h-100">
                    <a href="{{route('wisata.detail',['id'=>$data->id])}}"  class="text-decoration-none" style="color:black">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1" id="times-icon"><i class="fas fa-times"></i></span>
                            <div class="info-box-content equal-box">
                                <span class="info-box-number" id="edit-text">Kembali</span>
                                <span class="info-box-text" id="edit-text-kecil">Ketuk untuk Membatalkan</span>
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
                <div class="card-body"></div>
            </div>
        </div>
    </div>
</section>
@endsection