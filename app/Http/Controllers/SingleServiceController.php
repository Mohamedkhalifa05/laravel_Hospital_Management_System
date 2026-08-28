<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSingleServiceRequest;
use App\Interfaces\SingleServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{


  private $SingleServices ;

  public function __construct(SingleServiceRepositoryInterface $SingleServices) {

  $this->SingleServices = $SingleServices ;
  }

    public function index()
    {
       return $this->SingleServices->index();
    }



    public function store(StoreSingleServiceRequest $request)
    {
      return $this->SingleServices->store($request);
    }//End Method

  public function update(StoreSingleServiceRequest $request){
   return $this->SingleServices->update($request);
 }


    public function destroy(Request $request)
    {
      return $this->SingleServices->destroy($request);
    }
}
