<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Sistem</title>
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body, html {
      background-color: rgb(69, 143, 196);
      height: 100%;
      /* background-image: url('https://images.unsplash.com/photo-1658218615053-955e8af55947?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170');  */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-card {
      background-color: rgba(255, 255, 255, 0.95); /* Kotak login putih dengan sedikit transparansi untuk efek menarik */
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      width: 350px;
      color: #333; /* Warna teks gelap untuk kontras */
      backdrop-filter: blur(10px); /* Efek blur untuk membuatnya lebih menarik */
    }
    .login-card label {
      font-weight: 600;
      color: #333;
    }
    .form-control {
      border-radius: 0.3rem;
    }
    .btn-primary {
      background-color: #007bff; /* Tetap biru untuk tombol */
      border-color: #007bff;
      font-weight: 600;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    #errorMessage {
      font-weight: 600;
      color: #dc3545; /* Merah untuk error */
    }
  </style>
</head>
<body>

  <div class="login-card shadow">
    <h3 class="mb-4 text-center">Login Sistem</h3>
    <form id="loginForm" autocomplete="off">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" id="username" class="form-control" placeholder="Masukkan username" required />
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Masukkan password" required />
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <div id="errorMessage" class="mt-3 text-center d-none">Username atau password salah.</div>
    </form>
  </div>

</body>
</html>
