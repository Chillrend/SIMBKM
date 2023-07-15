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
        <div class="card">
            <div class="card-header">
                <h4>Upload Kurikulum</h4>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="">
                        <label for="dokumen" class="form-label">Post Dokumen</label>
                        <h2>{{ $kurikulum->dokumen_name }}</h2>
                        @error('dokumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <a href="/konversi/kps/viewpdf/{{ $kurikulum->id }}" class="btn btn-outline-secondary col-12" >View Dokumen</a>
                    </div>
                    {{-- <small>*note: <i>ukuran maximal file 2MB</i></small> --}}
                </div>
                <div class="row" id="field-matakuliah">
                    @foreach($matakuliah as $matkul)
                    <div class="row" id="row-matakuliah" >
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="mata_kuliah" class="form-control-label">Matakuliah</label>
                                <input class="form-control" type="text" name="inputs[{{ $loop->iteration - 1 }}][mata_kuliah]" placeholder="Masukan mata kuliah" value="{{ $matkul->mata_kuliah }}" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="sks" class="form-control-label">SKS</label>
                                <input class="form-control" type="text" name="inputs[{{ $loop->iteration - 1 }}][sks]" placeholder="Masukan jumlah sks" value="{{ $matkul->sks }}" >
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            @if($matkul->status != null)
                                
                                <div class="form-group">
                                    @if($matkul->status != 0)
                                    <a class="badge badge-pill badge-md bg-gradient-success mt-3">
                                        <div class="ni ni-check-bold align-items-center d-flex "></div>
                                    </a>
                                    @else
                                    <a  class="badge badge-pill badge-md bg-gradient-danger mt-3" >
                                        <div class="ni ni-fat-remove align-items-center d-flex "></div>
                                    </a>
                                    @endif
                                </div>
                            @else
                            <div class="form-group">
                                <form method="post" action="/konversi/kps/incorrect/{{ $matkul->id }}"  class="d-inline ms-md-auto me-3">
                                    @csrf
                                    <button class="badge badge-pill badge-md bg-gradient-danger mt-3">
                                        <div class="ni ni-fat-remove align-items-center d-flex "></div>
                                    </button>
                                </form>
                                <form method="post" action="/konversi/kps/correct/{{ $matkul->id }}"  class="d-inline ms-md-auto me-3">
                                    @csrf
                                    <button class="badge badge-pill badge-md bg-gradient-success mt-3">
                                        <div class="ni ni-check-bold align-items-center d-flex "></div>
                                    </button>
                                </form>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="row mt-2">
                        <form action="/konversi/kps/confirm/{{ $logcomment[0]->id }}" method="post">
                            @csrf
                            <label for="body" class="form-label">Comment</label>
                            @error('body')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input id="body" type="hidden" name="body" value="{{ old('body') }}" autofocus>
                            <trix-editor input="body" placeholder="Tambahkan catatan... boleh dikosongkan"></trix-editor>
                            <div class="d-flex align-items-center ">
                                <div class="ms-md-auto d-flex">
                                    <Button class="btn btn-primary align-items-center d-flex m-4 ">Konfirmasi</Button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="horizontal dark">
            
                <div class="row  mt-2">
                    <div class="col-12">
                </div>
                
            </div>
        </div>    
    </div>
</div>

<script>
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })
</script>

<script>
    let i = 0;
    $("#add").click(function(){
        ++i;
        $("#field-matakuliah").append(
            `<div class="row" id="row-matakuliah" >
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="mata_kuliah" class="form-control-label">Matakuliah</label>
                        <input class="form-control" type="text" name="inputs[`+i+`][mata_kuliah]" placeholder="Masukan mata kuliah">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="sks" class="form-control-label">SKS</label>
                        <input class="form-control" type="text" name="inputs[`+i+`][sks]" placeholder="Masukan jumlah sks">
                    </div>
                </div>
                <div class="col-md-2 mt-4">
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
        $(this).parents('#row-matakuliah').remove();
    })


</script>
@endsection