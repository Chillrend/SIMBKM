<?php

namespace App\Exports;

use App\Models\Mbkm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class MahasiswaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                // $event->sheet->getDelegate()->getStyle($cellRange)->ge
            },
        ];
    }

     
    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Jurusan',
            'Prodi',
            'Semester',
            'Program',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Nama Perusahaan',
            'Lokasi Program',
            'Lokasi Mobilisasi',
            'Program Keberapa',
            'Dosen Pembimbing',
            'Pembimbing Industri',
            'Posisi'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data[] = [];
        $i = 0;
        $mahasiswa = Mbkm::with('dataFakultas')->with('dataJurusan')
                    ->with('dataProgram')
                    ->with('listUser')
                    ->with('listPI')
                    ->get();

        foreach($mahasiswa as $user){
            $data[$i] = [
                'Name' => $user->name,
                'Nim' => $user->nim,
                'Jurusan' => $user->dataFakultas->name,
                'Prodi' => $user->dataJurusan->name,
                'Semester' => $user->semester,
                'Program' => $user->dataProgram->name,
                'Tanggal_Mulai' => $user->tanggal_mulai,
                'Tanggal_Selesai' => $user->tanggal_selesai,
                'Nama Perusahaan' => $user->tempat_program_perusahaan,
                'Lokasi Program' => $user->lokasi_program,
                'Lokasi Mobilisasi' => $user->lokasi_mobilisasi,
                'Program_Keberapa' => $user->program_keberapa,
                'Dosen_Pembimbing' => $user->listUser->name,
                'Pembimbing_Industri' => $user->listPI->name,
                'Posisi' => $user->informasi_tambahan,
            ];
            $i++;
        }

        return collect($data);
    }
}
