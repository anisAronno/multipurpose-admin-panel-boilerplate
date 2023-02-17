<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShareHistoryRequest;
use App\Http\Requests\UpdateShareHistoryRequest;
use App\Models\ShareHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ShareHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShareHistoryRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ShareHistory $shareHistory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShareHistory $shareHistory): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShareHistoryRequest $request, ShareHistory $shareHistory): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShareHistory $shareHistory): RedirectResponse
    {
        //
    }
}
