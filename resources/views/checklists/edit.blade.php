<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Checklist</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (optional) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <style>
    /* Styling Halaman */
    body {
      background-color: #f8f9fa;
    }
    
    .edit-checklist-container {
      max-width: 800px;
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

    .checkbox-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .form-check {
      flex: 1 1 30%;
    }

    .alert ul {
      margin-bottom: 0;
    }
  </style>
</head>
<body>

  <div class="container edit-checklist-container">
    <div class="card shadow">
      <div class="card-header bg-primary text-white text-center">
        <h3 class="mb-0">
          <i class="fas fa-edit"></i> Edit Checklist
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

        <form action="{{ route('checklists.update', $checklist->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-4">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" 
                     value="{{ old('tanggal', $checklist->tanggal) }}" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Bulan</label>
              <select class="form-control" name="bulan" required>
                @foreach (range(1, 12) as $month)
                  <option value="{{ $month }}" 
                    {{ old('bulan', $checklist->bulan) == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::createFromFormat('m', str_pad($month, 2, '0', STR_PAD_LEFT))->format('F') }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Tahun</label>
              <select class="form-control" name="tahun" required>
                @for ($year = 2025; $year <= date('Y'); $year++)
                  <option value="{{ $year }}" {{ old('tahun', $checklist->tahun) == $year ? 'selected' : '' }}>
                    {{ $year }}
                  </option>
                @endfor
              </select>
            </div>
          </div>

          <!-- Input Jam Inspeksi -->
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="form-label">Jam Inspeksi</label>
              <select class="form-control" name="jam_inspeksi" required>
                @foreach (['07:00', '09:00', '11:00', '14:00', '17:00'] as $time)
                  <option value="{{ $time }}" {{ old('jam_inspeksi', $checklist->jam_inspeksi) == $time ? 'selected' : '' }}>
                    {{ $time }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama PIC</label>
              <input type="text" class="form-control" name="nama_pic" 
                     value="{{ old('nama_pic', $checklist->nama_pic) }}" required>
            </div>
          </div>

          <!-- Input Area dan Deskripsi Pekerjaan -->
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="form-label">Area</label>
              <select class="form-control" name="area" required>
                @foreach (['Area 1', 'Area 2', 'Area 3'] as $area)
                  <option value="{{ $area }}" {{ old('area', $checklist->area) == $area ? 'selected' : '' }}>
                    {{ $area }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Notes</label>
              <input type="text" class="form-control" name="deskripsi_pekerjaan" 
                     value="{{ old('deskripsi_pekerjaan', $checklist->deskripsi_pekerjaan) }}" required>
            </div>
          </div>

          <!-- Checklist Pekerjaan -->
          <div class="mb-3 mt-3">
            <label class="form-label">Checklist Pekerjaan:</label>
            <div class="checkbox-wrapper">
              @php
                $daftarPekerjaan = [
                  'Cermin', 'Pintu Masuk', 'Platfon', 'Kap Lampu', 'Dinding Kubikal',
                  'Wastafel', 'Accesories Toilet', 'Tempat Sampah', 'Closet', 'Exhaust Fan',
                  'Lantai', 'Floordrain', 'Flushing', 'Urinoir', 'Hand Soap', 'Tissue', 'Keset'
                ];
              @endphp
              @foreach ($daftarPekerjaan as $item)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="status_pekerjaan[]" 
                         value="{{ $item }}"
                         {{ is_array(old('status_pekerjaan', $checklist->status_pekerjaan)) && in_array($item, old('status_pekerjaan', $checklist->status_pekerjaan)) ? 'checked' : '' }}>
                  <label class="form-check-label">{{ $item }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-custom">
            <i class="fas fa-save"></i> Update
          </button>

          <a href="{{ route('checklists.index') }}" class="btn btn-secondary btn-custom mt-2">
            <i class="fas fa-arrow-left"></i> Batal
          </a>

        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (dengan Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
