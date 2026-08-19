<?php
namespace App\Respository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Section;
use Illuminate\Http\Request;



class SectionRespository implements SectionRepositoryInterface {


	public function index()
    {
        $sections = Section::all();
         return view("Dashboard.Sections.index",compact("sections"));
    }

    public function store($request){

    Section::create([
      "name" => $request->name
    ]);
    session()->flash("add");
    return redirect()->back();

    }
    public function update(Request $request){
         $section = Section::findOrFail($request->id);

    $section->update([
        'name' => $request->input('name'),
    ]);

    return $section;
    }
    public function destroy( Request $request){
        $section = Section::findOrFail($request->id);
        $section->delete();
    }



}


