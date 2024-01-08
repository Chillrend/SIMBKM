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
                <h3>Formuli Pendaftaran MBKM Saya</h3>
            </div>

            <div class="card-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role Kedua</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fakultas</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->role_kedua }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->fakultas_id }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $user->jurusan_id }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">{{ $user->status }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <a href="/dashboard/register/kelola-akun/{{ $user->id }}"><span class="badge badge-primary"></span><i class="fa fa-regular fa-pen" style="color: #fecb3e;"></i></a>
                                    <form action="/dashboard/register/kelola-akun/{{ $user->id }}/delete" method="post" class="d-inline">
                                        @csrf
                                    <button class="border-0 bg-transparent" onclick="return confirm('Data Akun Pengguna yang bersangkutan akan ikut terhapus secara permanen, Apakah kamu yakin?')">
                                        <span class="badge badge-danger"></span>
                                        <i class="fa fa-solid fa-trash" style="color: #bf0040;"></i>
                                      </button>
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