<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSearchHistoryRequest;
use App\Http\Requests\UpdateSearchHistoryRequest;
use App\Models\SearchHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SearchHistoryController extends Controller
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
    public function store(StoreSearchHistoryRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SearchHistory $searchHistory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SearchHistory $searchHistory): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSearchHistoryRequest $request, SearchHistory $searchHistory): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SearchHistory $searchHistory): RedirectResponse
    {
        //
    }
}
