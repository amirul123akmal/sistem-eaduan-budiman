<?php

namespace App\Http\Controllers\Admin\Websites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ApiHelper as A;

class AktivitiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = A::fetching('/aktiviti');
        $activities = $data->aktiviti ?? [];
        // dd($activities[0]->activity_date);
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
        //
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
        //
    }
}
