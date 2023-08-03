@extends('layout.dashboard')
@section('container')

@if(session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
@endif

    @if($laporan->count())
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h5>Informasi Mbkm {{ $laporan[0]->listMbkm->name }}</h5>
                    <a href="/dashboard/pa/logbook/{{ $laporan[0]->mbkm }}" class="btn btn-primary ms-md-auto mt-2"> Lihat Logbook</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama</label>
                            <input class="form-control" id="name" type="text" name="name" value="{{ $laporan[0]->listMbkm->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nim" class="form-control-label">NIM</label>
                            <input class="form-control" id="nim" type="text" name="nim" placeholder="Masukan NIM" value="{{ $laporan[0]->listMbkm->nim }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fakultas" class="form-label">Jurusan</label>
                        <select class="form-select" id="fakultas" name="fakultas" disabled>
                            <option value="" disabled selected>{{ $laporan[0]->listMbkm->dataFakultas->name }}</option>
                        </select>
                        
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jurusan" class="form-label">Prodi</label>
                        <select class="form-select" id="jurusan" name="jurusan" disabled>
                            <option value=""selected>{{ $laporan[0]->listMbkm->dataJurusan->name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select" id="semester" name="semester" disabled>
                            <option value="" selected>{{ $laporan[0]->listMbkm->semester }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="program" class="form-label">Program</label>
                        <select class="form-select " id="program" name="program" disabled>
                            <option value="" disabled selected>{{ $laporan[0]->listMbkm->dataProgram->name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_mulai" class="form-control-label">Input Tanggal Mulai</label>
                            <input class="form-control" id="tanggal_mulai" type="datetime" name="tanggal_mulai" value="{{ $laporan[0]->listMbkm->tanggal_mulai }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_selesai" class="form-control-label">Input Tanggal Selesai</label>
                            <input class="form-control" id="tanggal_selesai" type="datetime" name="tanggal_selesai" value="{{ $laporan[0]->listMbkm->tanggal_selesai }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_program_perusahaan" class="form-control-label">Tempat Program(Perusahaan)</label>
                            <input class="form-control" id="tempat_program_perusahaan" type="text" name="tempat_program_perusahaan" value="{{ $laporan[0]->listMbkm->tempat_program_perusahaan }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6" onload="radioClicked()" onclick="radioClicked()">
                        <label for="">Mobilisasi</label>
                        <div class="form-check mb-3" >
                            <input class="form-check-input" type="radio" name="mobilisasi" id="customRadio1" value="1" {{ $laporan[0]->listMbkm->mobilisasi == "1" ? 'checked' : '' }} disabled>
                            <label class="custom-control-label" for="customRadio1">Iya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mobilisasi" id="customRadio2" value="0" {{ $laporan[0]->listMbkm->mobilisasi == "0" ? 'checked' : '' }} disabled>
                            <label class="custom-control-label" for="customRadio2">Tidak</label>
                        </div>
                    </div>
                    @if($laporan[0]->listMbkm->mobilisasi == "1")
                        <div class="col-md-6" id="lokasi">
                            <div class="form-group">
                                <label for="lokasi_program" class="form-control-label">Lokasi Program</label>
                                <input class="form-control @error('lokasi_program') is-invalid @enderror" id="lokasi_program" type="text" name="lokasi_program" placeholder="Masukan Lokasi Program" value="{{ old('lokasi_program', $laporan[0]->listMbkm->lokasi_program) }}" disabled>
                                @error('lokasi_program')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="col-md-6" id="lokasi" hidden>
                            <div class="form-group">
                                <label for="lokasi_program" class="form-control-label">Lokasi Program</label>
                                <input class="form-control @error('lokasi_program') is-invalid @enderror" id="lokasi_program" type="text" name="lokasi_program" placeholder="Masukan Lokasi Program" value="{{ old('lokasi_program', $laporan[0]->listMbkm->lokasi_program) }}" disabled>
                                @error('lokasi_program')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="program_keberapa" class="form-control-label">Pengambilan Program Ke-Berapa</label>
                            <select class="form-select" id="program_keberapa" name="program_keberapa" disabled>
                                <option value="" selected>{{ $laporan[0]->listMbkm->program_keberapa }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                        <select id="dosen_pembimbing" class="form-select" name="dosen_pembimbing" disabled>
                            @if($laporan[0]->listMbkm->listUser != null)
                            <option value="" disabled selected>{{ $laporan[0]->listMbkm->listUser->name }}</option>
                            @else
                            <option value="" disabled selected></option>
                            @endif
                            
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pembimbing_industri" class="form-label">Pembimbing Industri</label>
                        <select id="pembimbing_industri" class="form-select" name="pembimbing_industri" disabled>
                            @if($laporan[0]->listMbkm->listPI != null)
                            <option value="" disabled selected>{{ $laporan[0]->listMbkm->listPI->name }}</option>
                            @else
                            <option value="" disabled selected></option>
                            @endif        
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="informasi_tambahan" class="form-control-label">Informasi Tambahan</label>
                            <input class="form-control" id="informasi_tambahan" type="text" name="informasi_tambahan" value="{{ $laporan[0]->listMbkm->informasi_tambahan }}" disabled>
                        </div>
                    </div>
                </div>
                
                <hr class="horizontal dark mt-0">

                <h3 class="mt-4">Laporan</h3>
                @if($laporan[0]->dokumen_path != null)
                    <div class="row mt-2">
                        <div class="d-flex">
                            <div class="col-md-8 ">
                                <label for="dokumen" class="form-label">Post Dokumen</label>
                                <h4>{{ $laporan[0]->dokumen_name }}</h4>
                            </div>
                            @if($laporan[0]->status == "Diterima")
                            <div class="row">
                                <div class="col">
                                    <span class="badge bg-gradient-success">Laporan Diterima</span>
                                </div>
                            </div>
                            @endif
                            @if($laporan[0]->status == "Ditolak")
                            <div class="row">
                                <div class="col-12">
                                    <span class="badge bg-gradient-danger">Laporan Ditolak</span>
                                </div>
                            </div>
                            @endif
                            @if($laporan[0]->status == "sedang berjalan")
                            <div class="row">
                                <div class="col">
                                    <span class="badge bg-gradient-secondary">Sedang Ditinjau</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        @if($laporan[0]->sign_fourth === 0 || $laporan[0]->sign_fourth === null )
                            <a href="#" class="btn btn-secondary col-12" disabled">Dokumen Belum Selesai ditandatangan</a>
                        @else
                            <a href="/dashboard/pa/laporan/view-pdf/{{ $laporan[0]->id }}" class="btn btn-outline-primary col-12">Lihat Laporan</a>
                        @endif
                    </div>
                   
                @else
                    <div class="row mt-5">
                        <div class="col-md-8 ">
                            <label for="dokumen" class="form-label">Post Dokumen</label>
                            <h3>File Laporan belum Diupload</h3>
                        </div>
                    </div>
                  <hr class="horizontal dark">
                
                @endif
                <hr class="horizontal dark mt-0">
            </div>
          </div>
        </div>
      </div>    

      
      @else
        <h3>Mahasiswa Belum mengisi informasi Mbkm, silahkan isi informasi Mbkm terlebih dahulu</h3>
        <hr class="horizontal dark mt-0">
    @endif
      <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
      </script>
      <script>
         function radioClicked(){
            let mobilisasiChoice = document.querySelector('input[name="mobilisasi"]:checked').value;
            let lokasiProgram = document.getElementById('lokasi');
            let lokasiProgramValue = document.getElementById('lokasi_program');
            console.log(lokasiProgramValue.value);

            switch (mobilisasiChoice) {
            case '1':
                lokasiProgram.removeAttribute("hidden");
                break;

            case '0':
                lokasiProgram.setAttribute("hidden", true);
                lokasiProgramValue.value = '' 
                break;

            default:
                
            }
        };

        radioClicked()
      </script>
@endsection