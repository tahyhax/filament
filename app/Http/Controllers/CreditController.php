<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\UpdateCreditRequest;
use App\Models\Credit;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreditRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Credit $credit): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credit $credit): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreditRequest $request, Credit $credit): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credit $credit): void
    {
        //
    }
}
