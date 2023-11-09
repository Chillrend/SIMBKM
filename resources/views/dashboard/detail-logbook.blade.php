@extends('layout.dashboard')
@section('container')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5>Tanggal: <b>{{ $log_logbooks->tanggal_dibuat }}</b></h3>
                    {{-- <p class="ms-md-auto ">Lokasi: <b>{{ $log_logbooks->lokasi }}</b></p> --}}
                </div>
                

                <a href="/dashboard/logbook/{{ $log_logbooks->logbook }}" class="btn btn-success mt-4"><span data-feather="arrow-left"></span> Back to all my logbook</a>
                <a href="/dashboard/logbook/{{ $log_logbooks->id }}/edit" class="btn btn-warning mt-4"><span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/logbook/{{ $log_logbooks->id }}/delete" method="post" class="d-inline">
                    
                    @csrf
                    <button class="btn btn-danger mt-4" onclick="return confirm('Are you sure?')">
                    <span data-feather="x-circle" class="bg-danger"></span> Delete
                    </button>
                </form>
                <hr class="horizontal dark">
            </div>
            
            <div class="card-body pt-0">

                <div class="row">
                    @if($log_logbooks->dokumen_logbook_path != null)
                      <input class="form-control" type="text" name="dokumen_logbook" id="dokumen_logbook" value="{{ $log_logbooks->dokumen_logbook_path }}" hidden>
                      <div class="col-6 mb-3">
                        @if($log_logbooks->dokumen_logbook_path != null)
                          <div class="row">
                            <a href="/dashboard/logbook/show-logbook-pdf/{{ $log_logbooks->id }}" class="btn btn-outline-gray900">View Dokumen Logbook</a>
                          </div>
                        @else
                          <p class="font-weight-bold">Belum Dokumen Logbook</p>
                        @endif
                      </div>
                    @else
                      <div class="col-md-8  d-flex">
                        <label for="dokumen_logbook" class="form-label">Dokumen Logbook</label>
                        <input class="form-control @error('dokumen_logbook') is-invalid @enderror" type="file" id="dokumen_logbook" name="dokumen_logbook">  
                            @error('dokumen_logbook')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                      </div>
                    @endif
                    
                  </div>

                <article class="my-3 fs-5">
                    {!! $log_logbooks->body !!}
                </article>
            </div>
        </div>
    </div>
</div>



@endsection