<?php

namespace App\Http\Controllers;

use App\Models\StatusUpdate;
use App\Services\StatusUpdateService;
use Illuminate\Http\Request;

class StatusUpdateController extends Controller
{
    protected $statusUpdateService;

    public function __construct(StatusUpdateService $statusUpdateService)
    {
        $this->statusUpdateService = $statusUpdateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StatusUpdate::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = $this->statusUpdateService->newStatus($request->all());

        return response()->json([
            'data' => [
                'success' => true,
                'message' => 'Status updated successfully!',
                'data' => $status
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusUpdate  $statusUpdate
     * @return \Illuminate\Http\Response
     */
    public function show(StatusUpdate $statusUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusUpdate  $statusUpdate
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusUpdate $statusUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusUpdate  $statusUpdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusUpdate $statusUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusUpdate  $statusUpdate
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusUpdate $statusUpdate)
    {
        //
    }
}
