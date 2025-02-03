<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">Edit Checklist</h2>
    <form action="{{ route('checklists.update', $checklist->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control form-control-sm" name="tanggal" 
                       value="{{ old('tanggal', $checklist->tanggal) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bulan</label>
                <select class="form-control form-control-sm" name="bulan" required>
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
                <select class="form-control form-control-sm" name="tahun" required>
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
                <select class="form-control form-control-sm" name="jam_inspeksi" required>
                    @foreach (['07:00', '09:00', '11:00', '14:00', '17:00'] as $time)
                        <option value="{{ $time }}" {{ old('jam_inspeksi', $checklist->jam_inspeksi) == $time ? 'selected' : '' }}>
                            {{ $time }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama PIC</label>
                <input type="text" class="form-control form-control-sm" name="nama_pic" 
                       value="{{ old('nama_pic', $checklist->nama_pic) }}" required>
            </div>
        </div>
    
        <!-- Input Area dan Deskripsi Pekerjaan -->
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Area</label>
                <select class="form-control form-control-sm" name="area" required>
                    @foreach (['Area 1', 'Area 2', 'Area 3'] as $area)
                        <option value="{{ $area }}" {{ old('area', $checklist->area) == $area ? 'selected' : '' }}>
                            {{ $area }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Notes</label>
                <input type="text" class="form-control form-control-sm" name="deskripsi_pekerjaan" 
                       value="{{ old('deskripsi_pekerjaan', $checklist->deskripsi_pekerjaan) }}" required>
            </div>
        </div>
    
        <!-- Checklist Pekerjaan -->
        <div class="mb-3 mt-3">
            <label class="form-label">Checklist Pekerjaan =</label>
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
    
        <button type="submit" class="btn btn-primary w-100 d-block">Update</button>
    </form>
    
</div>

<style>
    .container {
    max-width: 800px;
    margin: auto;
}

.form-label {
    font-weight: bold;
}

.checkbox-wrapper {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 10px;
    background-color: #f8f9fa;
}

.form-check {
    margin-bottom: 10px;
}
</style>