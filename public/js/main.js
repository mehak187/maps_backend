$(document).ready(function () {
    $(".form-popup").hide();

    $(".open-form").click(function () {
        $(".form-popup").show();
        $(".pol-popup").hide();
    });
    $("#show").click(function () {
        $(".pol-popup").hide();
    });
    $(".close-distance").click(function () {
        $(".dis-popup").hide();
    });
    $(".close-pol").click(function () {
        $(".pol-popup").hide();
    });
    $(".close-form").click(function () {
        $(".form-popup").hide();
    });

});
let map;
let drawnPolygons = [];
let drawingManager;
let totalArea = 0;
let totalDistance = 0;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 51.5074, lng: -0.1278 },
        zoom: 12,
        disableDefaultUI: true,
        mapTypeControl: true,
        zoomControl: true,
    });

    drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: false,
        polygonOptions: {
            editable: false,
            draggable: false,
            strokeColor: '#FF0000',
            strokeWeight: 5,
            fillColor: '#FF0000',
            fillOpacity:0.35,


        },
    });

    drawingManager.setMap(map);
    map.setOptions({ mapTypeCursor: 'text' });
    const customDrawButton = document.getElementById('customDrawButton');
    const customUndoButton = document.getElementById('customUndoButton');
    customDrawButton.addEventListener('click', function () {
        drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
        changeColorOnClick();
    });

    customUndoButton.addEventListener('click', function () {
        undoLastPolygon();
        drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
    });

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
        if (event.type === google.maps.drawing.OverlayType.POLYGON) {
            const drawnPolygon = event.overlay;
            drawnPolygon.setOptions({
                strokeColor: '#FF0000',
                fillColor: '#FF0000',
                editable: false,
                draggable: false,
            });
    
            if (drawnPolygons.length > 0) {
                event.overlay.setMap(null);
            } else {
                drawnPolygons.push(drawnPolygon);
                updateTable();
                updateTotalAreaAndDistance();
    
                drawingManager.setDrawingMode(null);
                customDrawButton.disabled = true;
                
                changeColorOnClick();
    
                // Execute the jQuery code in the 'else' block
                $(document).ready(function () {
                    $(".form-popup").hide();
                    $(".pol-popup").show();
                    $(".dis-popup").show();
                    
                    $(".open-form").click(function () {
                        $(".form-popup").show();
                        $(".pol-popup").show();
                    });
                    $("#show").click(function () {
                        $(".pol-popup").hide();
                    });
                    $(".close-distance").click(function () {
                        $(".dis-popup").hide();
                    });
                    $(".close-pol").click(function () {
                        $(".pol-popup").hide();
                    });
                    $(".close-form").click(function () {
                        $(".form-popup").hide();
                    });
                });
            }
        }
    });
    
    

    displayPredefinedPolygons();

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
}

function undoLastPolygon() {
    if (drawnPolygons.length > 0) {
        const lastPolygon = drawnPolygons.pop();
        lastPolygon.setMap(null);
        totalArea = 0;
        totalDistance = 0;
        updateTotalAreaAndDistance();
        changeColorOnClick();

        // Adding the provided code
        $(document).ready(function () {
            $(".form-popup").hide();
            $(".pol-popup").hide();
            $(".dis-popup").hide();
        });
    }
}

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

    let coordinatesString = '';

    drawnPolygons.forEach((polygon) => {
        const area = google.maps.geometry.spherical.computeArea(polygon.getPath());
        totalArea += area;

        const perimeter = google.maps.geometry.spherical.computeLength(polygon.getPath());
        totalDistance += perimeter;

        const path = polygon.getPath().getArray();
        path.forEach((point) => {
            coordinatesString += `${point.lat()}, ${point.lng()}\n`;
        });
    });

    const totalAreaInSquareKm = (totalArea / 1000000).toFixed(2);
    const totalDistanceInKm = (totalDistance / 1000).toFixed(2);

    const totalDistanceDiv = document.getElementById('dist');
    totalDistanceDiv.textContent = `Total Distance: ${totalDistanceInKm} km`;

    const totalAreaDiv = document.getElementById('tarea');
    totalAreaDiv.textContent = `Total Area: ${totalAreaInSquareKm} km² (${totalArea.toFixed(2)} m²)`;

    const coordinatesInput = document.querySelector('input[name="quardinates"]');
    coordinatesInput.value = coordinatesString;
}

function displayPredefinedPolygons() {
    const polygon1Coords = [
        { lat: 51.54708206708964, lng: -0.25311280517577917 },
        { lat: 51.54708206708964, lng: -0.15835572509765417 },
        { lat: 51.513763473228366, lng: -0.19268800048827917 },
        { lat: 51.53170728458978, lng: -0.25448609619140417 },
        { lat: 51.54195771669841, lng: -0.23663331298827917 },
        { lat: 51.54537401441339, lng: -0.25448609619140417 },
    ];
    const polygon1 = new google.maps.Polygon({
        paths: polygon1Coords,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
    });
    polygon1.setMap(map);
}

function changeColorOnClick() {
    const customDrawButton = document.getElementById('customDrawButton');
    customDrawButton.classList.toggle('changeColor');
}
$(document).ready(function () {
    $('#toggleButton').click(function () {
        $('.elementToToggle').hide();
        $('#toggleButton1').show();
        
    });
    $('#toggleButton1').click(function () {
        $('.elementToToggle').show();
        $('#toggleButton1').hide();
        
    });
});