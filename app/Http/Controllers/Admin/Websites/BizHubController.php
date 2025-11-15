<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Services\ProjectBApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\ApiHelper;

class BizHubController extends Controller
{
    protected ProjectBApiService $apiService;

    public function __construct(ProjectBApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of BizHub items.
     */
    public function index(Request $request): View
    {
        $data = ApiHelper::get('/bizhub');
        $items = $data->bizhub ?? [];
        return view('admin.websites.bizhub.index', compact('items'));
    }

    /**
     * Show the form for creating a new BizHub item.
     */
    public function create(): View
    {
        return view('admin.websites.bizhub.create');
    }

    /**
     * Store a newly created BizHub item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'required|string',
            'service' => 'required|string',
            'masa' => 'required|string|max:255',
        ]);
        $image = $request->file('gambar');

        $data = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone'),
            'service' => $request->input('service'),
            'location' => $request->input('location'),
            'operation_time' => $request->input('masa'),
            'status' => 'Approved',
            'image_base64' => $image ? base64_encode(file_get_contents($image->getRealPath())) : null,
        ];

        $response = ApiHelper::post('/bizhub', $data);
        if ($response->message === 'BizHub vendor added successfully') {
            return redirect()->route('admin.panel.websites.bizhub.index')
                ->with('success', 'BizHub berjaya ditambah.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal menambah BizHub: ' . ($response['error'] ?? 'Unknown error'));
    }

    /**
     * Display the specified BizHub item.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified BizHub item.
     */
    public function edit(string $id): View
    {
        $data = ApiHelper::get("/bizhub/{$id}");
        $item = $data->vendor ?? null;
        return view('admin.websites.bizhub.edit', compact('item'));
    }

    /**
     * Update the specified BizHub item.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'required|string',
            'service' => 'required|string',
            'masa' => 'required|string|max:255',
        ]);

        $image = $request->file('gambar');

        $data = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone'),
            'service' => $request->input('service'),
            'location' => $request->input('location'),
            'operation_time' => $request->input('masa'),
            'status' => 'Approved',
        ];

        if ($image) {
            $data['image_base64'] = base64_encode(file_get_contents($image->getRealPath()));
        }

        $response = ApiHelper::patch("/bizhub/{$id}", $data);
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal memadam BizHub: ' . ($response['error'] ?? 'Unknown error'));
        }

        if ($response->message === "BizHub vendor updated successfully") {
            return redirect()->route('admin.panel.websites.bizhub.index')
                ->with('success', 'BizHub berjaya dikemaskini.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal mengemaskini BizHub: ' . ($response['error'] ?? 'Unknown error'));
    }

    /**
     * Remove the specified BizHub item.
     */
    public function destroy(string $id): RedirectResponse
    {
        $response = ApiHelper::delete("/bizhub/{$id}");
        if (property_exists($response, 'error')) {
            return redirect()->back()->with('error', 'Gagal memadam BizHub: ' . ($response['error'] ?? 'Unknown error'));
        }

        return redirect()->route('admin.panel.websites.bizhub.index')->with('success', 'BizHub berjaya dipadam.');
    }
}
