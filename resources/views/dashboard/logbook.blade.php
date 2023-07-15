@extends('layout.dashboard')
@section('container')

@if(session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
@endif

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h5>Logbook {{ auth()->user()->name }}</h5>
                    {{-- <div class="ms-md-auto d-flex">
                      <div class="input-group ms-md-auto d-flex">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control me-3" placeholder="Search here..." onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">

              @if($logbooks->count())
              @foreach($logbooks as $logbook)
              <div class="row mt-3">
                <div class="d-flex align-items-center">
                  <h4>{{ $logbook->listMbkm['tempat_program_perusahaan'] }}</h4>
                  <small class="ms-2 m-0">{{ $logbook->listMbkm->dataProgram['name'] }}</small>
                  <div class="ms-md-auto">
                    <p>Tanggal Kegiatan: <b>{{ $logbook->listMbkm->tanggal_mulai }}</b> - <b>{{ $logbook->listMbkm->tanggal_selesai }}</b> </p>
                  </div>
                </div>
                <small class="mt-0">Program Ke : {{ $logbook->listMbkm->program_keberapa }}</small>
                @if($logbook->listMbkm->dosen_pembimbing != 0)
                  <small class="mt-0">Dosen Pembimbing: {{ $logbook->listMbkm->listUser->name }}</small>
                @else
                  <small class="mt-0">Dosen Pembimbing: Belum Ada</small>
                @endif
                
              </div>
              <div class="row mt-3">
                <p>{{ $logbook->listMbkm->lokasi_program }}</p>
                <div class="d-flex">
                   {{-- <div class="btn btn-info">Detail</div> --}}
                   <a class="btn btn-info" href="/dashboard/logbook/{{ $logbook->id }}">Detail</a>
                </div>
              </div>
              <hr class="horizontal dark mt-0">
              @endforeach  

              @else
                <h3>Belum Ada Logbook, silahkan isi informasi mbkm terlebih dahulu</h3>
                <hr class="horizontal dark mt-0">
              @endif
          </div>
        </div>
      </div>    
@endsection