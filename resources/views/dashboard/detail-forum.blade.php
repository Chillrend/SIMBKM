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
          </div>
        </div>
      </div>
@endsection