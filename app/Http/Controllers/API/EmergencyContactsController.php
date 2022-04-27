<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyContacts;
use App\Http\Resources\EmergencyContacts as EmergencyContactsResource;
use App\Models\EmergencyConacts;

class EmergencyContactsController extends BaseController
{

    /**
     * Get all users
     */
    public function index()
    {
        $incidents = EmergencyContacts::all();
        return $this->sendResponse(EmergencyContactsResource::collection($incidents), 'Posts fetched.');
    }

    /**
     * Store user
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'contact_name' => 'required',
            'contact_number' => 'required',
            'account_id' => 'nullable',
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $incident = EmergencyContacts::create($input);
        return $this->sendResponse(new EmergencyContactsResource($incident), 'Post created.');
    }

   /**
    * Get user id
    * And view its details
    */
    public function show($id)
    {
        $contacts = EmergencyContacts::all();

        $incident = $contacts->where('account_id', $id);
        if (is_null($incident)) {
            return $this->sendError('Post does not exist.');
        }

        return $this->sendResponse(new EmergencyContactsResource($incident), 'Post fetched.');
    }
    

    public function update(Request $request, $id)
    {
        $account = EmergencyContacts::find($id);
        if (is_null($account)) {
            return $this->sendError('Post does not exist.');
        }
        $account->update($request->all());
        return $this->sendResponse(new EmergencyContacts($account), 'Post updated.');  
        
    }
   
    public function destroy(EmergencyContacts $incident)
    {
        $incident->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}