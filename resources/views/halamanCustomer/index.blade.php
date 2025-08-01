@extends('halamanCustomer.layout')
@section('content')
<section id="hero" class="hero section">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
            <h2><span></span><span class="underlight">ROWO.ID</span> Pelopor<span> rekomendari objek wisata se wilayah CIAYUMAJAKUNING</span></h2>
            <p>Memberikan rekomendasi tempat dan objek wisata se wilayah 3 CIAYUMAJAKUNING berdasarkan lokasi, penilaian, dan kriteria !</p>
            <a href="#koleksi" id="scrollBtn" class="btn-get-started">Cek rekomendasi!</a>          
        </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center" id="koleksi">
    @foreach($data as $item)
        @php
            $fotoPertama = $item->foto->first();
        @endphp

        @if($fotoPertama)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="gallery-item h-100">
                    <img src="{{ asset('storage/'.$fotoPertama->nm_foto) }}" 
                        class="img-fluid" 
                        alt="{{ $fotoPertama->nm_foto }}" 
                        style="height: 250px; width: 100%; object-fit: cover;">

                    <div class="gallery-links d-flex align-items-center justify-content-center">
                        <a href="{{ route('detail',['id'=>$item->id]) }}" class="details-link">
                            {{ $item->nama }}
                        </a>
                    </div>
                </div>
            </div><!-- End Gallery Item -->
        @endif
    @endforeach
</div>


      </div>

    </section><!-- /Gallery Section -->
        <script>
        document.getElementById("scrollBtn").addEventListener("click", function(e) {
            e.preventDefault(); // Mencegah lompat langsung
            document.getElementById("koleksi").scrollIntoView({
                behavior: "smooth"
            });
        });
    </script>
@endsection