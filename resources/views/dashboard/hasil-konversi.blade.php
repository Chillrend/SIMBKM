@extends('layout.dashboard')
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3>Hasil Konversi</h3>
            </div>

            <div class="card-body">
              @if($hasil->count())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comment</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dibuat Pada</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($hasil as $data)
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img src="/img/document.png" width="75" height="75" alt="">
                                
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $data->dataHasilKonversi->dataKurikulum->dokumen_name }}</h6>
                                <p class="text-xs text-secondary mb-0">By {{ $data->dataHasilKonversi->dataOwner->name }}</p>
                              </div>
                            </div>
                          </td>
                            
                          <td>
                            <p class="text-xs font-weight-bold mt-4">{!! $data->body !!}</p>
                            
                          </td>

                          <td class="align-middle text-center text-sm">
                            @if($data->dataHasilKonversi->status == 'dalam pemeriksaan')
                              <span class="badge badge-sm bg-gradient-secondary">{{ $data->dataHasilKonversi->status }}</span>
                            @else
                              <span class="badge badge-sm bg-gradient-success">{{ $data->dataHasilKonversi->status }}</span>
                            @endif    
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $data->dataHasilKonversi->created_at }}</span>
                          </td>

                          <td class="align-middle">
                            <a href="/dashboard/hasil-konversi/{{ $data->dataHasilKonversi->dataKurikulum->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                              View
                            </a>
                          </td>
                        </tr>
                        @endforeach
                        @else
                          <h3>Belum Ada Kurikulum yang dikonversi, silahkan isi Upload Kurikulum terlebih dahulu</h3>
                          <hr class="horizontal dark mt-0">
                        @endif
                        
                      </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection