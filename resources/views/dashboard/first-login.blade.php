<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="/img/logopnj.png" type="image/x-icon">
  <title>
    SIMBKM Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/css/nucleo-svg.css" rel="stylesheet" />
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="/css/nucleo-svg.css" rel="stylesheet" />
  

  <!-- CSS Files -->
  <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  
</head>
<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300  position-absolute w-100" style="background-color:#5ca8b1;"></div>
  
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('partials.navbar-dashboard')
    <!-- End Navbar -->
    <div class="container py-4">
      <div class="card">
        <div class="card-header">
            <h3>User Profile</h3>
        </div>
        <div class="card-body">
            <form action="/dashboard/first-create/{{ $user->id }}" method="post">
                @csrf
                <div class="row">   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" id="name" type="text" name="name" placeholder="Masukan Nama" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" id="email" type="text" name="email" placeholder="Masukan Email"  required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nim" class="form-control-label">NIM/NIP</label>
                            <input class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $user->nim) }}" id="nim" type="text" name="nim" placeholder="Masukan NIM"  required>
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @if($jabatan == 'Mahasiswa')
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="{{ $user->roles->id }}"  selected>{{ $user->roles->name }}</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fakultas_id" class="form-label">Jurusan</label>
                        <select class="form-select @error('fakultas_id') is-invalid @enderror" id="fakultas_id" name="fakultas_id" required>
                            <option value="" disabled selected>Pilih Jurusan</option>
                            @foreach($fakultas as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('fakultas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="jurusan_id" class="form-label">Prodi</label>
                        <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id" required>
                            <option value="" disabled selected>Pilih Prodi</option>
                        </select>
                        <small>*note:<i> pilih jurusan terlebih dahulu</i></small>
                        @error('jurusan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    @else
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="" disabled selected>Pilih Role</option>
                            @foreach($roles as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('fakultas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role_kedua" class="form-label">Role Kedua</label>
                        <select class="form-select @error('role_kedua') is-invalid @enderror" id="role_kedua" name="role_kedua">
                            <option value="" disabled selected>Pilih Role Kedua</option>
                            @foreach($roles as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <small>*note:<i> Optional</i></small>
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
                            @foreach($roles as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <small>*note:<i> Optional</i></small>
                        @error('role_ketiga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fakultas_id" class="form-label">Jurusan</label>
                        <select class="form-select @error('fakultas_id') is-invalid @enderror" id="fakultas_id" name="fakultas_id" required>
                            <option value="" disabled selected>Pilih Jurusan</option>
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
                        <label for="jurusan_id" class="form-label">Prodi</label>
                        <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id" required>
                            <option value="" disabled selected>Pilih Prodi</option>
                        </select>
                        <small>*note:<i> pilih jurusan terlebih dahulu</i></small>
                        @error('jurusan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @endif
                </div>
                <hr class="horizontal dark">
                <button type="submit" class="btn btn-primary ms-md-auto me-3 d-flex">Save Profile</button>      
            </form>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="/js/core/popper.min.js"></script>
  <script src="/js/core/bootstrap.min.js"></script>
  <script src="/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="/js/plugins/chartjs.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(document).ready(function () {
       
       $('#fakultas_id').on('change', function () {
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
               success: function (result) {
                   $('#jurusan_id').html('<option value="" disabled selected>Pilih Prodi</option>');
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
  
</body>
</html>