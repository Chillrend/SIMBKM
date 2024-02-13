@extends('layout.dashboard')
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
              <div class="justify-content-between d-flex">
                <h4>Data Mahasiswa</h4>
                <div class="btn-container ms-md-auto d-flex align-items-center justify-content-center">
                  <label class="switch btn-color-mode-switch">
                        <input value="1" id="pilihan" name="pilihan" type="checkbox" onclick="ci()">
                        <label class="btn-color-mode-switch-inner" data-off="MBKM" data-on="Jurusan" for="pilihan"></label>
                  </label>
                  <a href="/export_excel" class="btn btn-success my-0 mx-2" target="_blank">EXPORT EXCEL</a>

              </div>
              </div>
              <form action="/dashboard/wadir">
                <div class="ms-md-auto d-flex mt-3">
                  <div id="tombol-filter" class="d-flex w-30 ">
                    <select class="form-select @error('fakultas') is-invalid @enderror px-4 w-100" id="fakultas" name="fakultas" onchange="jurusan()">
                      <option value=""disabled selected>Pilih Jurusan</option>
                      @foreach($fakultas as $data)
                          <option value="{{ $data->nama_jurusan }}">{{ $data->nama_jurusan }}</option>
                      @endforeach
                    </select>
                  </div>
                  <input type="text" class="form-control" placeholder="Search.." name="search" id="search" value="{{ request('search') }}">
                  <button class="btn btn-primary mb-0" type="submit" >Search</button>
                </div>

              </form>

            </div>

            <div class="card-body">
                <div id="canvas">
                    <canvas id="myChart"></canvas>
                </div>
                @if($mahasiswa->count())
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" >
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Nama</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Jurusan</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Prodi</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Program</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Program</th>
                        <th class="text-secondary opacity-7 ">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h3 class="mt-5">List Mahasiswa</h3>
                      @foreach($mahasiswa as $data)
                          <tr>
                              <td class="align-middle text-center text-sm ">
                                  <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                  <p class="text-xs font-weight-bold mb-0">{{ $data->namaUser->name }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->namaUser->dataFakultas()->nama_jurusan }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->namaUser->dataJurusan()->nama_prodi }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->dataProgram->name }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->program_keberapa }}</p>
                              </td>
                              <td class="text-sm text-center">
                                  <a href="/dashboard/wadir/{{ $data->id }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-eye" style="color: #3eeefe;"></i></a>
                              </td>
                        @endforeach
                    </tbody>
                  </table>
              </div>
                @else
                <h3>Belum Ada Mahasiswa</h3>
                <hr class="horizontal dark mt-0">
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let toogle = 0;

    function mbkm() {
      document.getElementById('canvas').innerHTML ="<canvas id='myChart'></canvas>";
          let selected = document.getElementById("fakultas").value;
          const ctx = document.getElementById('myChart');

    var value = {!! json_encode($jumlahData[0], JSON_HEX_TAG) !!};
  var label = [];
  var data = [];
  var backgroundColor = [];


  for(i=0; i<value.length; i++){
    label.push(value[i].label)
    data.push(value[i].total)
    backgroundColor.push('rgba(54, 162, 235, 0.2)');

  }

    new Chart(ctx, {
          type: 'bar',
          data: {
            labels: label,
            datasets: [{
              label: 'Total Mahasiswa',
              data: data,
              backgroundColor: backgroundColor, // Set the consistent colors
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    }
    mbkm();

        function jurusan() {
          document.getElementById('canvas').innerHTML ="<canvas id='myChart'></canvas>";
          let selected = document.getElementById("fakultas").value;
          const ctx = document.getElementById('myChart');
          var label = [];
          var data = [];
          var backgroundColor = [];

          if (document.getElementById("fakultas").value == "") {
            var value = {!! json_encode($jumlahData[1], JSON_HEX_TAG) !!};
            for(i=0; i<value.length; i++){
                label.push(value[i].jurusan)
                data.push(value[i].total)
                backgroundColor.push('rgba(54, 162, 235, 0.2)');
             }
          } else {
            var value = {!! json_encode($jumlahData[2], JSON_HEX_TAG) !!};
            console.log(value);
              for(i=0; i<value.length; i++){
                if(value[i].jurusan == selected){
                label.push(value[i].program_studi)
                data.push(value[i].total)
                backgroundColor.push('rgba(54, 162, 235, 0.2)');
              }
            }
          }

          new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: label,
                  datasets: [{
                    label: 'Total Mahasiswa',
                    data: data,
                    backgroundColor: backgroundColor, // Set the consistent colors
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });

        }


function ci() {
  switch (toogle) {
    case 0:
      toogle = 1;
      document.getElementById('fakultas').setAttribute("hidden", '')
      document.getElementById('tombol-filter').setAttribute('class', 'd-flex w-0')
      document.getElementById("tombol-filter").style.transition = "all 0.3s ease";
      document.getElementById('fakultas').getElementsByTagName('option')[0].selected = 'selected';
      jurusan();
      break;

    case 1:
      toogle = 0;
      document.getElementById('tombol-filter').setAttribute('class', 'd-flex w-30')
      document.getElementById("tombol-filter").style.transition = "all 0.3s ease";
      document.getElementById('fakultas').getElementsByTagName('option')[0].selected = 'selected';
      document.getElementById('fakultas').removeAttribute("hidden")
      mbkm();
      break;

    default:
      break;
  }
}
  </script>
@endsection
