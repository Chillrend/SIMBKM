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
            <div class="card-header">
              <div class="ms-md-auto d-flex">
                <h4>Tabel Perimintaan Konversi</h4>
                <a href="/konversi/kps/hasil-konversi" class="btn btn-primary d-flex ms-md-auto ms-3">Data Hasil Konversi</a>
            </div>
            </div>

            <div class="card-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prodi</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                          {{-- <th class="text-secondary opacity-7">Action</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($konversis as $konversi)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $konversi->dataOwner->name }}</p>
                                </td>
                                <td class="text-sm text-center">
                                  <p class="text-xs font-weight-bold mb-0">{{ $konversi->dataOwner->dataFakultas->name }}</p>
                                </td>
                                <td class="text-sm text-center">
                                  <p class="text-xs font-weight-bold mb-0">{{ $konversi->dataOwner->dataJurusan->name }}</p>
                                </td>
                                <td class="text-sm text-center">
                                  <p class="text-xs font-weight-bold mb-0">{{ $konversi->dataOwner->nim }}</p>
                                </td>
                          
                                <td class="align-middle text-center text-sm">
                                  @if($konversi->status == 'dalam pemeriksaan')
                                    <span class="badge badge-sm bg-gradient-secondary">{{ $konversi->status }}</span>
                                  @else
                                    <span class="badge badge-sm bg-gradient-success">{{ $konversi->status }}</span>
                                  @endif    
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <a href="/konversi/kps/{{ $konversi->kurikulum }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-pen" style="color: #fecb3e;"></i></a>
                                </td>
                        @endforeach        
                      </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection