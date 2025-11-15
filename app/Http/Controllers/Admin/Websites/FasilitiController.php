<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\ApiHelper;

class FasilitiController extends Controller
{
    /**
     * Get the correct route name based on user role.
     */
    protected function getRouteName(string $action): string
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && $user->hasRole('Super Admin')) {
            return "admin.websites.fasiliti.{$action}";
        }

        // Default to admin panel route
        return "admin.panel.websites.fasiliti.{$action}";
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ApiHelper::get('/fasiliti');
        $fasiliti = $data->fasiliti ?? [];
        return view('admin.websites.fasiliti.index', compact('fasiliti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.websites.fasiliti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('gambar');
        $data = [
            'name' => $request->input('nama'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'is_available' => 'true',
            'image_base64' => base64_encode($image->get())
        ];
        $feedback = ApiHelper::post('/fasiliti', $data);
        if (property_exists($feedback, 'error')) {
            return redirect()->back()->with('error', 'Gagal menambah Fasiliti: ' . ($feedback->error ?? 'Unknown error'));
        }
        return redirect()->route($this->getRouteName('index'))->with('success', 'Fasiliti berjaya ditambah.');
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
        $data = ApiHelper::get('/fasiliti/' . $id);
        $fasiliti = $data->facility ?? null;
        return view('admin.websites.fasiliti.edit', compact('fasiliti'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->input('nama'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
        ];

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $data['image_base64'] = base64_encode($image->get());
        }

        $feedback = ApiHelper::patch('/fasiliti/' . $id, $data);
        if (property_exists($feedback, 'error')) {
            return redirect()->back()->with('error', 'Gagal mengemaskini Fasiliti: ' . ($feedback->error ?? 'Unknown error'));
        }
        return redirect()->route($this->getRouteName('index'))->with('success', 'Fasiliti berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = ApiHelper::delete('/fasiliti/' . $id);
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal memadam Fasiliti: ' . ($response->error ?? 'Unknown error'));
        }
        return redirect()->route($this->getRouteName('index'))->with('success', 'Fasiliti berjaya dipadam.');
    }
}
