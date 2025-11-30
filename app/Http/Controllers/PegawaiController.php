<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
        public function index()
    {
       $pegawai = [
        'nama' => 'Annisa Putri Ananda',
        'tanggal_lahir' => '2006-09-09',
        'hobi' => ['membaca novel', 'main game', 'koleksi mainan', 'menggambar', 'ngoding'],
        'tgl_harus_wisuda' => '2028-01-01',
        'current_semester' => 3,
        'future_goal' => 'kaya'
       ];

        $birthdate = strtotime($pegawai['tanggal_lahir']);
        $current_date = time(); // Mengambil timestamp sekarang
        $age = floor(($current_date - $birthdate) / (60 * 60 * 24 * 365)); // Menghitung umur dalam tahun

        $wisuda_date = strtotime($pegawai['tgl_harus_wisuda']);
        $time_to_study_left = floor(($wisuda_date - $current_date) / (60 * 60 * 24)); // Menghitung selisih hari

        $semester_message = '';
        if ($pegawai['current_semester'] < 3) {
            $semester_message = "Masih Awal, Kejar TAK";
        } else {
            $semester_message = "Jangan main-main, kurang-kurangi main game!";
        }

         $data = [
            'name' => $pegawai['nama'],
            'my_age' => $age,
            'hobbies' => $pegawai['hobi'],
            'tgl_harus_wisuda' => $pegawai['tgl_harus_wisuda'],
            'time_to_study_left' => $time_to_study_left,
            'current_semester' => $pegawai['current_semester'],
            'semester_message' => $semester_message,
            'future_goal' => $pegawai['future_goal'],


        ];
        return view('test', $data);
    }
}
