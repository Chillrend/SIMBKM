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
              <div class="d-flex align-items-center">
                {{-- <button class="btn ">Sort By</button>   --}}
                <a href="/dashboard/mypost" class="btn btn-primary align-items-center  m-0 me-3 w-50">My Post</a>
                  <a href="/dashboard/forum/create" class="btn btn-outline-primary align-items-center d-flex m-0 me-2 w-50"><i class="fas fa-plus me-2" aria-hidden="true"></i>New Post</a>
                <div class="ms-md-auto d-flex">
                  
                  <div class="input-group ms-md-auto d-flex">
                    {{-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control me-3" placeholder="Search here..." onfocus="focused(this)" onfocusout="defocused(this)"> --}}
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body ms-3">
              @if($posts->count())
              
              @foreach($posts as $post)
              <div class="row mt-3">
                <div class="d-flex align-items-center">
                  <h4>{{ $post->author->name }}</h4>
                  <small class="ms-2 m-0">{{ $post->author->roles->name }}</small>
                </div>
                <small class="mt-0">{{ $post->updated_at->diffForHumans()}}</small>
              </div>
              <div class="row mt-3">
                <p>{!! $post->body !!}</p>
                
              <div class="d-flex">
                 {{-- <div class="btn btn-info me-2">Share</div>   --}}
                {{-- <div class="btn btn-info">Detail</div> --}}
                <a href="/dashboard/forum/detail/{{ $post->id }}" class="btn btn-info">Detail</a>
              </div>
              </div>
              <hr class="horizontal dark mt-0">
            @endforeach

              @else
              <h3>Belum Ada Postingan</h3>
              <hr class="horizontal dark mt-0">
              @endif

          </div>
        </div>
      </div>
@endsection