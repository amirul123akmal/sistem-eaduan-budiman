<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Services\ProjectBApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $page = $request->get('page', 1);
        $search = $request->get('search', '');
        
        $params = [
            'page' => $page,
            'per_page' => 10,
        ];
        
        if ($search) {
            $params['search'] = $search;
        }

        $response = $this->apiService->get('bizhub', $params);

        if ($response['success']) {
            $data = $response['data'];
            $items = $data['data'] ?? [];
            $pagination = $data['meta'] ?? [];
        } else {
            $items = [];
            $pagination = [];
            session()->flash('error', 'Gagal memuatkan data: ' . ($response['error'] ?? 'Unknown error'));
        }

        return view('admin.websites.bizhub.index', compact('items', 'pagination', 'search'));
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
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        $response = $this->apiService->post('bizhub', $validated);

        if ($response['success']) {
            return redirect()->route('admin.websites.bizhub.index')
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

        return view('admin.websites.bizhub.show', compact('item'));
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

