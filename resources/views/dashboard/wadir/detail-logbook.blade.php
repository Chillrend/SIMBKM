@extends('layout.dashboard')
@section('container')

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h5>Logbook {{ $logbook[0]->listOwner->name }}</h5>
                    @if($logbook[0]->status == 0)
                    <span class="badge badge-sm bg-gradient-secondary ms-md-auto me-4">Belum dibaca</span>
                    @else
                    <span class="badge badge-sm bg-gradient-success ms-md-auto me-4">Sudah dibaca</span>
                    @endif                    
                </div>
            </div>
            <div class="card-body">
                <form  action="/logbook/dosbing/detail/finish/{{ $logbook[0]->id }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tanggal_dibuat" class="form-control-label">Input Tanggal</label>
                        <input class="form-control" type="datetime-local" name="tanggal_dibuat" value="{{  date('Y-m-d\TH:i', strtotime($logbook[0]->tanggal_dibuat)) }}" disabled>
                      </div>
                    </div>
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                        <label for="lokasi" class="form-control-label">Lokasi</label>
                        <input class="form-control" type="text" name="lokasi" value="{{ $logbook[0]->lokasi }}" disabled>
                      </div>
                    </div> --}}
                  </div>

                  <div class="row">
                    <div class="col-12 mb-3">
                      <label for="body" class="form-label">Body</label>
                      <input id="body" type="hidden" name="body" value="{{ $logbook[0]->body }}" disabled>
                      <trix-editor input="body" id="text-input-editor" disabled></trix-editor>
                    </div>                    
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="ms-md-auto d-flex">
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>    

      <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })

        
      </script>
@endsection