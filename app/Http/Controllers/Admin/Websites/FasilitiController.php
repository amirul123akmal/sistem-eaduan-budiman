<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ApiHelper;

class FasilitiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ApiHelper::get('/fasiliti');
        $fasiliti = $data->fasiliti ?? [];
        // dd( $fasiliti[1]->image_path );
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
        // dd($request->all(), base64_encode($image->get()));
        $data = [
            'name' => $request->input('nama'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'is_available' => 'true',
            'image_base64' => base64_encode($image->get())
        ];
        $feedback = ApiHelper::post('/fasiliti', $data);
        return redirect()->route('admin.panel.websites.fasiliti.index')->with('success', 'Fasiliti berjaya ditambah.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ApiHelper::delete('/fasiliti/' . $id);
        return redirect()->route('admin.panel.websites.fasiliti.index')->with('success', 'Fasiliti berjaya dipadam.');
    }
}
