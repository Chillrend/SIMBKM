@extends('layout.dashboard')
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3>Laporan {{ $laporans[0]->dataLaporan->pemilik->name }}</h3>
            </div>

            <div class="card-body">
              @if($laporans->count())
                

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comment</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Create</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($laporans as $laporan)
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img src="/img/document.png" width="75" height="75" alt="">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $laporan->dataLaporan->dokumen_name }}</h6>
                                
                                <p class="text-xs text-secondary mb-0">{{ $laporan->dataLaporan->listMbkm->dataProgram->name }}</p>
                              </div>
                            </div>
                          </td>

                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $laporan->body }}</p>
                            
                          </td>

                          <td class="align-middle text-center text-sm">
                            @if($laporan->dataLaporan->status == "Diterima")
                              <span class="badge badge-sm bg-gradient-success">{{ $laporan->dataLaporan->status }}</span>
                            @endif
                            @if($laporan->dataLaporan->status == "Ditolak")
                              <span class="badge badge-sm bg-gradient-danger">{{ $laporan->dataLaporan->status }}</span>
                            @endif
                            @if($laporan->dataLaporan->status == "sedang berjalan")
                              <span class="badge badge-sm bg-gradient-secondary">{{ $laporan->dataLaporan->status }}</span>
                            @endif
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $laporan->dataLaporan->created_at }}</span>
                          </td>

                          <td class="align-middle">
                            
                            <a href="/laporan/kps/detail/{{ $laporan->dataLaporan->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                              Detail
                            </a>
                          </td>
                        </tr>    
                        @endforeach
                        
                      </tbody>
                    </table>
                </div>
                @else
                <h3>Belum Ada Laporan, silahkan isi informasi Mbkm terlebih dahulu</h3>
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