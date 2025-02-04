<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (optional) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <style>
    /* Custom Styling */
    body {
      background-color: #f8f9fa;
    }
    
    .edit-user-container {
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

  <div class="container edit-user-container">
    <div class="card shadow">
      <div class="card-header bg-warning text-dark text-center">
        <h3 class="mb-0">
          <i class="fas fa-edit"></i> Edit User
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

        <form action="{{ route('users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" value="{{ old('name', $user->name) }}" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
          </div>

          <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-select" required>
              <option value="">Pilih Role</option>
              @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengganti)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru">
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password baru">
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-custom">
              <i class="fas fa-save"></i> Update
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
