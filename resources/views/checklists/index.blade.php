<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Checklist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle (dengan Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2,
        h3 {
            color: #343a40;
            font-weight: 600;
        }

        .form-label {
            font-size: 1.1rem;
            font-weight: 500;
            color: #495057;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .table {
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .table td {
            background-color: #ffffff;
        }

        .table-sm td,
        .table-sm th {
            padding: 8px;
        }

        .form-check-label {
            font-size: 1rem;
            color: #495057;
        }

        .form-check-input {
            transform: scale(1.3);
        }

        .form-check {
            margin-bottom: 10px;
        }

        .checkbox-wrapper {
            display: grid;
            grid-template-columns: 2fr 4fr 4fr;
            /* Two columns */
            gap: 10px;
        }

        .checkbox-wrapper .form-check {
            width: 100%;
        }

        hr {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .table-sm {
            border: none;
        }

        .status-checkbox {
            width: 20px;
            height: 20px;
        }

        .table-sm tr td:first-child {
            font-weight: 500;
        }

        .status-column {
            text-align: left;
        }

        .table td {
            padding: 8px 10px;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar .navbar-brand {
            color: #ffffff;
            font-size: 1.5rem;
        }

        .navbar .navbar-nav .nav-item .nav-link {
            color: #ffffff;
            font-size: 1rem;
        }

        .navbar .navbar-nav .nav-item .nav-link:hover {
            color: #d3d3d3;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            /* Warna biru */
            color: white;
            /* Warna teks menjadi putih */
            font-weight: bold;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #d1e7fd;
            /* Warna biru terang untuk baris ganjil */
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #c3daf9;
            /* Warna biru lebih gelap untuk baris genap */
        }

        .table-striped tbody tr:hover {
            background-color: #a6c8f7;
            /* Warna biru ketika baris di-hover */
        }
    </style>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('logo checklist.png') }}" alt="Logo" height="50">
                </a>
                <!-- Tombol toggler untuk tampilan responsif -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Konten Navbar (yang akan collapse) -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <!-- Tampilkan link User Management hanya untuk role_id 1 -->
                        @if (Auth::user()->role_id == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users') }}">User Management</a>
                            </li>
                        @endif
                        <!-- Tambahkan link navigasi lain jika diperlukan -->
                    </ul>
                    <div class="d-flex">
                        <span class="navbar-text me-3 text-white">
                            Hi, {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>


        <div class="container mt-4 mb-4">
            <h2>Manajemen Checklist</h2>
            <form action="{{ route('checklists.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Bulan</label>
                        <select class="form-control form-control-sm" name="bulan" required>
                            @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}">
                                    {{ \Carbon\Carbon::createFromFormat('m', $month)->format('F') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tahun</label>
                        <select class="form-control form-control-sm" name="tahun" required>
                            @for ($year = 2025; $year <= date('Y'); $year++)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>

                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Jam Inspeksi</label>
                        <select class="form-control form-control-sm" name="jam_inspeksi" required>
                            <option value="07:00">07:00</option>
                            <option value="09:00">09:00</option>
                            <option value="11:00">11:00</option>
                            <option value="14:00">14:00</option>
                            <option value="17:00">17:00</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama PIC</label>
                        <input type="text" class="form-control form-control-sm" name="nama_pic" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Area</label>
                        <select class="form-control form-control-sm" name="area" required>
                            <option value="Area 1">Area 1</option>
                            <option value="Area 2">Area 2</option>
                            <option value="Area 3">Area 3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Notes</label>
                        <input type="text" class="form-control form-control-sm" name="deskripsi_pekerjaan" required>
                    </div>
                </div>


                <div class="mb-3 mt-3">
                    <label class="form-label">Checklist Pekerjaan =</label>
                    <div class="checkbox-wrapper">
                        @foreach (['Cermin', 'Pintu Masuk', 'Platfon', 'Kap Lampu', 'Dinding Kubikal', 'Wastafel', 'Accesories Toilet', 'Tempat Sampah', 'Closet', 'Exhaust Fan', 'Lantai', 'Floordrain', 'Flushing', 'Urinoir', 'Hand Soap', 'Tissue', 'Keset'] as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status_pekerjaan[]"
                                    value="{{ $item }}">
                                <label class="form-check-label">{{ $item }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 d-block">Simpan</button>
            </form>
            <hr>

            {{-- <h3>Daftar Checklist</h3> --}}
            <div class="container mt-4 mb-4">
                <h3>Daftar Checklist</h3>

                <form action="{{ route('checklists.index') }}" method="GET" class="row g-2 mb-3">
                    <!-- Filter Nama PIC -->
                    <div class="col-md-3">
                        <label for="nama_pic" class="form-label">Filter Nama PIC</label>
                        <input type="text" name="nama_pic" id="nama_pic" class="form-control form-control-sm"
                            value="{{ request('nama_pic') }}" placeholder="Masukkan Nama PIC">
                    </div>

                    <!-- Filter Tanggal -->
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label">Filter Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm"
                            value="{{ request('tanggal') }}">
                    </div>

                    <!-- Filter Bulan -->
                    <div class="col-md-3">
                        <label for="bulan" class="form-label">Filter Bulan</label>
                        <select name="bulan" id="bulan" class="form-control form-control-sm">
                            <option value="">Semua Bulan</option>
                            @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}"
                                    {{ request('bulan') == $month ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::createFromFormat('m', str_pad($month, 2, '0', STR_PAD_LEFT))->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('checklists.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                <!-- Tombol Export PDF hanya untuk role_id 1 -->
                @if (Auth::user()->role_id == 1)
                    <div class="mb-3">
                        <a href="{{ route('checklists.export-pdf', request()->all()) }}" class="btn btn-danger">
                            Export PDF
                        </a>
                    </div>
                @endif

                <!-- Looping setiap data checklist -->
                @foreach ($checklists as $item)
                    <div class="card mb-4">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th class="w-15">Tanggal</th>
                                        <th class="w-15">Bulan</th>
                                        <th class="w-15">Tahun</th>
                                        <th class="w-10">Jam</th>
                                        <th class="w-10">PIC</th>
                                        <th class="w-15">Area</th>
                                        <th class="w-20">Notes</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('m', str_pad($item->bulan, 2, '0', STR_PAD_LEFT))->format('F') }}
                                        </td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->jam_inspeksi }}</td>
                                        <td>{{ $item->nama_pic }}</td>
                                        <td>{{ $item->area }}</td>
                                        <td>{{ $item->deskripsi_pekerjaan }}</td>
                                        <td>
                                            <a href="{{ route('checklists.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Tombol Delete hanya muncul untuk role_id 1 -->
                                            @if (Auth::user()->role_id == 1)
                                                <form action="{{ route('checklists.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus checklist ini?');">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Tabel Daftar Pekerjaan -->
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="9">Daftar Pekerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $pekerjaan = [
                                            'Cermin',
                                            'Pintu Masuk',
                                            'Platfon',
                                            'Kap Lampu',
                                            'Dinding Kubikal',
                                            'Wastafel',
                                            'Accesories Toilet',
                                            'Tempat Sampah',
                                            'Closet',
                                            'Exhaust Fan',
                                            'Lantai',
                                            'Floordrain',
                                            'Flushing',
                                            'Urinoir',
                                            'Hand Soap',
                                            'Tissue',
                                            'Keset',
                                        ];
                                        $pekerjaan_chunked = array_chunk($pekerjaan, ceil(count($pekerjaan) / 2));
                                    @endphp
                                    @foreach ($pekerjaan_chunked as $chunk)
                                        <tr>
                                            @foreach ($chunk as $pekerjaanItem)
                                                <td>
                                                    @if (in_array($pekerjaanItem, $item->status_pekerjaan))
                                                        <span
                                                            style="font-size: 14px; font-weight: bold; color: black;">✔</span>
                                                    @else
                                                        <span style="color: gray;">✘</span>
                                                    @endif
                                                    {{ $pekerjaanItem }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>


            {{-- <a href="{{ route('checklists.export-pdf') }}" class="btn btn-danger mb-3">Export PDF</a> --}}
        </div>


    </body>

</html>
