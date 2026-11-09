<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    {{-- Widget 1 – Users --}}
    <div class="col-lg-4 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $stats['users'] }}</h3>
                <p>Pengguna Terdaftar</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                Lihat Semua <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Widget 2 – Mahasiswa --}}
    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['mahasiswa'] }}</h3>
                <p>Mahasiswa</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="{{ route('admin.mahasiswa.index') }}" class="small-box-footer">
                Lihat Daftar <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- Widget 3 – Mata Kuliah --}}
    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['matakuliah'] }}</h3>
                <p>Mata Kuliah</p>
            </div>
            <div class="icon"><i class="fas fa-book"></i></div>
            <a href="{{ route('admin.matakuliah.index') }}" class="small-box-footer">
                Lihat Semua <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection
