<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Data User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS (optional) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Custom CSS */
    .user-management-container {
      margin-top: 3rem;
      margin-bottom: 3rem;
    }
    .user-management-header h2 {
      font-weight: 700;
      color: #343a40;
    }
    .btn-add-user {
      font-size: 1rem;
      padding: 0.5rem 1rem;
    }
    .user-table {
      font-size: 0.95rem;
    }
    .user-table th,
    .user-table td {
      vertical-align: middle !important;
      text-align: center;
    }
    .action-btn {
      margin: 0 2px;
    }
  </style>
</head>
<body>
  <div class="container user-management-container">
    <div class="d-flex justify-content-between align-items-center mb-4 user-management-header">
      <h2 class="mb-0">Manajemen Data User</h2>
      <a href="{{ route('checklists.index') }}" class="btn btn-danger">
        <i class="fas fa-rows"></i> Halaman Checklist
      </a>
      <a href="{{ route('users.create') }}" class="btn btn-success btn-add-user">
        <i class="fas fa-user-plus"></i> Tambah User
      </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover user-table">
            <thead class="table-dark">
              <tr>
                <th scope="col" style="width:5%;">#</th>
                <th scope="col" style="width:25%;">Nama</th>
                <th scope="col" style="width:30%;">Email</th>
                <th scope="col" style="width:20%;">Role</th>
                <th scope="col" style="width:20%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $index => $user)
              <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? '-' }}</td>
                <td>
                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm action-btn">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline action-btn" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div> <!-- .table-responsive -->
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (dengan Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
