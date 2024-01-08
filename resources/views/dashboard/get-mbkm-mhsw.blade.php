@extends('layout.dashboard')
@section('container')

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="ms-md-auto d-flex">
                    <h4>Edit Informasi MBKM</h4>
                    {{-- <a href="/dashboard/pendaftaran-mbkm/personal" class="btn btn-primary d-flex ms-md-auto ms-3">Formulir MBKM Saya</a> --}}
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Masukan Nama" value="{{ old('name', $mbkm->name) }}" autofocus readonly>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nim" class="form-control-label">NIM</label>
                            <input class="form-control @error('nim') is-invalid @enderror" id="nim" type="text" name="nim" value="{{ old('nim', $mbkm->nim) }}" placeholder="Masukan NIM" readonly>
                            @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <select class="form-select @error('fakultas') is-invalid @enderror" id="fakultas" name="fakultas" readonly>
                            <option value="" disabled selected>Pilih Fakultas</option>
                            @foreach($fakultas as $data)
                            @if(old('fakultas', $mbkm->fakultas) == $data->id)
                            <option value="{{ $data->id }}" selected>{{ $data->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('fakultas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" readonly>
                            <option value="" disabled selected>Pilih Jurusan</option>
                            @foreach($jurusans as $jurusan)
                            @if(old('jurusan', $mbkm->jurusan) == $jurusan->id)
                            <option value="{{ $jurusan->id }}" selected>{{ $jurusan->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <small>*note:<i> pilih fakultas terlebih dahulu</i></small>
                        @error('jurusan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" readonly>
                            <option value="" disabled selected>Pilih Semester</option>
                            @if(old('semester', $mbkm->semester))
                            <option value="{{ $mbkm->semester }}" selected>{{ $mbkm->semester }}</option>
                            @endif
                        </select>
                        @error('semester')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <select class="form-select @error('fakultas') is-invalid @enderror" id="tahun_ajaran" name="tahun_ajaran" readonly>
                            <option value="" disabled selected>Pilih Tahun Ajaran</option>
                            @foreach($tahun_ajaran as $tahun)
                            @if(old('tahun', $mbkm->tahun_ajaran) == $tahun->id)
                            <option value="{{ $tahun->id }}" selected>{{ $tahun->tahun_ajaran }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('$tahun_ajaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="program" class="form-label">Program</label>
                        <select class="form-select @error('program') is-invalid @enderror" id="program" name="program" readonly>
                            <option value="" disabled selected>Pilih Program</option>
                            @foreach($programs as $program)
                            @if(old('program', $mbkm->program) == $program->id)
                            <option value="{{ $program->id }}" selected>{{ $program->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('program')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_mulai" class="form-control-label">Input Tanggal Mulai</label>
                            <input class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $mbkm->tanggal_mulai) }}" readonly>
                            @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_selesai" class="form-control-label">Input Tanggal Selesai</label>
                            <input class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $mbkm->tanggal_selesai) }}" readonly>
                            @error('tanggal_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_program_perusahaan" class="form-control-label">Tempat Program(Perusahaan)</label>
                            <input class="form-control @error('tempat_program_perusahaan') is-invalid @enderror" id="tempat_program_perusahaan" type="text" name="tempat_program_perusahaan" placeholder="Tempat Program (Perusahaan)" value="{{ old('tempat_program_perusahaan', $mbkm->tempat_program_perusahaan) }}" readonly>
                            @error('tempat_program_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6" onload="radioClicked()" onclick="radioClicked()">
                        <label for="">Mobilisasi</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="mobilisasi" id="customRadio1" value="1" disabled {{ $mbkm->mobilisasi == "1" ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio1">Iya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mobilisasi" id="customRadio2" value="0" disabled {{ $mbkm->mobilisasi == "0" ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Tidak</label>
                        </div>
                    </div>
                    @if($mbkm->mobilisasi == "1")
                    <div class="col-md-6" id="lokasi">
                        <div class="form-group">
                            <label for="lokasi_mobilisasi" class="form-control-label">Lokasi Mobilisasi</label>
                            <input class="form-control @error('lokasi_mobilisasi') is-invalid @enderror" id="lokasi_mobilisasi" type="text" name="lokasi_mobilisasi" placeholder="Masukan Lokasi Mobilisasi" value="{{ old('lokasi_mobilisasi', $mbkm->lokasi_mobilisasi) }}" disabled>
                            @error('lokasi_mobilisasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @else
                    <div class="col-md-6" id="lokasi" hidden>
                        <div class="form-group">
                            <label for="lokasi_mobilisasi" class="form-control-label">Lokasi Mobilisasi</label>
                            <input class="form-control @error('lokasi_mobilisasi') is-invalid @enderror" id="lokasi_mobilisasi" type="text" name="lokasi_mobilisasi" placeholder="Masukan Lokasi Mobilisasi" value="{{ old('lokasi_mobilisasi', $mbkm->lokasi_mobilisasi) }}">
                            @error('lokasi_mobilisasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lokasi_program" class="form-control-label">Lokasi Program</label>
                            <input class="form-control @error('lokasi_program') is-invalid @enderror" id="lokasi_program" type="text" name="lokasi_program" placeholder="Masukan Lokasi program" value="{{ old('lokasi_program', $mbkm->lokasi_program) }}">

                            @error('lokasi_program')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="program_keberapa" class="form-control-label">Pengambilan Program Ke-Berapa</label>
                            <select class="form-select @error('program_keberapa') is-invalid @enderror" id="program_keberapa" name="program_keberapa" readonly>
                                <option value="" disabled selected>Program Ke-</option>
                                @if(old('program_keberapa', $mbkm->program_keberapa))
                                <option value="{{ $mbkm->program_keberapa }}" selected>{{ $mbkm->program_keberapa }}</option>
                                @endif
                            </select>
                            @error('program_keberapa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing</label>
                        <select id="dosen_pembimbing" class="form-select @error('dosen_pembimbing') is-invalid @enderror" name="dosen_pembimbing">
                            <option value="" disabled selected>Pilih Dosen Pembimbing</option>
                            @foreach($dosbing as $dosen)
                            @if(old('dosen_pembimbing', $mbkm->dosen_pembimbing) == $dosen->id)
                            <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}</option>
                            @endif
                            @endforeach

                        </select>
                        <small>*note: <i>bisa dipilih nanti</i></small>
                        <div id="reset">
                            <span id="reset-btn" class="badge badge-pill badge-md bg-gradient-warning">Reset</span>
                        </div>
                        @error('dosen_pembimbing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pembimbing_industri" class="form-label">Pembimbing Industri</label>
                        <select id="pembimbing_industri" class="form-select @error('pembimbing_industri') is-invalid @enderror" name="pembimbing_industri">
                            <option value="" disabled selected>Pilih Pembimbing Industri</option>
                            @foreach($pembimbing_industri as $pi)
                            @if(old('pembimbing_industri', $mbkm->pembimbing_industri) == $pi->id)
                            <option value="{{ $pi->id }}" selected>{{ $pi->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        <small>*note: <i>bisa dipilih nanti</i></small>
                        <div id="reset">
                            <span id="reset-btn-pi" class="badge badge-pill badge-md bg-gradient-warning">Reset</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="informasi_tambahan" class="form-control-label">Informasi Tambahan</label>
                            <input class="form-control @error('informasi_tambahan') is-invalid @enderror" id="informasi_tambahan" type="text" name="informasi_tambahan" placeholder="Masukan posisi program. ex: Frontend, HR, QC " value="{{ old('informasi_tambahan', $mbkm->informasi_tambahan) }}" readonly>
                            @error('informasi_tambahan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <button type="reset" id="reset-btn" class="btn btn-secondary m-btn m-btn--air m-btn--custom"> --}}


<script>
    $("#reset-btn").click(function() {
        // $('#m_select2_3').val('').change();
        $('#dosen_pembimbing').val('').change();
    });

    $("#reset-btn-pi").click(function() {
        // $('#m_select2_3').val('').change();
        $('#pembimbing_industri').val('').change();
    });
</script>

<script>
    function radioClicked() {
        let mobilisasiChoice = document.querySelector('input[name="mobilisasi"]:checked').value;
        let lokasiProgram = document.getElementById('lokasi');
        let lokasiProgramValue = document.getElementById('lokasi_program');
        let lokasiMobilisasiValue = document.getElementById('lokasi_mobilisasi');

        console.log(lokasiProgramValue.value);

        switch (mobilisasiChoice) {
            case '1':
                lokasiProgram.removeAttribute("hidden");
                lokasiMobilisasiValue.value = ''
                break;

            case '0':
                lokasiProgram.setAttribute("hidden", true);
                lokasiProgramValue.value = ''
                break;

            default:

        }
    };

    $(document).ready(function() {

        $('#fakultas').on('change', function() {
            var idFakultas = this.value;
            $("#jurusan").html('');
            $.ajax({
                url: "{{url('/api/fetch-jurusan')}}",
                type: "POST",
                data: {
                    fakultas_id: idFakultas,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#jurusan').html('<option value="" disabled selected>Pilih Jurusan</option>');
                    $.each(result.jurusan, function(key, value) {
                        $("#jurusan").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    // $('#city-dropdown').html('<option value="">-- Select City --</option>');
                }
            });
        });
    });
</script>
@endsection