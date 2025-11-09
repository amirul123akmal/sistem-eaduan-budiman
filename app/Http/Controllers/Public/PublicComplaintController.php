<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\ComplaintStatusLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PublicComplaintController extends Controller
{
    /**
     * Show the form for creating a new complaint.
     */
    public function create(): View
    {
        $complaintTypes = ComplaintType::orderBy('type_name')->get();
        return view('public.tambahaduan', compact('complaintTypes'));
    }

    /**
     * Store a newly created complaint.
     */
    public function store(Request $request): RedirectResponse
    {
        // Map form field names to database column names
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'telefon' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'email', 'max:255'],
            'alamat' => ['required', 'string', 'max:200', 'regex:/^[a-zA-Z0-9\s.,-]+$/'],
            'kategori' => ['required'],
            'huraian' => ['required', 'string', 'max:500'],
            'gambar' => ['nullable', 'array', 'max:10'],
            'gambar.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'nama.required' => 'Nama diperlukan.',
            'nama.regex' => 'Nama hanya boleh mengandungi huruf dan ruang.',
            'nama.max' => 'Nama tidak boleh melebihi 100 aksara.',
            'telefon.required' => 'Nombor telefon diperlukan.',
            'telefon.regex' => 'Nombor telefon hanya boleh mengandungi nombor.',
            'telefon.max' => 'Nombor telefon tidak boleh melebihi 20 aksara.',
            'email.required' => 'Emel diperlukan.',
            'email.email' => 'Sila masukkan alamat emel yang sah.',
            'email.max' => 'Emel tidak boleh melebihi 255 aksara.',
            'alamat.required' => 'Alamat diperlukan.',
            'alamat.regex' => 'Alamat hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).',
            'alamat.max' => 'Alamat tidak boleh melebihi 200 aksara.',
            'kategori.required' => 'Jenis aduan diperlukan.',
            'huraian.required' => 'Penerangan diperlukan.',
            'huraian.max' => 'Penerangan tidak boleh melebihi 500 aksara.',
            'gambar.array' => 'Gambar mestilah dalam format yang betul.',
            'gambar.max' => 'Maksimum 10 gambar dibenarkan.',
            'gambar.*.image' => 'Semua fail yang dimuat naik mestilah imej.',
            'gambar.*.mimes' => 'Format gambar hanya dibenarkan: JPG, JPEG, dan PNG.',
            'gambar.*.max' => 'Saiz setiap imej tidak boleh melebihi 2MB.',
        ]);

        // Map kategori value to complaint_type_id
        // The form uses text values, we need to find matching complaint type
        $kategoriValue = $validated['kategori'];
        $complaintType = null;
        
        // Try to find by ID first (if it's numeric)
        if (is_numeric($kategoriValue)) {
            $complaintType = ComplaintType::find($kategoriValue);
        }
        
        // If not found, try to find by type_name (case-insensitive partial match)
        if (!$complaintType) {
            $kategoriMap = [
                'prasarana' => 'Prasarana',
                'kebersihan' => 'Kebersihan',
                'keselamatan' => 'Keselamatan',
                'lain' => 'Lain-lain',
            ];
            
            $searchName = $kategoriMap[$kategoriValue] ?? $kategoriValue;
            $complaintType = ComplaintType::where('type_name', 'like', "%{$searchName}%")->first();
        }
        
        if (!$complaintType) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jenis aduan yang dipilih tidak sah.');
        }

        // Map form fields to database columns
        $complaintData = [
            'name' => $validated['nama'],
            'phone_number' => $validated['telefon'],
            'email' => $validated['email'],
            'address' => $validated['alamat'],
            'complaint_type_id' => $complaintType->id,
            'description' => $validated['huraian'],
            'status' => 'menunggu', // Default status for public complaints
        ];

        // Handle multiple image uploads
        if ($request->hasFile('gambar')) {
            $imagePaths = [];
            foreach ($request->file('gambar') as $image) {
                $imagePaths[] = $image->store('complaints', 'public');
            }
            $complaintData['image_path'] = $imagePaths;
        }

        $complaint = Complaint::create($complaintData);

        // Create status log (for public, use first admin user as system user)
        try {
            // Get first admin user (Super Admin or Admin)
            $adminUser = User::whereHas('roles', function($query) {
                $query->whereIn('name', ['Super Admin', 'Admin']);
            })->first();
            
            if ($adminUser) {
                ComplaintStatusLog::create([
                    'complaint_id' => $complaint->id,
                    'status' => $complaint->status,
                    'updated_by' => $adminUser->id,
                    'comment' => 'Aduan diterima dari sistem awam.',
                    'created_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            // If status log creation fails, continue without it
            // The complaint is still created successfully
        }

        return redirect()->route('public.complaint.create')
            ->with('success', 'Aduan anda berjaya dihantar! ID Aduan: ' . $complaint->public_id);
    }

    /**
     * Show the check status form.
     */
    public function checkStatus(): View
    {
        return view('public.semakstatus');
    }

    /**
     * List complaints by phone number.
     */
    public function list(Request $request): View|RedirectResponse
    {
        $phoneNumber = $request->input('no_telefon') ?? $request->session()->get('public_phone_number');
        
        if (!$phoneNumber) {
            return redirect()->route('public.status.check')
                ->with('error', 'Sila masukkan nombor telefon untuk melihat senarai aduan.');
        }

        $complaints = Complaint::where('phone_number', $phoneNumber)
            ->with('complaintType')
            ->orderBy('created_at', 'desc')
            ->get();

        // Store phone number in session for next requests
        $request->session()->put('public_phone_number', $phoneNumber);

        return view('public.listaduan', compact('complaints', 'phoneNumber'));
    }

    /**
     * Show complaint details.
     */
    public function show(Complaint $complaint): View|RedirectResponse
    {
        // Verify that the complaint belongs to the phone number in session
        $phoneNumber = request()->session()->get('public_phone_number');
        
        if ($complaint->phone_number !== $phoneNumber) {
            return redirect()->route('public.status.check')
                ->with('error', 'Anda tidak mempunyai kebenaran untuk melihat aduan ini.');
        }

        $complaint->load(['complaintType', 'statusLogs']);
        
        return view('public.statusaduan', compact('complaint'));
    }
}
