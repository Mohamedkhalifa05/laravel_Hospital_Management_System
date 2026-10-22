<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\DiagnosticsRespositoryInterface;
use Illuminate\Http\Request;

class DiagnosticsController extends Controller
{
    private $Diagnostics; 

    public function __construct(DiagnosticsRespositoryInterface $Diagnostics)
    {
        $this->Diagnostics = $Diagnostics;
    }
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Diagnostics->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Diagnostics->show($id);
    }

    
    public function edit(string $id)
    {
        //
    }

    
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
