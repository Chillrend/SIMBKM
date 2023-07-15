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
                <h4>Data Jurusan</h4>
                <a href="/dashboard/fakultas/create" class="btn btn-primary d-flex ms-md-auto ms-3">Buat Jurusan</a>
            </div>
            </div>

            <div class="card-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($fakultas as $data)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $data->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  @if($data->status == 'Aktif')
                                    <span class="badge badge-sm bg-gradient-success">{{ $data->status }}</span>
                                  @else
                                    <span class="badge badge-sm bg-gradient-danger">{{ $data->status }}</span>
                                  @endif    
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <td>
                                    <a href="/dashboard/fakultas/{{ $data->id }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-pen" style="color: #fecb3e;"></i></a>
                                    <form action="/dashboard/fakultas/{{ $data->id }}/delete" method="post" class="d-inline">
                                      @csrf
                                      <button class="border-0 bg-transparent" onclick="return confirm('Data Jurusan dari Fakultas yang bersangkutan akan ikut terhapus secara permanen, Apakah kamu yakin?')">
                                        <span class="badge badge-danger"></span>
                                        <i class="fa fa-solid fa-trash" style="color: #bf0040;"></i>
                                      </button>
                                    </form>
                                  </td>
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