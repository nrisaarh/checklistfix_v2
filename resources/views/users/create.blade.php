<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (optional) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <style>
    /* Styling Halaman */
    body {
      background-color: #f8f9fa;
    }
    
    .create-user-container {
      max-width: 600px;
      margin: 50px auto;
    }

    .card {
      border-radius: 10px;
      overflow: hidden;
    }

    .card-header {
      font-size: 1.25rem;
      font-weight: bold;
    }

    .btn-custom {
      width: 100%;
    }

    .alert ul {
      margin-bottom: 0;
    }
  </style>
</head>
<body>

  <div class="container create-user-container">
    <div class="card shadow">
      <div class="card-header bg-primary text-white text-center">
        <h3 class="mb-0">
          <i class="fas fa-user-plus"></i> Tambah User Baru
        </h3>
      </div>
      <div class="card-body">
        
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" value="{{ old('name') }}" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
          </div>

          <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-select" required>
              <option value="">Pilih Role</option>
              @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-custom">
              <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-custom">
              <i class="fas fa-arrow-left"></i> Batal
            </a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (dengan Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
