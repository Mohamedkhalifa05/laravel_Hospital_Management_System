<?php
namespace App\Respository\Services;

use App\Http\Requests\StoreSingleServiceRequest;
use App\Interfaces\SingleServiceRepositoryInterface ;
use App\Models\Image;
use App\Models\Service;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SingleServiceRepository implements SingleServiceRepositoryInterface
{
   use UploadTrait;

    public function index()
    {

    $services =Service::all();
    return view("Dashboard.Services.Single Service.index",compact('services'));

    }

   public function create()
    {

    }
 public function store( $request){
    try {
        $SingleService = new Service();
        $SingleService->price = $request->price;
        $SingleService->description = $request->description;
        $SingleService->status = 1 ;
        $SingleService->save();

        //Service trans
        $SingleService->name = $request->name;
        $SingleService->save();
         session()->flash("add");
         return redirect()->route("Service.index");
        } catch (\Exception $e) {
          return redirect()->back()->withErrors(["errors" => $e->getMessage()]);
        }
 }//End Method

  public function update($request){
    try {
        $SingleService = Service::findOrFail($request->id);
        $SingleService->price = $request->price;
        $SingleService->description = $request->description;
        $SingleService->status = 1 ;
        $SingleService->save();

        //Service trans
        $SingleService->name = $request->name;
        $SingleService->save();
         session()->flash("edit");
         return redirect()->route("Service.index");
        } catch (\Exception $e) {
          return redirect()->back()->withErrors(["errors" => $e->getMessage()]);
        }
 }

 public function destroy($request)
    {
        Service::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('Service.index');
    }





}
