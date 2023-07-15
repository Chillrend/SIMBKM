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
                <form action="/dashboard/upload-kurikulum" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="">
                            <label for="dokumen" class="form-label">Post Dokumen</label>
                            <h2>{{ $kurikulum->dokumen_name }}</h2>
                            @error('dokumen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <small>*note: <i>ukuran maximal file 2MB</i></small> --}}
                    </div>
                    <div class="row" id="field-matakuliah">
                        @foreach($matakuliah as $matkul)
                        <div class="row" id="row-matakuliah" >
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="mata_kuliah" class="form-control-label">Matakuliah</label>
                                    <input class="form-control" type="text" name="inputs[0][mata_kuliah]" placeholder="Masukan mata kuliah" value="{{ $matkul->mata_kuliah }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="sks" class="form-control-label">SKS</label>
                                    <input class="form-control" type="text" name="inputs[0][sks]" placeholder="Masukan jumlah sks" value="{{ $matkul->sks }}" disabled>
                                </div>
                            </div>
                            @if($matkul->status != 0 || $matkul->status != null)
                            <div class="col-md-2 mt-4">
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
                            </div>
                            @else
                            <div class="col-md-2 mt-4">
                                <div class="form-group">
                                    <a class="badge badge-pill badge-md bg-gradient-secondary mt-3" style="cursor: no-drop" disabled>
                                        <div class="ni ni-watch-time align-items-center d-flex "></div>
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                        @endforeach
                        
                        @foreach($logcomment as $comment)
                        <div class="row mt-2">
                            <label for="comment" class="form-control-label">Comment</label>
                            {{-- <textarea class="m-2" id="comment" name="comment" disabled>{{ $comment->body }}</textarea> --}}
                            <h5>{!! $logcomment[0]->body !!}</h5>
                        </div>
                        @endforeach
                    </div>
                    <hr class="horizontal dark">
                
                    <div class="row  mt-2">
                        <div class="col-12">
                    </div>
                    <div class="d-flex align-items-center ">
                        <div class="ms-md-auto d-flex">
                          {{-- <Button class="btn btn-primary align-items-center d-flex m-4 ">Submit</Button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>


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

// let counter = 1;
// function addmatkul(){
//     const album = document.getElementById("fieldrow");
//     counter++;
//     let html = '';
//     html += `<div class="row" id="row-matakuliah${counter}">`;
//         html += '<div class="col-md-5">';
//             html += '<div class="form-group">';    
//                 html += '<label for="matakuliah" class="form-control-label">Matakuliah</label>';
//                 html += '<input class="form-control" type="text">';        
//             html += '</div>';    
//         html += '</div>';

//         html += '<div class="col-md-5">';
//             html += '<div class="form-group">';    
//                 html += '<label for="example-text-input" class="form-control-label">SKS</label>';
//                 html += '<input class="form-control" type="text">';        
//             html += '</div>';    
//         html += '</div>';

//         html += '<div class="col-md-2 mt-4">';
//             html += '<div class="form-group">';    
//                 html += `<a class="btn btn-outline-primary remove" onclick="removeRow(row-matakuliah${counter})">`;
//                     html += '<div class="ni ni-fat-remove"></div>';
//                 html += '</a>';
//             html += '</div>';    
//         html += '</div>';
//     html += '</div>';
    
//     // $(`[id^=bantuan-bencana-row${newIndex}]:last`).find("a").each(function (index, label){
//     //         var onclick = $(this).attr("onclick").replace($(this).attr("onclick"), "removeRow('bantuan-bencana-row"+ newIndex +"')");
//     //         $(this).attr("onclick", onclick).attr("disabled", false).removeAttr("style").attr("style","cursor:pointer");
//     //     });

    
//     album.insertAdjacentHTML("beforeend", html)
// }
</script>

{{-- <script>
    function removeRow(rowid){
    var row = document.getElementById(rowid);
    row.outerHTML = "";
    // if(row != null && !row.getElementsByClassName( 'remove' )[0].hasAttribute("disabled")) row.outerHTML = "";
}
</script> --}}


@endsection