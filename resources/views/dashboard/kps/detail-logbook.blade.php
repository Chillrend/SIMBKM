@extends('layout.dashboard')
@section('container')

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    {{-- <h5>Create Logbook</h5>
                    @if($logbook->status == 0)
                    <span class="badge badge-sm bg-gradient-secondary ms-md-auto me-4">Belum dibaca</span>
                    @else
                    <span class="badge badge-sm bg-gradient-success ms-md-auto me-4">Sudah dibaca</span>
                    @endif          --}}
                    
                    <h5>Logbook {{ $logbook->listOwner->name }}</h5>
                    @if($logbook->status_dosbing == 0)
                        <span class="badge badge-sm bg-gradient-secondary ms-md-auto ">Belum dibaca dosen</span>
                    @else
                        <span class="badge badge-sm bg-gradient-success ms-md-auto ">Sudah dibaca dosen</span>
                    @endif                    

                    @if($logbook->status_pi == 0)
                      <span class="badge badge-sm bg-gradient-secondary ms-md-auto me-4">Belum dibaca PI</span>
                    @else
                      <span class="badge badge-sm bg-gradient-success ms-md-auto me-4">Sudah dibaca PI</span>
                    @endif                        
                  
                </div>
            </div>
            <div class="card-body">
                <form  action="/logbook/kps/list/detail/finish/{{ $logbook->id }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tanggal_dibuat" class="form-control-label">Input Tanggal</label>
                        <input class="form-control" type="datetime-local" name="tanggal_dibuat" value="{{  date('Y-m-d\TH:i', strtotime($logbook->tanggal_dibuat)) }}" disabled>
                      </div>
                    </div>
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                        <label for="lokasi" class="form-control-label">Lokasi</label>
                        <input class="form-control" type="text" name="lokasi" value="{{ $logbook->lokasi }}" disabled>
                      </div>
                    </div> --}}
                  </div>

                  <div class="row">
                    <div class="col-12 mb-3">
                      <label for="body" class="form-label">Body</label>
                      <input id="body" type="hidden" name="body" value="{{ $logbook->body }}" disabled>
                      <trix-editor input="body" id="text-input-editor" disabled></trix-editor>
                    </div>                    
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="ms-md-auto d-flex">
                      {{-- @if($logbook->status == 0)
                      <Button type="submit" class="btn btn-primary align-items-center d-flex m-4 ">Selesai</Button>
                      @endif --}}
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