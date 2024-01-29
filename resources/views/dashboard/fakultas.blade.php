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
                {{-- <a href="/dashboard/fakultas/create" class="btn btn-primary d-flex ms-md-auto ms-3">Buat Jurusan</a> --}}
            </div>
            </div>

            <div class="card-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($fakultas as $data)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-start">
                                    <p class="text-xs font-weight-bold mb-0">{{ $data->nama_jurusan }}</p>
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