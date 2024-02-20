
function searchFunction() {
    var input, filter, ul, li, a, i, author;
    input = document.getElementById('myinput');
    filter = input.value.toUpperCase();
    li = document.getElementsByClassName('city-result');

    cusall = document.getElementsByClassName('customer-all-main');
    var resultsFound = false;
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName('searchable')[0];
        author = li[i].getElementsByClassName('author')[0];
        if (a.innerHTML.toUpperCase().includes(filter) || author.innerHTML.toUpperCase().includes(filter)) {
            li[i].style.display = "";
            resultsFound = true;
        } else {
            li[i].style.display = 'none';
        }
    }
    document.getElementById('filter-heading').style.display = 'none';
    for (var j = 0; j < cusall.length; j++) {
        cusall[j].style.display = 'none';
    }
    if (!resultsFound) {
        document.getElementById('searcherror').style.display = 'block';
        document.getElementById('error_msg').style.display = 'none';
    } else {
        document.getElementById('searcherror').style.display = 'none';
    }
}

let map;
let drawnPolygons = [];
let drawingManager;
let totalArea = 0;
let totalDistance = 0;

function initMap() {
    const mapElement = document.getElementById('map');
    const mpqr = document.getElementById("mpqr");

    if (!mapElement || !mpqr) {
        console.error("Map or MPQR element not found.");
        return;
    }

    const inputCoordinates = mpqr.value;

    const predefinedCoordinates = JSON.parse(mpqr.value);
    const bounds = new google.maps.LatLngBounds();
    predefinedCoordinates.forEach((coordinates) => {
        bounds.extend(new google.maps.LatLng(coordinates.lat, coordinates.lng));
    });
    const center = bounds.getCenter();

    map = new google.maps.Map(mapElement, {
        center: center,
        zoom: 12,
        disableDefaultUI: true,
        mapTypeId: 'satellite',
        mapTypeControl: true,
        zoomControl: true,
    });

    drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: false,
        polygonOptions: {
            editable: false,
            draggable: false,
            strokeColor: 'rgb(220, 53, 69)',
            strokeWeight: 5,
            fillColor: 'rgb(220, 53, 69)',
            fillOpacity:0.15,
        },
    });

    drawingManager.setMap(map);
    map.setOptions({ mapTypeCursor: 'text' });

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
        // ... (rest of your code)
    });

    createPredefinedPolygons();
    function initializeSearchBox(inputElement, map) {
        var input = document.getElementById(inputElement);
        var searchBox = new google.maps.places.SearchBox(input);
      
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
      
        var markers = [];
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
      
          if (places.length === 0) {
            return;
          }
      
          // Clear previous markers
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];
      
          // For each place, add a marker and set map center
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
      
            markers.push(new google.maps.Marker({
              map: map,
              title: place.name,
              position: place.geometry.location
            }));
      
            if (place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }
      
      // Initialize for searchInput
      initializeSearchBox('searchInput', map);
    
      // Initialize for searchInput2
      initializeSearchBox('searchInput2', map);
};


function updateTable() {
    const coordinatesTable = document.getElementById('coordinatesTable').getElementsByTagName('tbody')[0];
    coordinatesTable.innerHTML = '';

    drawnPolygons.forEach((polygon, index) => {
        const row = coordinatesTable.insertRow();

        const polygonCell = row.insertCell(0);
        polygonCell.textContent = `Polygon ${index + 1}`;

        const coordinatesCell = row.insertCell(1);
        const coordinates = polygon.getPath().getArray();
        coordinatesCell.textContent = JSON.stringify(coordinates);

        const areaCell = row.insertCell(2);
        const area = google.maps.geometry.spherical.computeArea(polygon.getPath());
        const areaInSquareMeters = area.toFixed(2);
        const areaInSquareKm = (area / 1000000).toFixed(2);
        areaCell.textContent = `${areaInSquareKm} km² (${areaInSquareMeters} m²)`;

        const distanceCell = row.insertCell(3);
        const perimeter = google.maps.geometry.spherical.computeLength(polygon.getPath());
        const perimeterInMeters = perimeter.toFixed(2);
        const perimeterInKm = (perimeter / 1000).toFixed(2);
        distanceCell.textContent = `${perimeterInKm} km (${perimeterInMeters} m)`;
    });
}

function updateTotalAreaAndDistance() {
    let totalArea = 0;
    let totalDistance = 0;

    let coordinatesArray = [];

    drawnPolygons.forEach((polygon) => {
        const area = google.maps.geometry.spherical.computeArea(polygon.getPath());
        totalArea += area;

        const perimeter = google.maps.geometry.spherical.computeLength(polygon.getPath());
        totalDistance += perimeter;

        const path = polygon.getPath().getArray();
        path.forEach((point) => {
            coordinatesArray.push({ lat: point.lat(), lng: point.lng() });
        });
    });

    const totalAreaInSquareKm = (totalArea / 1000000).toFixed(2);
    const totalDistanceInKm = (totalDistance / 1000).toFixed(2);

    const totalDistanceDiv = document.getElementById('dist');
    totalDistanceDiv.textContent = `Total Distance: ${totalDistanceInKm} km`;

    const totalAreaDiv = document.getElementById('tarea');
    totalAreaDiv.textContent = `Total Area: ${totalAreaInSquareKm} km² (${totalArea.toFixed(2)} m²)`;

    const coordinatesInput = document.querySelector('input[name="quardinates"]');
    coordinatesInput.value = JSON.stringify(coordinatesArray);
}

var mpqr = document.getElementById("mpqr");
const inputCoordinates = mpqr.value;
const predefinedCoordinates = JSON.parse(inputCoordinates);
function createPredefinedPolygons() {
    predefinedCoordinates.forEach((coordinates, index) => {
        const polygon = new google.maps.Polygon({
            paths: predefinedCoordinates,
            editable: false,
            draggable: false,
            strokeColor: 'rgb(220, 53, 69)',
            strokeWeight: 5,
            fillColor: 'rgb(220, 53, 69)',
            fillOpacity:0.15,
            map: map
        });

        drawnPolygons.push(polygon);
    });
};




function changeColorOnClick() {
    const customDrawButton = document.getElementById('customDrawButton');
    customDrawButton.classList.toggle('changeColor');
}

// Remove unnecessary features
$(function () {
    $(".form-popup").hide();
    $(".pol-popup").hide();
    $(".dis-popup").hide();

    $('#toggleButton').click(function () {
        $('.elementToToggle').hide();
        $('#toggleButton1').show();
    });

    $('#toggleButton1').click(function () {
        $('.elementToToggle').show();
        $('#toggleButton1').hide();
    });
});
