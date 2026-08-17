<?php


namespace App\Interfaces\Sections;

use Illuminate\Http\Request;

interface  SectionRepositoryInterface {

public function index();
public function store($request);

public function update(Request $request);


public function destory(Request $request);
}
