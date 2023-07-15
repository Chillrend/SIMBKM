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
                <h4>Logbook {{ $owner }}</h4>
              </div>
            </div>

            <div class="card-body">
                @if($log_logbook->count())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" >
                      <thead>
                        <tr >
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Week.</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Tanggal</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Status Dosbing</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Status PI</th>
                          <th class="text-secondary opacity-7 col-2"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($log_logbook as $data)
                            <tr >
                                <td class="align-middle text-center text-sm ">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-center ">
                                    <p class="text-xs font-weight-bold mb-0">{{ $data->tanggal_dibuat }}</p>
                                </td>
                                @if($data->status_dosbing == 0)
                                  <td class="text-sm text-center ">
                                    <span class="badge badge-sm bg-gradient-secondary">Belum dibaca</span>
                                  </td>
                                @else  
                                  <td class="text-sm text-center ">
                                    <span class="badge badge-sm bg-gradient-success">Sudah dibaca</span>
                                  </td>
                                @endif
                                @if($data->status_pi == 0)
                                  <td class="text-sm text-center ">
                                    <span class="badge badge-sm bg-gradient-secondary">Belum dibaca</span>
                                  </td>
                                @else  
                                  <td class="text-sm text-center ">
                                    <span class="badge badge-sm bg-gradient-success">Sudah dibaca</span>
                                  </td>
                                @endif
                                <td class="align-middle text-center text-sm ">
                                  <td>
                                    <a href="/logbook/pi/detail/logbook-mahasiswa/{{ $data->id }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-eye" style="color: #3eeefe;"></i></a>
                                    @if($data->status_pi == 0)
                                    <form action="/logbook/pi/detail/finish/{{ $data->id }}" method="post" class="d-inline">
                                      @csrf
                                      <button class="border-0 bg-transparent" onclick="return confirm('Are you sure?')">
                                        <span class="badge badge-danger"></span>
                                        <i class="fa fa-solid fa-check" style="color: #669c35;"></i>
                                      </button>
                                    </form>
                                    @endif
                                  </td>
                                </td>
                          @endforeach
                      </tbody>
                    </table>
                </div>
                @else
                <h3>Belum Ada Logbook</h3>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection