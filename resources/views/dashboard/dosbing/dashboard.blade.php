@extends('layout.dashboard')
@section('container')


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
              <div class="ms-md-auto d-flex">
                <h4>Data Mahasiswa</h4>
              </div>
            </div>

            <div class="card-body">
                @if($mahasiswa->count())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" >
                      <thead>
                        <tr class="row">
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">No.</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-6">Nama</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">Program Berjalan</th>
                          <th class="text-secondary opacity-7 col-2"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($mahasiswa as $data)
                            <tr class="row">
                                <td class="align-middle text-center text-sm col-2">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-center col-6">
                                    <p class="text-xs font-weight-bold mb-0">{{ $data->name }}</p>
                                </td>
                                <td class="text-sm text-center col-2">
                                  <p class="text-xs font-weight-bold mb-0">{{ $data->program_keberapa }}</p>
                                </td>
                                <td class="text-sm text-center col-2">
                                  <a href="/dashboard/dosbing/detail/{{ $data->id }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-eye" style="color: #3eeefe;"></i></a>
                                </td>
                          @endforeach
                      </tbody>
                    </table>
                </div>
                @else
                <h3>Belum Ada Mahasiswa</h3>
                <hr class="horizontal dark mt-0">
                {{-- <div class="d-flex align-items-center m-2">
                    <div class="ms-md-auto d-flex">
                        <Button class="btn btn-outline-primary align-items-center d-flex m-2">Upload Form TTD</Button>
                    </div>
                </div> --}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection