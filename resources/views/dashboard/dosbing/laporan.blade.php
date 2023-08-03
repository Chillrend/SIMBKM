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
                <h4>Laporan Mahasiswa</h4>
              </div>
            </div>

            <div class="card-body">
                @if($mahasiswa->count())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" >
                      <thead>
                        <tr >
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">No.</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Nama</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Program Berjalan</th>
                          <th class="text-secondary opacity-7 col-2"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($mahasiswa as $data)
                            <tr >
                                <td class="align-middle text-center text-sm ">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-center ">
                                    <p class="text-xs font-weight-bold mb-0">{{ $data->name }}</p>
                                </td>
                                <td class="text-sm text-center ">
                                  <p class="text-xs font-weight-bold mb-0">{{ $data->program_keberapa }}</p>
                              </td>
                                <td class="align-middle text-center text-sm ">
                                  <td>
                                    <a href="/laporan/dosbing/{{ $data->id }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-eye" style="color: #3eeefe;"></i></a>
                                  </td>
                                </td>
                          @endforeach
                      </tbody>
                    </table>
                </div>
                @else
                <h3>Belum Ada Mahasiswa</h3>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection