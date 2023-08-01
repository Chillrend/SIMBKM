@extends('layout.dashboard')
@section('container')

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h5>Edit Logbook</h5>
                </div>
            </div>
            <div class="card-body">
                <form  action="/dashboard/logbook/{{ $log_logbooks->id }}/update" method="POST">
                  @csrf
                  <input class="form-control" type="text" name="logbook" value="{{ $log_logbooks->logbook }}" hidden>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tanggal_dibuat" class="form-control-label">Input Tanggal</label>
                        <input class="form-control" type="datetime-local" name="tanggal_dibuat" value="{{  date('Y-m-d\TH:i', strtotime($log_logbooks->tanggal_dibuat)) }}" required>
                      </div>
                    </div>
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                        <label for="lokasi" class="form-control-label">Lokasi</label>
                        <input class="form-control" type="text" name="lokasi" value="{{ $log_logbooks->lokasi }}" required>
                      </div>
                    </div> --}}
                  </div>

                  <div class="row">
                    <div class="col-12 mb-3">
                      <label for="body" class="form-label">Body</label>
                      <input id="body" type="hidden" name="body" value="{{ $log_logbooks->body }}" required>
                      <trix-editor input="body"></trix-editor>
                    </div>                    
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="ms-md-auto d-flex">
                      {{-- <a href="#" class="btn btn-primary align-items-center d-flex m-2">Submit</a> --}}
                      <Button type="submit" class="btn btn-primary align-items-center d-flex m-4 ">Submit</Button>
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