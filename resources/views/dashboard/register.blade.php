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
                        <h4>Buat Akun</h4>
                        <a href="/dashboard/register/kelola-akun" class="btn btn-primary d-flex ms-md-auto ms-3">Kelola Akun</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/dashboard/register" method="post">
                        @csrf
                        <div class="row">   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Masukan Nama" autofocus required>
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
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="Masukan email" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Masukan password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role_kedua" class="form-label">Role Kedua</label>
                                <select class="form-select @error('role_kedua') is-invalid @enderror" id="role_kedua" name="role_kedua">
                                    <option value="" disabled selected>Pilih Role Kedua</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <small>*note:<i> optional</i></small>
                                @error('role_kedua')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role_ketiga" class="form-label">Role Ketiga</label>
                                <select class="form-select @error('role_ketiga') is-invalid @enderror" id="role_ketiga" name="role_ketiga">
                                    <option value="" disabled selected>Pilih Role Ketiga</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <small>*note:<i> optional</i></small>
                                @error('role_ketiga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fakultas_id" class="form-label">Fakultas</label>
                                <select class="form-select @error('fakultas_id') is-invalid @enderror" id="fakultas_id" name="fakultas_id" required>
                                    <option value="" disabled selected>Pilih Fakultas</option>
                                    @foreach($fakultas as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('fakultas_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jurusan_id" class="form-label">Jurusan</label>
                                <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                </select>
                                <small>*note:<i> pilih fakultas terlebih dahulu</i></small>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <button type="submit" class="btn btn-primary ms-md-auto me-3 d-flex">Buat Akun</button>      
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
           
           $('#fakultas_id').on('change', function () {
               var idFakultas = this.value;
               $("#jurusan_id").html('');
               $.ajax({
                   url: "{{url('/api/fetch-jurusan')}}",
                   type: "POST",
                   data: {
                       fakultas_id: idFakultas,
                       _token: '{{csrf_token()}}'
                   },
                   dataType: 'json',
                   success: function (result) {
                       $('#jurusan_id').html('<option value="" disabled selected>Pilih Jurusan</option>');
                       $.each(result.jurusan, function (key, value) {
                           $("#jurusan_id").append('<option value="' + value
                               .id + '">' + value.name + '</option>');
                       });
                       // $('#city-dropdown').html('<option value="">-- Select City --</option>');
                   }
               });
           });
       });
   </script>
@endsection