<div>
    <style>
        #map {
            height: 100%;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
    </style>  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <h2 class="h4">Add Location</h2>
            <p class="mb-0">Your add location template</p>
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
    <div class="row">
        <div class="col-12 col-xl-8">
            @if($showAddAlert)
            <div class="alert alert-success" role="alert">
                Added!
            </div>
            @endif
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">General information</h2>
                <!-- Form -->
                <form wire:submit.prevent="add" action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="location_type">location Type</label>
                                <select wire:model.lazy="location_type" class="form-select mb-0"  id="location_type" 
                                    aria-label="Role select example">
                                    <option >Choose...</option>
                                    <option value="incident">Incident</option>
                                    <option value="important_location">Important Location</option>
                                </select>
                            </div>
                                @error('location_type') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="landmark">Landmark</label>
                                <input wire:model="landmark" class="form-control" id="landmark" type="text"
                                    placeholder="Enter the landmark" required>
                            </div>
                            @error('landmark') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="address">Address</label>
                                <input wire:model="address" class="form-control" id="address" type="text"
                                    placeholder="Enter address">
                            </div>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="location_name">Location Name</label>
                                <input wire:model="location_name" class="form-control" name="location_name" id="location_name" type="text"
                                    placeholder="Enter the location name">
                            </div>
                            @error('location_name') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="longitude">Longitude</label>
                                <input wire:model="longitude" class="form-control" name="longitude" id="longitude" type="text"
                                    placeholder="Enter the longitude">
                            </div>
                            @error('longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="latitude">Latitude</label>
                                <input wire:model.lazy="latitude" class="form-control" name="latitude" id="latitude" type="text"
                                    placeholder="Enter the latitude">
                            </div>
                            @error('latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="col-12 col-xl-4">
            <div class="row">

                <div class="col-12 mb-4">
                    <div class="card shadow border-0 text-center p-0">
                        <div class="card-body pb-3">
                            <div wire:ignore style="width:100%;height:500px; ">
                                <div style="heigh: 100%; width:100%" class="gmap" id="map"></div>
                            </div>
                            <div wire:ignore class="gmap" id="map" style="height: 100%"></div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>


@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY ') }}&callback=initialize" async defer></script>
    <script src="https://maps.googleapis.com/maps/api/geocode/js?key={{ env('GOOGLE_MAPS_API_KEY ') }}&callback=initialize" async defer></script>
    <script>
        let map;

        function initialize() {
            
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 13.519231558052947, lng: 123.04375797926176 },
                zoom: 18,
            });
            
            const loc =  { lat: 13.519231558052947, lng: 123.04375797926176 };

            const geocoder = new google.maps.Geocoder();
            const infowindow = new google.maps.InfoWindow();

            const marker = new google.maps.Marker({
                position: loc,
                map: map,
                draggable: true
            });
            
            google.maps.event.addListener(marker,'position_changed',
                function (){
                    let lat = marker.position.lat();
                    let lng = marker.position.lng();
                    document.getElementById('latitude').value = this.getPosition().lat();
                    document.getElementById('longitude').value = this.getPosition().lng();
                  
                    geocodeLatLng(geocoder, map, infowindow);
                  
                });
            google.maps.event.addListener(map,'click',
                function (event){
                    pos = event.latLng;
                    marker.setPosition(pos);
                });
            
        }

        function geocodeLatLng(geocoder, map, infoWindow) {
            const input = document.getElementById('latitude').value + "," + document.getElementById('longitude').value;
           
            const latlngStr = input.split(",", 2);
            const latlng = {
                lat: parseFloat(latlngStr[0]),
                lng: parseFloat(latlngStr[1]),
            };
            
            geocoder
                .geocode({ location: latlng })
                .then((response) => {
                    if (response.results[0]) {
                        map.setZoom(11);

                        const marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                        });

                        infowindow.setContent(response.results[0].formatted_address);
                        infowindow.open(map, marker);
                        
                    }else {
                        window.alert("No results found");
                    }
                })
               let lat = parseFloat(latlngStr[0]);
               let lng = parseFloat(latlngStr[1]);
               @this.latitude = lat;
               @this.longitude = lng;
        }
       
    </script>

@endsection