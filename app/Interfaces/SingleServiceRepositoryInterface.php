<?php

namespace App\Interfaces;

interface SingleServiceRepositoryInterface
{
    public function index();

    // store Services
    public function store($request);

    // // update Service
    public function update($request);

    // destroy service
    public function destroy($request);

}
