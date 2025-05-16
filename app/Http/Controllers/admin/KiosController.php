<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kios;
use App\Models\Pasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;




class KiosController extends Controller
{
    public function index()
    {
        $kios = Kios::with('pasar')->paginate(10);
        $pasars = Pasar::all();
        return view('admin.kios', compact('kios', 'pasars'));
    }

    public function create()
    {
        $pasars = Pasar::all();
        return view('admin.kios', compact('pasars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kios' => 'required|string|max:255',
            'pasar_id' => 'required|exists:pasars,id',
            'harga_sewa' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'ukuran' => 'required|string|max:255',
            'status' => 'required|in:available,occupied',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
        // Store in public disk (storage/app/public/kios)
        $imagePath = $request->file('image')->store('kios', 'public');
        $data['image'] = $imagePath; // Will be "kios/filename.jpg"
    }


        Kios::create($data);

        return redirect()->route('admin.kios')->with('success', 'Kios created successfully.');
    }
    public function show($id)
    {
        $kios = Kios::with('pasar')->findOrFail($id);
        return view('admin.kios-show', compact('kios'));
    }

    public function edit($id)
    {
        $kios = Kios::findOrFail($id);
        $pasars = Pasar::all();
        return view('admin.kios-edit', compact('kios', 'pasars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kios' => 'required|string|max:255',
            'pasar_id' => 'required|exists:pasars,id',
            'harga_sewa' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'status' => 'required|in:available,occupied',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kios = Kios::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($kios->image);
            $imagePath = $request->file('image')->store('kios', 'public');
            $data['image'] = $imagePath;
        }

        $kios->update($data);
        return redirect()->route('admin.kios')->with('success', 'Kios updated successfully.');
    }

    public function destroy($id)
    {
        $kios = Kios::findOrFail($id);
        if ($kios->image) {
            Storage::disk('public')->delete($kios->image);
        }
        $kios->delete();
        return redirect()->route('admin.kios')->with('success', 'Kios deleted successfully.');
    }

    // Other methods (show, edit, update, destroy) can be added here
}
