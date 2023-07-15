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
                <h3>Formulir Pendaftaran MBKM Saya</h3>
            </div>

            <div class="card-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIM</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prodi</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Semester</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Program</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Selesai</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Program Perusahaan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mobilisasi</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi Program</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi Mobilisasi</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Program Ke-</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen Pembimbing</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembimbing Industri</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Informasi Tambahan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($mbkms as $mbkm)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->nim }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->dataFakultas->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->dataJurusan->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->semester }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->dataProgram->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->tanggal_mulai }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->tanggal_selesai }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->tempat_program_perusahaan }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($mbkm->mobilisasi == "1")
                                        <p class="text-xs font-weight-bold mb-0">Iya</p>
                                    @else
                                        <p class="text-xs font-weight-bold mb-0">Tidak</p>
                                    @endif
                                    
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->lokasi_program }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->lokasi_mobilisasi }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->program_keberapa }}</p>
                                </td>
                                @if($mbkm->listUser)
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->listuser->name }}</p>
                                </td>
                                @else
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Belum Dipilih</p>
                                </td>
                                @endif

                                @if($mbkm->listPI)
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->listPI->name }}</p>
                                </td>
                                @else
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">Belum Dipilih</p>
                                </td>
                                @endif
                                
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->informasi_tambahan }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $mbkm->created_at }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <td>
                                      <a href="/dashboard/informasi-mbkm/{{ $mbkm->id }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-pen" style="color: #fecb3e;"></i></a>
                                      {{-- <form action="/dashboard/fakultas//delete" method="post" class="d-inline">
                                        @csrf
                                        <button class="border-0 bg-transparent" onclick="return confirm('Data Jurusan dari Fakultas yang bersangkutan akan ikut terhapus secara permanen, Apakah kamu yakin?')">
                                          <span class="badge badge-danger"></span>
                                          <i class="fa fa-solid fa-trash" style="color: #bf0040;"></i>
                                        </button>
                                      </form> --}}
                                    </td>
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
@endsection