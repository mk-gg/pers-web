let map;

function initMap() {

    const loc =  { lat: 13.5330634, lng: 122.9695949 };
    map = new google.maps.Map(document.getElementById("map"), {
        center: loc,
        zoom: 12,
    });

    const marker = new google.maps.Marker({
        position: loc,
        map: map,
    });
}
