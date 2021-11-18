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
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'description' => 'nullable',
            'date_time_reported' => 'required',
            'location_id' => 'nullable',
            'reporter_id' => 'required',
            
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
        $incident = Incident::find($id);
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new IncidentResource($incident), 'Post fetched.');
    }
    

    public function update(Request $request, Incident $incident)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'incident_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'description' => 'nullable',
            'date_time_reported' => 'required',
            'location_id' => 'nullable',
            'reporter_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $incident->first_name = $input['first_name'];
        $incident->last_name = $input['last_name'];
        $incident->gender = $input['gender'];
        $incident->age = $input['age'];
        $incident->incident_type = $input['incident_type'];
        $incident->description = $input['description'];
        $incident->date_time_reported = $input['date_time_reported'];
        $incident->location_id = $input['location_id'];
        $incident->reporter_id = $input['reporter_id'];
        $incident->save();
        
        return $this->sendResponse(new IncidentResource($incident), 'Post updated.');
    }
   
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}