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
            <div class="card-header pb-0">
                <div class="row mt-3 mx-2">
                    <div class="d-flex align-items-center">
                        <h4>{{ $post->author->name}}</h4>
                        <small class="ms-2 m-0">{{ $post->author->roles->name }}</small>
                        <a href="/dashboard/forum"  class="btn ms-md-auto">Back</a>
                    </div>
                    <small class="mt-0">{{ $post->updated_at->diffForHumans() }}</small>
                </div>
            </div>

            <div class="card-body mx-3">
              <div class="row mt-3">
                @if($files->count())
                    @foreach($files as $file)
                        <a href="/dashobard/file/download/{{ $file->id }}"><i class="fa fa-solid fa-file"></i> {{ $file->file_name }}</a>
                    @endforeach
                @endif
                <p>{!! $post->body !!}</p>
              </div>

              <hr class="horizontal dark mt-0">

              <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-12">
                  <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                      <div class="form-outline mb-4">
                        <form action="/dashboard/forum/detail/comment" method="POST">
                          @csrf
                          <input type="hidden" name="id" value="{{ $post->id }}">
                          <label class="form-label" for="addANote"><h5>Comment</h5></label>
                          <input type="text" id="addANote" class="form-control" placeholder="Type comment..." name="body" />
                          @error('body')
                            <span class="text-danger d-flex">{{ $message }}</span>
                          @enderror
                          <button type="submit" class="btn mt-3">Submit</button>
                        </form>
                        <hr class="horizontal dark mt-0">
                        
                      </div>
                      @if($komen->count())
                        @foreach($komen as $data)
                          <div class="card mb-4">
                            <div class="card-body">
                              <p class="ms-2">{{ $data->body }}</p>
                              <hr class="horizontal dark mt-0">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                  <p class="mb-0 ms-2">{{ $data->author->name }}    <small><b>{{ $data->author->roles->name }}</b></small></p>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                  <p class="small text-muted mb-0">{{ $data->created_at->diffForHumans() }}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      
                      @else
                        <h5>Belum Ada Komen</h5>
                      @endif

                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
@endsection