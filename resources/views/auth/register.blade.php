<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .register-container {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 90%;
      max-width: 800px;
    }
    .register-image {
      width: 100%;
      max-height: 400px;
      border-radius: 10px;
      object-fit: cover;
    }
    .form-control {
      border: 1px solid #ced4da;
    }
    .btn-custom {
      background: #007bff;
      border: none;
      font-weight: 600;
      transition: 0.3s;
      color: white;
    }
    .btn-custom:hover {
      background: #0056b3;
    }
    @media (max-width: 768px) {
      .register-container {
        text-align: center;
      }
      .register-image {
        max-width: 80%;
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
  <div class="register-container row align-items-center d-flex justify-content-center text-center">
    <div class="col-md-6 d-flex justify-content-center">
      <img src="{{ asset('register.jpg') }}" alt="Register Image" class="register-image" />
    </div>
    <div class="col-md-6">
      <h2 class="mb-4">Register</h2>
      <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3 text-start">
          <label class="form-label">Nama</label>
          <input type="text" class="form-control" name="name" required />
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required />
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required />
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" name="password_confirmation" required />
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-custom">Register</button>
        </div>
      </form>
      <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
    </div>
  </div>
</body>
</html>
