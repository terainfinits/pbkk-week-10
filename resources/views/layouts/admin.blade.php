<!-- resources/views/layouts/admin.blade.php -->
@extends('adminlte::page')

@section('title', config('app.name') . ' - Admin')

@section('content_header')
    <h1>@yield('page-title')</h1>
@stop

@section('content')
    @yield('content')
@stop

@push('css')
    {{-- extra CSS (if any) --}}
@endpush

@push('js')
    {{-- extra JS (if any) --}}
@endpush
