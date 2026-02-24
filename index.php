<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library | Digital School Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Background with School Imagery */
        .bg-hero {
            background: linear-gradient(rgba(0, 51, 102, 0.8), rgba(0, 51, 102, 0.8)), 
                        url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .btn-primary {
            background-color: #003366;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #002244;
        }

        .header-text {
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            margin-bottom: 50px;
        }

        .icon-box {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #003366;
        }
    </style>
</head>

<body>
    <div class="bg-hero">
        <div class="container text-center">
            <div class="header-text">
                <h1 class="display-4 fw-bold">PORTAL PERPUSTAKAAN DIGITAL</h1>
                <p class="lead">Selamat Datang di Sistem Informasi Literasi Sekolah</p>
            </div>

            <div class="row justify-content-center g-4">
                <div class="col-md-4 col-lg-3">
                    <div class="card glass-card p-4">
                        <div class="icon-box">👥</div>
                        <h4 class="fw-bold">Pustakawan</h4>
                        <p class="text-muted small">Akses khusus pengelola dan administrasi data buku.</p>
                        <a href="login-admin.php" class="btn btn-primary w-100">LOGIN ADMIN</a>
                    </div>
                </div>
                
                <div class="col-md-4 col-lg-3">
                    <div class="card glass-card p-4">
                        <div class="icon-box">📖</div>
                        <h4 class="fw-bold">Anggota</h4>
                        <p class="text-muted small">Akses untuk siswa dan guru meminjam koleksi digital.</p>
                        <a href="login-anggota.php" class="btn btn-primary w-100">LOGIN ANGGOTA</a>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-white-50">
                <small>&copy; 2026 SMK NEGERI 9 BANDAR LAMPUNG. All Rights Reserved.</small>
            </div>
        </div>
    </div>
</body>

</html>