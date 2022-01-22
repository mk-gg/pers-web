<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Incident;
use App\Http\Resources\Incident as IncidentResource;
   
class IncidentController extends BaseController
{

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
            'incident_status' => 'required',
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
            'incident_status' => 'nullable',
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
}