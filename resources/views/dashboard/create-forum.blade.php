@extends('layout.dashboard')
@section('container')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h5>Buat Postingan Baru</h5>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="/dashboard/forum" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-0" id="field-file">
                    <div class="row" id="field-input">
                      <div class="col-md-10">
                          <label for="dokumen" class="form-label">Post Dokumen</label>
                          <input class="form-control @error('dokumen') is-invalid @enderror" type="file" id="dokumen" name="dokumens[0]">  
                          @error('dokumen')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="col-md-2 mt-4 mb-0">
                          <div class="form-group">
                              <a class="btn btn-outline-primary" style="cursor: no-drop" disabled>
                                  <div class="ni ni-fat-remove"></div>
                              </a>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-0 mb-4"><small>*note: <i>Optional</i></small></div>
                  <button id="add" type="button" class="btn btn-outline-primary"> Tambah Input File</button>
                  <div class="row">
                    <div class="col-12 mb-3">
                      <label for="body" class="form-label">Body</label>
                      @error('body')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                      <input id="body" type="hidden" name="body" value="{{ old('body') }}" autofocus required>
                      <trix-editor input="body"></trix-editor>
                    </div>                    
                  <div class="d-flex align-items-center">
                    <div class="ms-md-auto d-flex">
                      <a href="{{ url()->previous() }}" class="btn me-2">Back</a>
                      <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>    

      <script>
        let i = 0;
      $("#add").click(function(){
          ++i;
          $("#field-file").append(
              `<div class="row" id="field-input">
                      <div class="col-md-10">
                          <label for="dokumen" class="form-label">Post Dokumen</label>
                          <input class="form-control @error('dokumen') is-invalid @enderror" type="file" id="dokumen" name="dokumens[`+i+`]">  
                          @error('dokumen')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="col-md-2 mt-4 mb-0">
                          <div class="form-group">
                              <a class="btn btn-outline-primary remove-row">
                                  <div class="ni ni-fat-remove"></div>
                              </a>
                          </div>
                      </div>
                    </div>`
          );
      });

      $(document).on('click', '.remove-row', function(){
          $(this).parents('#field-input').remove();
      });

      </script>

      <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
      </script>
@endsection