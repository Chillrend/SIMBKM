<?php

namespace Database\Seeders;

use App\Models\ProgramMbkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramMBKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramMbkm::create([
            'name' => 'Kampus Mengajar',
            'deskripsi' => 'Kampus Mengajar merupakan kanal pembelajaran yang memberikan kesempatan kepada mahasiswa untuk belajar di luar kampus selama satu semester guna melatih kemampuan menyelesaikan permasalahan yang kompleks dengan menjadi mitra guru untuk berinovasi dalam pembelajaran, pengembangan strategi, dan model pembelajaran yang kreatif, inovatif, dan menyenangkan.',
            'fotoikon' => 'img/NwQUeST6GdC3iOlT9V7EJABx0Zk5yylfYxQy9s84.jpg',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'MSIB (Magang)',
            'deskripsi' => 'Magang Bersertifikat adalah bagian dari program kampus merdeka yang bertujuan untuk memberikan kesempatan kepada mahasiswa belajar dan mengembangkan diri melalui aktivitas diluar kelas perkuliahan. Di program ini, mahasiswa akan mendapatkan pengalaman kerja di industri/dunia profesi selama 1 hingga 2 semester. Dengan pembelajaran langsung di tempat kerja mitra magang, mahasiswa akan mendapatkan hard skills maupun soft skills yang akan menyiapkan mahasiswa agar lebih siap untuk memasuki dunia kerja dan karirnya',
            'fotoikon' => 'img/GGiqfewLWL0gGT6ZPc0zV1xMnEg1vqGZ9ixVFlPk.png',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'MSIB (Studi Independent)',
            'deskripsi' => 'Studi Independen Bersertifikat adalah bagian dari program kampus merdeka yang bertujuan untuk memberikan kesempatan kepada mahasiswa untuk belajar dan mengembangkan diri melalui aktivitas diluar kelas perkuliahan, namun tetap diakui sebagai bagian dari perkuliahan. Program ini diperuntukan bag mahasiswa yang ingin memperlengkapi dirinya dengan menguasai kompetensi spesifik dan praktis yang juga dicari oleh dunia usaha maupun dunia industri.',
            'fotoikon' => 'img/gKEGDT71TpWFY7MS0gGN0lr3ZriUVwuZL1xNf6S9.png',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Pertukaran Mahasiswa Merdeka (PMM)',
            'deskripsi' => 'Pertukaran Mahasiswa Merdeka merupakan sebuah program mobilitas mahasiswa selama satu semester untuk mendapatkan pengalaman belajar di perguruan tinggi di Indonesia sekaligus memperkuat persatuan dalam keberagaman.',
            'fotoikon' => 'img/rJlBHvUvYusRIptNTIsEG4bnHfJSgXvgxWcM4mr0.jpg',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Wirausaha Merdeka',
            'deskripsi' => 'WIrausaha Merdeka merupakan program bermanfaat yang akan mengantarkan para mahasiswa untuk menjadi wirausahawan dan wirausahawati yang handal dan akan dibantu oleh perguruan tinggi terbaik yang sudah melalui proses seleksi.',
            'fotoikon' => 'img/xiAIK4j312y6X7iF8VUTS6Igv6UVwgwOjUBJSoCG.jpg',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'IISMA (Indonesian International Student Mobility Awards)',
            'deskripsi' => 'IISMA merupakan bagian dari program Kampus Merdeka atau MBKM dari Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia (Kemendikbudristek RI). Tujuannya untuk membiayai mahasiswa Indonesia dalam program mobilitas internasional ke perguruan tinggi dan industri terbaik dunia.',
            'fotoikon' => 'img/JMZuxbkMpkKi9vJfo4Gcdzkx9JYzZ6axS3pYUENF.jpg',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Bangkit Academy',
            'deskripsi' => 'Aktivitas Studi Independen Pengembang Machine Learning meliputi pembelajaran individu dan project akhir dalam bentuk tim. Pada pembelajaran individu, setiap peserta akan mengikuti kelas dalam bentuk asynchronous (online melalui modul belajar di Dicoding Academy and Coursera) dimana peserta dapat berkonsultasi dengan expert terkait materi yang dipelajarinya melalui forum diskusi.',
            'fotoikon' => 'img/lARA4mIGH1SvbnSd2O3jqNf4Omu4Vz2pxVYh1TYp.jpg',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Praktisi Mengajar',
            'deskripsi' => 'Praktisi Mengajar adalah Program yang diinisiasi oleh Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia agar lulusan perguruan tinggi lebih siap untuk masuk ke dunia kerja. Program ini mendorong kolaborasi aktif praktisi ahli dengan dosen juara agar tercipta pertukaran ilmu dan keahlian yang mendalam dan bermakna antar sivitas akademika di perguruan tinggi dan profesional di dunia kerja. Kolaborasi ini dilakukan dalam mata kuliah yang disampaikan di ruang kelas baik secara luring maupun daring.',
            'fotoikon' => 'img/ZS0EYAoaqqi2jmNDBH2t7gktDaUtpYP5xBwia8R8.jpg',
            'status' => 'Aktif'
        ]);

        ProgramMbkm::create([
            'name' => 'Gerilya',
            'deskripsi' => 'Gerilya merupakan program yang disiapkan oleh Kementerian Energi dan Sumber Daya Mineral untuk diimplementasikan pada Merdeka Belajar Kampus Merdeka Kementerian Pendidikan Kebudayaan, Riset dan Teknologi. MSIB Gerilya adalah program magang yang diakselerasikan dengan pengalaman belajar yang dirancang dan dibuat khusus berdasarkan tantangan nyata yang dihadapi oleh mitra/industri.',
            'fotoikon' => 'img/wNr8PsTPJzO634amjfPAPSxAse2gU56JR854fN54.jpg',
            'status' => 'Aktif'
        ]);
    }
}
