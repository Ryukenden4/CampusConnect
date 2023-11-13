function initMap() {
    // Latitude and Longitude
    var myLatLng = {lat: 6.063765295812673 ,lng: 116.14589646915046};

    var map = new google.maps.Map(document.getElementById('google-maps'), {
        zoom: 17,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'UiTM Cawangan Sabah, Kampus, 88997 Kota Kinabalu, Sabah' // Title Location
    });
}