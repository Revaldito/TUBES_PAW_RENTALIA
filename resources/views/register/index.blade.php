<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Daftar Akun - Rentalia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .full-height { min-height: 100vh; }

        .form-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            background-color: #ffffff;
        }

        .side-banner {
            background: linear-gradient(rgba(0, 123, 255, 0.7), rgba(0, 56, 117, 0.8)), 
                        url('https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&q=80&w=1200');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 10%;
            color: white;
        }

        .form-wrapper { width: 100%; max-width: 420px; }

        .form-control {
            border-radius: 12px;
            padding: 14px 18px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.1);
            border-color: #007bff;
            transform: translateX(5px);
        }

        .btn-primary {
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .label-custom {
            font-weight: 600;
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .animate__animated { --animate-duration: 0.9s; }
    </style>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="row g-0 full-height">
            
            <div class="col-lg-5 col-md-12 form-section animate__animated animate__fadeInLeft">
                <div class="form-wrapper">
                    <div class="mb-5">
                        <h2 class="fw-bold text-dark mb-2">Daftar Akun</h2>
                        <p class="text-muted">Bergabunglah dan mulai petualangan Anda bersama Rentalia.</p>
                    </div>

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="label-custom">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="label-custom">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="name@example.com" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="label-custom">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Min. 8 Karakter" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow-sm mb-4">BUAT AKUN</button>
                        
                        <div class="text-center">
                            <p class="text-muted small">Sudah memiliki akun? 
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Login Disini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-flex side-banner animate__animated animate__fadeIn">
                <div class="text-end w-100">
                    <h1 class="display-3 fw-bold mb-3">Nikmati Perjalanan.</h1>
                    <p class="fs-4 fw-light opacity-75">Sewa mobil lebih mudah dan cepat melalui genggaman Anda.</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>