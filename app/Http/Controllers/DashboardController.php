<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // Ganti dengan model yang sesuai

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $data = Siswa::all(); // Contoh: Mengambil semua data dari tabel

        // Kirim data ke view
        return view('dashboard', compact('data'));
    }
}