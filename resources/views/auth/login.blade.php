<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Masuk - Toko Online Kami</title>

    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            margin-top: 5%;
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        /* Sisi Kiri: Banner Toko */
        .brand-bg {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e53 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        /* Tombol melengkung khas aplikasi modern */
        .btn-brand {
            background: #ff6b6b;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-brand:hover {
            background: #ee5253;
            color: white;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        .form-control-custom {
            border-radius: 30px;
            padding: 1.5rem 1.2rem;
            border: 1px solid #ced4da;
        }
        .form-control-custom:focus {
            border-color: #ff6b6b;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
        }
    </style>
</head>

<body>

    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-12">
                
                <div class="card card-login">
                    <div class="row no-gutters">
                        
                        <!-- Sisi Kiri: Branding Toko (Akan sembunyi di HP) -->
                        <div class="col-lg-5 d-none d-lg-flex brand-bg text-center">
                            <i class="fas fa-shopping-bag fa-4x mb-3 animate__animated animate__bounceIn"></i>
                            <h2 class="font-weight-bold">Yuk, Belanja!</h2>
                            <p class="small opacity-75">Masuk untuk melihat promo terbaru, memantau pesanan, dan menikmati kemudahan berbelanja.</p>
                            <a href="/dashboard" class="btn btn-outline-light btn-sm rounded-pill px-3 mt-3">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Toko
                            </a>
                        </div>

                        <!-- Sisi Kanan: Form Login -->
                        <div class="col-lg-7">
                            <div class="card-body p-5">
                                
                                <div class="text-left mb-4">
                                    <h3 class="font-weight-bold text-gray-900 mb-1">Selamat Datang Kembali</h3>
                                    <p class="text-muted small">Silakan masuk ke akun Anda</p>
                                </div>

                                <!-- Form Login Laravel -->
                                <form action="/login" method="POST">
                                    @csrf
                                    
                                    <!-- Input Email / Username -->
                                    <div class="form-group mb-3">
                                        <label for="username" class="small font-weight-bold text-muted">Email atau Username</label>
                                        <div class="input-group">
                                            <input type="text" name="username" class="form-control form-control-custom"
                                                id="username" placeholder="contoh: budi123 atau budi@email.com" required autocomplete="username">
                                        </div>
                                    </div>

                                    <!-- Input Password -->
                                    <div class="form-group mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="small font-weight-bold text-muted">Password</label>
                                            <a class="small text-muted" href="/forgot-password">Lupa Password?</a>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-custom"
                                            id="password" placeholder="Masukkan password Anda" required autocomplete="current-password">
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group my-4">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                            <label class="custom-control-label text-muted" for="remember_me">Ingat Saya di Perangkat Ini</label>
                                        </div>
                                    </div>

                                    <!-- Tombol Masuk -->
                                    <button type="submit" class="btn btn-brand btn-block shadow-sm">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk Sekarang
                                    </button> 
                                </form>

                                <hr class="my-4">

                                <!-- Link Registrasi Belum Punya Akun -->
                                <div class="text-center">
                                    <p class="small text-muted mb-0">Belum punya akun toko? 
                                        <a class="font-weight-bold" style="color: #ff6b6b;" href="/register">Daftar Sekarang</a>
                                    </p>
                                </div>

                            </div>
                        </div> <!-- /Sisi Kanan -->

                    </div>
                </div> <!-- /Card -->

            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>