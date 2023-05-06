@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" style="max-width: 200px">
                            </div>
                            <form class="user my-5" action="{{ route('register') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan Nama" value="{{ old('nama', '') }}">
                                    <x-errormessage error="nama" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan Email" value="{{ old('email', '') }}">
                                    <x-errormessage error="email" />
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control password @error('password') is-invalid @enderror"
                                            placeholder="Masukkan Password">
                                        <div class="input-group-append toggle-password">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye-slash toggle-password-icon"></i>
                                            </span>
                                        </div>
                                        <x-errormessage error="password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation"
                                            class="form-control password @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Konfirmasi Password">
                                        <div class="input-group-append toggle-password">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye-slash toggle-password-icon"></i>
                                            </span>
                                        </div>
                                        <x-errormessage error="password_confirmation" />
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
                            </form>
                            <div class="text-center">
                                Sudah mempunyai akun? <a class="font-weight-bold small"
                                    href="{{ route('login') }}">Masuk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
            let icon = $('.toggle-password-icon');
            $('.toggle-password').click(function(){
                let password = $('.password');
                if(password.attr("type") == "password") {
                    password.attr("type","text");
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    password.attr("type","password");
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            })
        });
</script>
@endpush