<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Location;
use App\Http\Resources\Location as LocationResource;
   
class LocationController extends BaseController
{

    /**
     * Get all users
     */
    public function index()
    {
        $incidents = Location::all();
        return $this->sendResponse(LocationResource::collection($incidents), 'Posts fetched.');
    }

    /**
     * Store user
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'location_type' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'address' => 'nullable',
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $incident = Location::create($input);
        return $this->sendResponse(new LocationResource($incident), 'Post created.');
    }

   /**
    * Get user id
    * And view its details
    */
    public function show($id)
    {
        $incident = Location::where('location_id', $id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new LocationResource($incident), 'Post fetched.');
    }
    

    public function update(Request $request, $id)
    {

        $incident = Location::where('location_id', $id)->first();
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'location_type' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'address' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $incident->location_type = $input['location_type'];
        $incident->longitude = $input['longitude'];
        $incident->latitude = $input['latitude'];
        $incident->address = $input['address'];
        
        $incident->save();
        
        return $this->sendResponse(new LocationResource($incident), 'Post updated.');
    }
   
    public function destroy(Location $incident)
    {
        $incident->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}