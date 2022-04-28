<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Operation;
use App\Http\Resources\Operation as OperationResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
class OperationController extends BaseController
{

    /**
     * Get all users
     */
    public function index()
    {
        $incidents = Operation::all();
        return $this->sendResponse(OperationResource::collection($incidents), 'Posts fetched.');
    }

    /**
     * Store user
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'incident_id' => 'required',
            'unit_name' => 'nullable',
            'dispatcher_id' => 'nullable',
            'external_agency_id' => 'nullable',
            'etd_base' => 'nullable',
            'eta_scene' => 'nullable',
            'etd_scene' => 'nullable',
            'eta_hospital' => 'nullable',
            'etd_hospital' => 'nullable',
            'eta_base' => 'nullable',
            'receiving_facility' => 'nullable'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $incident = Operation::create($input);
        return $this->sendResponse(new OperationResource($incident), 'Post created.');
    }

   /**
    * Get user id
    * And view its details
    */
    public function show($id)
    {
        $incident = Operation::where('operation_id', $id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new OperationResource($incident), 'Post fetched.');
    }
    
    public function show_ops($unit_name)
    {
       
        
        $operations = DB::select("SELECT operations.*, incidents.*, locations.* FROM operations INNER JOIN incidents ON operations.incident_id = incidents.incident_id INNER JOIN locations ON incidents.location_id = locations.location_id WHERE incidents.incident_status = 'Completed' AND unit_name = '".$unit_name."'");
    

 
        if (collect($operations)->isEmpty()) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(collect($operations), 'Post Fetched');
    }

    public function update(Request $request, $id)
    {
        $incident = Operation::where('operation_id', $id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }
        $input = $request->all();

        $validator = Validator::make($input, [
            'incident_id' => 'nullable',
            'unit_name' => 'nullable',
            'dispatcher_id' => 'nullable',
            'external_agency_id' => 'nullable',
            'etd_base' => 'nullable',
            'eta_scene' => 'nullable',
            'etd_scene' => 'nullable',
            'eta_hospital' => 'nullable',
            'etd_hospital' => 'nullable',
            'eta_base' => 'nullable',
            'receiving_facility' => 'nullable',
            
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $incident->update($request->all());
        
        return $this->sendResponse(new OperationResource($incident), 'Post updated.');   
    }
   
    public function destroy(Operation $incident)
    {
        $incident->delete();
        return $this->sendResponse([], 'Post deleted.');
    }


    
}