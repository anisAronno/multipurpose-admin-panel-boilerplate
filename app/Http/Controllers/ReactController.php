<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReactRequest;
use App\Http\Requests\UpdateReactRequest;
use App\Models\React;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ReactController extends Controller
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
    public function store(StoreReactRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(React $react): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(React $react): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReactRequest $request, React $react): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(React $react): RedirectResponse
    {
        //
    }
}
