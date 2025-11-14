<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ApiHelper;

class AhliJawatanKuasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ApiHelper::get('/jawatan_kuasa');
        $items = $data->jawatan_kuasa ?? [];
        return view('admin.websites.ajk.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.websites.ajk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'gambar' => 'nullable|image',
        ]);
        $gambar = $request->file('gambar');

        $data = [
            'name' => $request->input('nama'),
            'position' => $request->input('posisi'),
            'phone_number' => $request->input('contact_number'),
        ];

        if ($gambar) {
            $path = base64_encode(file_get_contents($gambar->getRealPath()));
            $data['image_base64'] = $path;
        }

        $responses = ApiHelper::post('/jawatan_kuasa', $data);
        if (property_exists($responses, 'error')) {
            return redirect()->back()->with('error', 'Gagal memadam BizHub: ' . ($responses->error ?? 'Unknown error'));
        }
        return redirect()->route('admin.panel.websites.ajk.index')
            ->with('success', 'Ahli Jawatan Kuasa berjaya ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ApiHelper::get("/jawatan_kuasa/{$id}");
        $item = $data->member ?? null;
        return view('admin.websites.ajk.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'gambar' => 'nullable|image',
        ]);
        $gambar = $request->file('gambar');

        $data = [
            'name' => $request->input('nama'),
            'position' => $request->input('posisi'),
            'phone_number' => $request->input('contact_number'),
        ];

        if ($gambar) {
            $path = base64_encode(file_get_contents($gambar->getRealPath()));
            $data['image_base64'] = $path;
        }

        $responses = ApiHelper::patch("/jawatan_kuasa/{$id}", $data);
        if (property_exists($responses, 'error')) {
            return redirect()->back()->with('error', 'Gagal mengemas kini Ahli Jawatan Kuasa: ' . ($responses->error ?? 'Unknown error'));
        }
        return redirect()->route('admin.panel.websites.ajk.index')
            ->with('success', 'Ahli Jawatan Kuasa berjaya dikemas kini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = ApiHelper::delete("/jawatan_kuasa/{$id}");
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal memadam Ahli Jawatan Kuasa: ' . ($response->error ?? 'Unknown error'));
        }
        return redirect()->route('admin.panel.websites.ajk.index')
            ->with('success', 'Ahli Jawatan Kuasa berjaya dipadam.');
    }
}
