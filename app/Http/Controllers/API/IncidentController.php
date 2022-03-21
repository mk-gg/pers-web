<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Incident;
use App\Models\Operation;
use Illuminate\Validation\Rule;
use App\Http\Resources\Incident as IncidentResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
class IncidentController extends BaseController
{
    public $selected_unit;
    public $i_id;
    /**
     * Get all users
     */
    public function index()
    {
        $incidents = Incident::all();
        return $this->sendResponse(IncidentResource::collection($incidents), 'Posts fetched.');
    }

    /**
     * Store user
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'incident_type' => 'required',
            'name' => 'nullabe',
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'description' => 'nullable',
            'location_id' => 'nullable',
            'account_id' => 'required',
            'location' => 'required',
            'incident_status' => ['required', Rule::in(['pending', 'completed', 'proceeding'])],
            'victim_status' => 'required',
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $incident = Incident::create($input);
        
        return $this->sendResponse(new IncidentResource($incident), 'Post created.');
    }

   /**
    * Get user id
    * And view its details
    */
    public function show($id)
    {   
        $incident = Incident::where('incident_id', $id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new IncidentResource($incident), 'Post fetched.');
    }
    

    public function update(Request $request, $id)
    {

      
        $incident = Incident::where('incident_id', $id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }
        $input = $request->all();

        $validator = Validator::make($input, [
            'incident_type' => 'required',
            'last_name' => 'nullable',
            'first_name' => 'nullable',
            'sex' => 'required',
            'age' => 'required',
            'description' => 'nullable',
            'location_id' => 'nullable',
            'account_id' => 'required',
            'incident_status' => ['required', Rule::in(['off duty', 'available', 'unavailable'])],
            'victim_status' => 'nullable'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $incident->first_name = $input['first_name'];
        $incident->last_name = $input['last_name'];
        $incident->sex = $input['sex'];
        $incident->age = $input['age'];
        $incident->incident_type = $input['incident_type'];
        $incident->description = $input['description'];
        $incident->location_id = $input['location_id'];
        $incident->account_id = $input['account_id'];
        $incident->incident_status = $input['incident_status'];
        $incident->victim_status = $input['victim_status'];
        $incident->save();
        
        return $this->sendResponse(new IncidentResource($incident), 'Post updated.');   
    }
   
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return $this->sendResponse([], 'Post deleted.');
    }

    public function assigned_incidents($id)
    {
        

        $operation = Operation::where('unit_name', $id)->first();
        if (is_null($operation)) {
            return $this->sendError('Unit name does not exist.');
        }

        $incident = Incident::where('incident_id', $operation->incident_id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }    
        //Validate first the input
        // $validator = $request->validate([
        //     'unit_name' => 'required',
        // ]);
        
        //return $this->sendError($validator['incident_id']);
        
        // Check incident id exists
   

        // Check unit_name exists
        // $operation = Operation::where('unit_name', $validator['unit_name'])->first();
        // if (is_null($operation)) {
        //     return $this->sendError('Post does not exist.');
        // }
        
        // $this->selected_unit = $validator['unit_name'];

        
        
        $this->selected_unit = $id;

        // Get the incidents pertaining to this
        $result = Incident::join('operations', 'incidents.incident_id', '=', 'operations.incident_id')
                    ->where('operations.unit_name', $this->selected_unit)
                    ->where('incidents.incident_status', 'Ongoing')
                    ->get(['incidents.*', 'operations.*']);
        

        return response()->json(['success' => true, 'incidents' => $result]);
                    
        return $this->sendResponse($result->toJson(JSON_PRETTY_PRINT), 'Post updated.');  
        

    }
}