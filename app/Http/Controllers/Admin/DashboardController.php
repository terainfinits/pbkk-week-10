<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view dashboard');
    }

    public function index()
    {
        $stats = [
            'users'      => User::count(),
            'mahasiswa'  => Mahasiswa::count(),
            'matakuliah' => Matakuliah::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
