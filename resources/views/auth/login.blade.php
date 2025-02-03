<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .login-container {
      background: rgba(255, 255, 255, 0.8); /* Transparan putih */
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      padding: 30px;
      width: 90%;
      max-width: 800px;
    }
    .login-image {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        text-align: center;
      }
      .login-image {
        max-width: 80%;
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
  <div class="login-container row align-items-center d-flex justify-content-center text-center">
    <div class="col-md-6 d-flex justify-content-center">
      <img src="{{ asset('login.jpg') }}" alt="Login Image" class="login-image">
    </div>
    <div class="col-md-6">
      <h2 class="mb-4">Login</h2>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3 text-start">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <p class="mt-3">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
  </div>
</body>
</html>
