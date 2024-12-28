@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="container h-100 d-flex align-items-center justify-content-center mt-5 pb-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-bold text-primary">Login</h3>
                </div>
                <div class="card-body">
                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input
                                class="form-control @error('email') is-invalid @enderror"
                                id="inputEmail"
                                type="email"
                                placeholder="name@gmail.com"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-group mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input
                                class="form-control @error('password') is-invalid @enderror"
                                id="inputPassword"
                                type="password"
                                placeholder="Password"
                                name="password"
                                required
                            />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input
                                class="form-check-input"
                                id="inputRememberPassword"
                                type="checkbox"
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            />
                            <label class="form-check-label" for="inputRememberPassword">Remember Me</label>
                        </div>

                        <!-- Login Button -->
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            {{-- <a class="small" href="{{ route('password.request') }}">Forgot Password?</a> --}}
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small">
                        {{-- <a href="{{ route('auth.register') }}">Need an account? Sign up!</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function saveFormData() {
        const formData = new FormData(document.getElementById('registrationForm'));
        const formObject = {};
        formData.forEach((value, key) => {
            formObject[key] = value;
        });
        localStorage.setItem('registrationFormData', JSON.stringify(formObject));
    }

    function loadFormData() {
        const savedData = JSON.parse(localStorage.getItem('registrationFormData'));
        if (savedData) {
            for (const key in savedData) {
                const input = document.querySelector(`[name=${key}]`);
                if (input) {
                    if (input.type === 'checkbox') {
                        input.checked = savedData[key] === 'on';
                    } else {
                        input.value = savedData[key];
                    }
                }
            }
        }
    }

    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pastikan semua data sudah benar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Daftar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                if (document.getElementById('saveData').checked) {
                    saveFormData();
                }
                this.submit();
            }
        });
    });

    window.addEventListener('load', loadFormData);

    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        localStorage.removeItem('registrationFormData');
    });
</script>
@endsection
