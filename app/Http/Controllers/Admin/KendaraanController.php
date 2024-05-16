<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();
        $categories = Category::all();
        return view('admin.kendaraan.create', compact('brands', 'types', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'type_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|max:2048', // Validate that uploaded file is an image and less than 2MB
            'warna' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'tahun' => 'nullable|integer',
            'harga' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'plat_nomor' => 'nullable|string|max:255',
        ]);
    
        // Store the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); 
    
            // Store the image with a custom name
            $image->storeAs('public/kendaraan', $imageName);
            $validatedData['image'] = 'storage/kendaraan/' . $imageName;
        }
    
        Kendaraan::create($validatedData);
    
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }
    
    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.show', compact('kendaraan'));
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $brands = Brand::all();
        $types = Type::all();
        $categories = Category::all();
        return view('admin.kendaraan.edit', compact('kendaraan', 'brands', 'types', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'type_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|max:2048', // Validate that uploaded file is an image and less than 2MB
            'warna' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0', 
            'tahun' => 'nullable|integer',
            'harga' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'plat_nomor' => 'nullable|string|max:255',
        ]);
    
        $kendaraan = Kendaraan::findOrFail($id);
    
        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::delete('public/' . $kendaraan->image);
    
            // Store the new image
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName(); // or use any other logic to set the image name
            $image->storeAs('public/kendaraan', $imageName);
            $validatedData['image'] = 'storage/kendaraan/' . $imageName;
        }
    
        $kendaraan->update($validatedData);
    
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
