@extends('layout.main')

@section('container')

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Sistem Informasi MBKM</h1>
        <p class="lead text-body-secondary">Selamat Datang di Sistem Informasi MBKM Politeknik Negeri Jakarta</p>
        <p>
          {{-- <a href="#" class="btn btn-primary my-2">Main call to action</a> --}}
          <a href="#" class="btn btn-secondary my-2">selengkapnya</a>
          {{-- <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button> --}}
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        @foreach($programMbkm as $program)
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/' . $program['fotoikon']) }}" width="300" height="220" alt="gambar">

            <!-- <img src="gambar_ikon/{{ $program->gambar_ikon }}" width="100" height="200" class="card-img-top" alt="gambar"> -->
            <div class="card-body">
              <h3 class="card-title">{{ $program->name }}</h3>
              <p class="card-text ">{{ $program->deskripsi }}</p>
            </div>
            <div class="d-flex justify-content-between align-items-end p-3">
              <!-- <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
              </div>
              <small class="text-body-secondary">9 mins</small> -->
            </div>
          </div>
        </div>
        @endforeach


      </div>
    </div>
  </div>

</main>
@endsection
