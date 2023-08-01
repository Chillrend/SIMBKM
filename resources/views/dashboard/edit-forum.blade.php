@extends('layout.dashboard')
@section('container')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

@if(session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
@endif

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h5>Edit Postingan</h5>
                </div>
            </div>
            <div class="card-body">
                @if($files->count())
                  @foreach($files as $file)
                    <div class="row d-flex">
                      <h5>File {{ $loop->iteration }}</h5>
                      <div class="col d-flex">
                        <form action="/dashboard/mypost/delete/file/{{ $file->id }}" method="post" class="d-flex">
                          @csrf
                          <p>{{ $file->file_name }}</p>
                          <button type="submit" class="btn btn-danger ms-md-3 d-flex" onclick="return confirm('File yang kamu pilih akan terhapus secara permanen, Apakah kamu yakin?')"><i class="ni ni-fat-remove"></i></button>
                        </form>

                      </div>
                    </div>
                  @endforeach
                @endif
                <form action="/dashboard/mypost/update/{{ $forum->id }}" method="POST"  enctype="multipart/form-data">
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
                      <input id="body" type="hidden" name="body" value="{{ old('body', $forum->body) }}" autofocus required>
                      <trix-editor input="body"></trix-editor>
                    </div>                    
                  <div class="d-flex align-items-center">
                    <div class="ms-md-auto d-flex">
                      <a href="{{ url()->previous() }}" class="btn me-2">Back</a>
                      <button type="submit" class="btn btn-primary">Update Post</button>
                      {{-- <a href="#" class="btn btn-primary align-items-center d-flex m-2">Submit</a> --}}
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