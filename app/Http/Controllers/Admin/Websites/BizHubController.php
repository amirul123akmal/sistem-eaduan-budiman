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
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);
        $image = $request->file('image');

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address'),
            'website' => $request->input('website'),
            'status' => $request->input('status', 'active'),
        ];

        $response = ApiHelper::post('/bizhub', $data);

        if ($response['success']) {
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
    public function show(string $id): View
    {
        $response = $this->apiService->get("bizhub/{$id}");

        if ($response['success']) {
            $item = $response['data']['data'] ?? $response['data'];
        } else {
            abort(404, 'BizHub tidak dijumpai.');
        }

        return view('admin.panel.websites.bizhub.show', compact('item'));
    }

    /**
     * Show the form for editing the specified BizHub item.
     */
    public function edit(string $id): View
    {
        $response = $this->apiService->get("bizhub/{$id}");

        if ($response['success']) {
            $item = $response['data']['data'] ?? $response['data'];
        } else {
            abort(404, 'BizHub tidak dijumpai.');
        }

        return view('admin.websites.bizhub.edit', compact('item'));
    }

    /**
     * Update the specified BizHub item.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        $response = $this->apiService->put("bizhub/{$id}", $validated);

        if ($response['success']) {
            return redirect()->route('admin.websites.bizhub.index')
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
        $response = $this->apiService->delete("bizhub/{$id}");

        if ($response['success']) {
            return redirect()->route('admin.websites.bizhub.index')
                ->with('success', 'BizHub berjaya dipadam.');
        }

        return redirect()->back()
            ->with('error', 'Gagal memadam BizHub: ' . ($response['error'] ?? 'Unknown error'));
    }
}

