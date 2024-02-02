@extends('layout.dashboard')
@section('container')

    @if(session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="ms-md-auto d-flex">
                        <h4>Edit Akun</h4>
                        {{-- <a href="/dashboard/register/kelola-akun" class="btn btn-primary d-flex ms-md-auto ms-3">Kelola Akun</a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <form action="/dashboard/register/kelola-akun/{{ $user->id }}/update" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name"
                                           type="text" name="name" placeholder="Masukan Nama"
                                           value="{{old('name', $user->name)}}" autofocus required>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                           type="email" name="email" placeholder="Masukan email"
                                           value="{{old('email', $user->email)}}" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Create new password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Ubah Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                           type="password" name="password" placeholder="Masukan password baru"
                                           value="{{old('password')}}">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                                        required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    @foreach($roles as $role)
                                        @if (old('role', $user->role) == $role->id)
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="additional_role" class="form-label">Role Kedua</label>
                                <select class="form-select @error('additional_role') is-invalid @enderror" id="additional_role"
                                        name="additional_role">
                                    <option value="" disabled selected>Pilih Role Kedua</option>
                                    @foreach($roles as $role)
                                        @if (old('additional_role', $user->additional_role) == $role->id)
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small>*note:<i> optional</i></small>
                                @error('additional_role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="api_jurusan_id" class="form-label">Fakultas</label>
                                <select class="form-select @error('api_jurusan_id') is-invalid @enderror"
                                        id="api_jurusan_id"
                                        name="api_jurusan_id" required>
                                    <option value="" disabled selected>Pilih Fakultas</option>
                                    @foreach($fakultas as $data)
                                        @if (old('api_jurusan_id', $user->api_jurusan_id) == $data->id)
                                            <option value="{{ $data->id }}" selected>{{ $data->nama_jurusan }}</option>
                                        @else
                                            <option value="{{ $data->id }}">{{ $data->nama_jurusan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('api_jurusan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="api_prodi_id" class="form-label">Jurusan</label>
                                <select class="form-select @error('api_prodi_id') is-invalid @enderror" id="api_prodi_id"
                                        name="api_prodi_id" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    @foreach($jurusans as $jurusan)
                                        @if (old('api_prodi_id', $user->api_prodi_id) == $jurusan->id)
                                            <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama_prodi }}</option>
                                        @else
                                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_prodi }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small>*note:<i> pilih fakultas terlebih dahulu</i></small>
                                @error('api_prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <button type="submit" class="btn btn-primary ms-md-auto me-3 d-flex">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('#api_jurusan_idd').on('change', function () {
                var idFakultas = this.value;
                $("#api_prodi_id").html('');
                $.ajax({
                    url: "https://dev-h2h.upatik.io/api/akademik/jurusan/find/" + idFakultas,
                    type: "GET",
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        $('#api_prodi_id').html('<option value="" disabled selected>Pilih Jasdurusan</option>');
                        $.each(result, function (key, value) {
                            $("#api_prodi_id").append('<option value="' + value
                                .id + '">' + value.nama_jurusan + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
