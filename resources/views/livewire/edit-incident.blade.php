<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <h2 class="h4">Add Incident</h2>
            <p class="mb-0">Your add incident template</p>
            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Document
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Message
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                        </path>
                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                    </svg>
                    Product
                </a>
                <div role="separator" class="dropdown-divider my-1"></div>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-danger me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                            clip-rule="evenodd"></path>
                    </svg>
                    My Plan
                </a>
            </div>
        </div>
    </div>
    {{-- Form --}}
    <div class="row">
       
        <div class="col-12 col-xl-8">
             <!-- Alert-->
            @if($showAddAlert)
            <div class="alert alert-success" role="alert">
                Added!
            </div>
            @endif
            <!-- End Alert-->

            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">General information</h2>
                <!-- Form -->
                <form wire:submit.prevent="add" action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="incident_type">Incident Type</label>
                                <input wire:model.lazy ="incident_type" class="form-control" id="incident_type" type="text"
                                    placeholder="Enter the incident type">
                            </div>
                            @error('incident_type') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="description">Description</label>
                                <input wire:model.lazy ="description" class="form-control" id="description" type="text"
                                    placeholder="Enter description">
                            </div>
                        </div>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                    </div>
               
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="name">Name</label>
                                <input wire:model.lazy="name" class="form-control" id="first_name" type="text"
                                    placeholder="Enter the first name">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="last_name">Last Name</label>
                                <input wire:model.lazy="last_name" class="form-control" id="last_name" type="text"
                                    placeholder="Enter the last name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sex">Gender</label>
                            <select wire:model.lazy="sex" class="form-select mb-0" id="sex"
                                aria-label="Gender select example">
                                <option value="">Gender</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                            @error('sex') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="age">Age</label>
                                    <input wire:model.lazy="age" class="form-control" id="age" type="number"
                                        placeholder="Enter the age">
                            </div>
                            @error('age') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                        </div>
                    </div>
                    {{-- 
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="password">Your Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon4"><svg class="icon icon-xs text-gray-600" fill="#6b7280" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                    <input wire:model.lazy="password" type="password" placeholder="Password" class="form-control" id="password" required>
                                </div>
                            @error('password') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon5"><svg class="icon icon-xs text-gray-600" fill="#6b7280" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                    <input wire:model.lazy="passwordConfirmation" type="password" placeholder="Confirm Password" class="form-control" id="confirm_password" required>
                                </div>  
                            </div>
                        </div>
                    </div>
                     --}}
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="location">Location</label>
                                <input wire:model.lazy="location" class="form-control" id="location" type="text"
                                    placeholder="Location">
                                    
                        </div> 
                        
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="account_id">Account Id</label>
                                <input wire:model.lazy="account_id" class="form-control" id="account_id" type="text"
                                    placeholder="Enter the account_id">
                            </div>
                        </div>
                         
                    </div>
                    <h2 class="h5 my-4">Location</h2>
                    <div class="row">
                        <div class="col-sm-9 mb-3">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input  class="form-control" id="address" type="text>
                                    placeholder="Enter your home address">
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group">
                                <label for="number">Number</label>
                                <input class="form-control" id="number" type="number"
                                    placeholder="No.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="form-group">
                                <label for="city_municipality">City</label>
                                <input class="form-control" id="city_municipality" type="text"
                                    placeholder="City">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="zip_code">ZIP</label>
                                <input class="form-control" id="zip_code" type="tel" placeholder="ZIP">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- End Form --}}

        {{-- Right Panel Map --}}
          
        <div class="col-12 col-xl-4">
            <div class="row">
                
               
                 
                
                
                <div class="col-12">
                    <div class="card card-body border-0 shadow">
                        <h2 class="h5 mb-4">Select available responders</h2>
                        <tbody>
                            
                        @foreach ($users->unique('unit_name') as $user)
                            
                        @if (!is_null($user->unit_name))
                            
                        
                        <!-- Start -->
                        <div class="d-flex align-items-center">
                            
    
                            <!-- Radio Button -->
                            <div class="me-3">
                                <div class="form-check">
                                    <input class="form-check-input" wire:model.lazy="selectedUser" type="radio" name="selectedUser" id="selectedUser" value="{{ $user->unit_name }}" checked>
                                    <label class="form-check-label" for="selectedUser">
                                    </label>
                                </div>
                            </div>
                            <!-- Responders List -->
                            <div class="file-field">
                                <div class="d-flex justify-content-xl-center ms-xl-3">
                                    <div class="d-flex">      
                                        <div class="d-md-block text-left">
                                            <div class="fw-normal text-dark ">{{ $user->unit_name }}</div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="width:100%;text-align:left;margin-left:0">
                        @endif
                        <!-- End for -->
                        @endforeach
                       
                        
                       

                    </tbody>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- End Right Panel Map --}}
    </div>
    
</div>


<script src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    
    var picker = new Pikaday({ field: document.getElementById('birthday'), 
    format: 'MM/DD/YYYY' });
    
</script>