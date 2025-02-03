<?php

// Controller for Checklist
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Checklist;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::all();
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

    public function exportPdf(Request $request)
    {
        $query = Checklist::query();

        if ($request->has('filter_month') && $request->filter_month != '') {
            $query->where('bulan', $request->filter_month);
        }

        $checklists = $query->get();

        $pdf = PDF::loadView('checklists.export', compact('checklists'));
        return $pdf->download('checklists.pdf');
    }
}
