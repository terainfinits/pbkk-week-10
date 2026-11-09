<!-- resources/views/auth/login.blade.php (add quick‑login buttons) -->
{{-- existing login form stays unchanged --}}

<div class="mt-4 text-center">
    <p>Login cepat untuk demo:</p>
    <a href="{{ route('autologin', ['email' => 'admin@demo.local']) }}"
       class="btn btn-success btn-sm mr-2">Login Admin</a>
    <a href="{{ route('autologin', ['email' => 'staff@demo.local']) }}"
       class="btn btn-info btn-sm">Login Staf</a>
</div>
