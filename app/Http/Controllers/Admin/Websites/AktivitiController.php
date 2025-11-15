<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\ApiHelper as A;
use App\ApiHelper;

class AktivitiController extends Controller
{
    /**
     * Get the correct route name based on user role.
     */
    protected function getRouteName(string $action): string
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('Super Admin')) {
            return "admin.websites.aktiviti.{$action}";
        }

        // Default to admin panel route
        return "admin.panel.websites.aktiviti.{$action}";
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = A::get('/aktiviti');
        $activities = $data->aktiviti ?? [];
        return view('admin.websites.aktiviti.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.websites.aktiviti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aktiviti' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'tarikh' => 'required|date',
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $images = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $images[] = base64_encode(file_get_contents($image->getRealPath()));
            }
        }

        $data = [
            'title' => $request->input('nama_aktiviti'),
            'description' => $request->input('keterangan'),
            'date' => $request->input('tarikh'),
            'images' => $images,
        ];

        $response = A::post('/aktiviti', $data);
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal Menambah Aktiviti baharu: ' . ($response->error ?? 'Unknown error'));
        }
        return redirect()->route($this->getRouteName('index'))->with('success', 'Aktiviti berjaya ditambah.');
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
        $data = ApiHelper::get("/aktiviti/{$id}");
        $item = $data->activity ?? null;
        return view('admin.websites.aktiviti.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_aktiviti' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'tarikh' => 'required|date',
            'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $images = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $images[] = base64_encode(file_get_contents($image->getRealPath()));
            }
        }

        $data = [
            'title' => $request->input('nama_aktiviti'),
            'description' => $request->input('keterangan'),
            'date' => $request->input('tarikh'),
        ];

        if (!empty($images)) {
            $data['images'] = $images;
        }

        $response = A::patch("/aktiviti/{$id}", $data);
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal mengemas kini Aktiviti: ' . ($response->error ?? 'Unknown error'));
        }
        return redirect()->route($this->getRouteName('index'))->with('success', 'Aktiviti berjaya dikemas kini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = ApiHelper::delete("/aktiviti/{$id}");
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal memadam Aktiviti: ' . ($response->error ?? 'Unknown error'));
        }
        return redirect()->route($this->getRouteName('index'))->with('success', 'Aktiviti berjaya dipadam.');
    }
}
