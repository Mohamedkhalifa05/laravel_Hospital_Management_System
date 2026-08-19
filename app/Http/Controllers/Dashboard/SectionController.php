<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{


private $Sections ;

  public function __construct(SectionRepositoryInterface $Sections) {

  $this->Sections = $Sections ;
  }


    public function index()
    {
      return $this->Sections->index();
    }//End Method


    public function create()
    {

    }//End Method


    public function store(Request $request)
    {
     return $this->Sections->store($request);
    }//End Method


    public function show(string $id)
    {

    }//End Method


    public function edit(string $id)
    {

    }//End Method


public function update(Request $request)
{
    $this->Sections->update($request);

    session()->flash('edit');

    return redirect()->route('Sections.index');
}



    public function destroy(Request $request)
    {
      $this->Sections->destroy($request);

    session()->flash('delete');

    return redirect()->route('Sections.index');
    }//End Method
}
