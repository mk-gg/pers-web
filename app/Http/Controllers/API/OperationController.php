<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Operation;
use App\Http\Resources\Operation as OperationResource;
   
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
            'receiving_facitility' => 'nullable'
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
            'receiving_facitility' => 'nullable',
            
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $incident->incident_id = $input['incident_id'];
        $incident->unit_name = $input['unit_name'];
        $incident->dispatcher_id = $input['dispatcher_id'];
        $incident->etd_base = $input['etd_base'];
        $incident->eta_scene = $input['eta_scene'];
        $incident->etd_scene = $input['etd_scene'];
        $incident->eta_hospital = $input['eta_hospital'];
        $incident->etd_hospital = $input['etd_hospital'];
        $incident->eta_base = $input['eta_base'];
        $incident->receiving_facitility = $input['receiving_facitility'];
        $incident->save();
        
        return $this->sendResponse(new OperationResource($incident), 'Post updated.');   
    }
   
    public function destroy(Operation $incident)
    {
        $incident->delete();
        return $this->sendResponse([], 'Post deleted.');
    }


    
}