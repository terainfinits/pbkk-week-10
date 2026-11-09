<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:manage mahasiswa');
    }

    public function index(Request $request)
    {
        $query = Mahasiswa::query()
            ->when($request->filled('nama'), fn($q) => $q->where('nama', 'like', "%{$request->nama}%"))
            ->when($request->filled('npm'), fn($q) => $q->where('npm', $request->npm));

        $mahasiswas = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString(); // keep filters on pagination

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }
}
