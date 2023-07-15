@extends('layout.dashboard')
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
              <div class="ms-md-auto d-flex">
                <h4>Data Mahasiswa</h4>
                <a href="/export_excel" class="btn btn-success ms-md-auto" target="_blank">EXPORT EXCEL</a>
              </div>
              <form action="/dashboard/wadir">
                <div class="input-group ms-md-auto d-flex mt-3">
                  <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                  <button class="btn btn-primary mb-0" type="submit" >Search</button>
                </div>
              </form>
              
            </div>

            <div class="card-body">
                <div>
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
                                  <p class="text-xs font-weight-bold mb-0">{{ $data->name }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->dataFakultas->name }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->dataJurusan->name }}</p>
                              </td>
                              <td class="text-sm text-center ">
                                <p class="text-xs font-weight-bold mb-0">{{ $data->dataProgram->name }}</p>
                              </td>
                              <td class="text-sm text-center">
                                  <a href="/dashboard/pa/{{ $data->user }}" ><span class="badge badge-primary"></span><i class="fa fa-regular fa-eye" style="color: #3eeefe;"></i></a>
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
    const ctx = document.getElementById('myChart');
  
    var value = {!! json_encode($jumlahData, JSON_HEX_TAG) !!};

  var label = [];
  var data = [];

  for(i=0; i<value.length; i++){
    label.push(value[i].label)
    data.push(value[i].total)
  }

    new Chart(ctx, {
          type: 'bar',
          data: {
            labels: label,
            datasets: [{
              label: 'Total Mahasiswa',
              data: data,
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
  </script>
@endsection