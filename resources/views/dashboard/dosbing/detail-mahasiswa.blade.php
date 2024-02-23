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
                    <h5>Informasi Mbkm {{ $laporan[0]->listMbkm->namaUser->name }}</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-control-label">Nama</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ $laporan[0]->listMbkm->namaUser->name }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nim" class="form-control-label">NIM</label>
                        <input class="form-control" id="nim" type="text" name="nim" placeholder="Masukan NIM" value="{{ $laporan[0]->listMbkm->namaUser->nim }}" disabled>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fakultas" class="form-label">Jurusan</label>
                    <select class="form-select" id="fakultas" name="fakultas" disabled>
                        <option value="" disabled selected>{{ $laporan[0]->listMbkm->namaUser->dataFakultas->name }}</option>
                    </select>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="jurusan" class="form-label">Prodi</label>
                    <select class="form-select" id="jurusan" name="jurusan" disabled>
                        <option value=""selected>{{ $laporan[0]->listMbkm->dataJurusan->namaUser->name }}</option>
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
        </div>
      </div>

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
