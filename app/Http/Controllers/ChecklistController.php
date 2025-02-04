<?php

// Controller for Checklist
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Checklist;

class ChecklistController extends Controller
{
    public function index(Request $request)
    {
        $query = Checklist::query();

        // Filter berdasarkan Nama PIC jika diisi
        if ($request->has('nama_pic') && $request->nama_pic != '') {
            $query->where('nama_pic', 'like', "%{$request->nama_pic}%");
        }

        // Filter berdasarkan Bulan jika diisi
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan', $request->bulan);
        }

        // Filter berdasarkan Tanggal jika diisi
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->where('tanggal', $request->tanggal);
        }

        $checklists = $query->get();

        return view('checklists.index', compact('checklists'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi_pekerjaan' => 'required|string',
            'jam_inspeksi' => 'required',
            'nama_pic' => 'required|string',
            'status_pekerjaan' => 'required|array',
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
            'area' => 'required|string',
        ]);

        Checklist::create($request->all());
        return redirect()->route('checklists.index')->with('success', 'Checklist saved successfully');
    }

    public function edit(Checklist $checklist)
    {
        $checklists = Checklist::all();
        return view('checklists.edit', compact('checklist', 'checklists'));
    }


    public function update(Request $request, Checklist $checklist)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi_pekerjaan' => 'required|string',
            'jam_inspeksi' => 'required',
            'nama_pic' => 'required|string',
            'status_pekerjaan' => 'required|array',
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
            'area' => 'required|string',
        ]);

        // Opsional: Simpan data lama ke dalam variabel jika ingin melakukan sesuatu (misal, mencatat history)
        $dataLama = $checklist->toArray();

        // Alih-alih mengupdate record yang sudah ada, buat record baru
        Checklist::create($request->all());

        return redirect()->route('checklists.index')
            ->with('success', 'Checklist updated successfully. Data lama tetap tersimpan, dan data yang diedit muncul sebagai entri baru.');
    }


    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return redirect()->route('checklists.index')->with('success', 'Checklist deleted successfully');
    }

    // Metode untuk export PDF
    public function exportPdf(Request $request)
    {
        $query = Checklist::query();

        // Terapkan filter jika ada (sesuai kebutuhan)
        if ($request->has('nama_pic') && $request->nama_pic != '') {
            $query->where('nama_pic', 'like', "%{$request->nama_pic}%");
        }

        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan', $request->bulan);
        }

        $checklists = $query->get();

        // Load view export PDF (pastikan file blade di folder resources/views/checklists/export.blade.php)
        $pdf = Pdf::loadView('checklists.export', compact('checklists'));

        // Anda dapat memilih untuk mendownload atau menampilkan PDF
        return $pdf->download('checklists.pdf');
        // Jika ingin menampilkan PDF di browser, gunakan:
        return $pdf->stream('checklists.pdf');

        // ikan tongkol ikan lele, selesei lee
    }
}
