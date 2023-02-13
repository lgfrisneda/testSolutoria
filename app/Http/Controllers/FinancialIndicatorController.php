<?php

namespace App\Http\Controllers;

use App\Models\FinancialIndicator;
use App\Http\Requests\StoreFinancialIndicatorRequest;
use App\Http\Requests\UpdateFinancialIndicatorRequest;

class FinancialIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financialIndicators = FinancialIndicator::all();

        return view('welcome', compact('financialIndicators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFinancialIndicatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinancialIndicatorRequest $request)
    {
        $dataValidated = $request->validated();
        $newRecord = FinancialIndicator::create($dataValidated);

        return response()->json(['message' => 'Save success', 'record' => $newRecord]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinancialIndicator  $financialIndicator
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialIndicator $financialIndicator)
    {
        return response()->json($financialIndicator);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinancialIndicator  $financialIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialIndicator $financialIndicator)
    {
        return response()->json($financialIndicator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFinancialIndicatorRequest  $request
     * @param  \App\Models\FinancialIndicator  $financialIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinancialIndicatorRequest $request, FinancialIndicator $financialIndicator)
    {
        $dataValidated = $request->validated();
        $financialIndicator->update($dataValidated);

        return response()->json(['message' => 'Updated success', 'record' => $financialIndicator->fresh()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinancialIndicator  $financialIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialIndicator $financialIndicator)
    {
        $financialIndicator->delete();
        return response()->json(['message' => 'Deleted success']);
    }
}
