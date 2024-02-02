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
            <div class="card-header">
                <div class="ms-md-auto d-flex">
                    <h4>Data MBKM Mahasiswa</h4>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Siswa</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Perusahaan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Program</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($programMbkm as $program)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-sm text-start">
                                    <p class="text-xs font-weight-bold mb-0">{{ $program->namaUser->name }}</p>
                                </td>
                                <td class="text-sm text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $program->tempat_program_perusahaan }}</p>
                                </td>
                                <td class="text-sm text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $program->dataProgram->name }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                <td>
                                    <a href="/dashboard/informasi-mbkm/{{ $program->id }}">
                                        <span class="badge badge-primary"></span>
                                        <i class="fa fa-regular fa-eye" style="color: #3eeefe;"></i>
                                    </a>
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection