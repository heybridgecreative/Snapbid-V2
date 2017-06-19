    var apiGeolocationSuccess = function(position) {
		alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
	};

	var tryAPIGeolocation = function() {
		jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyAjTApW0528nRkzmJKIKyIzOVU_gi9g1HM", function(success) {
			apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
	  })
	  .fail(function(err) {
		var div = document.getElementById('map');
		div.innerHTML = '<div class="noLocation"><div class="container"><div class="icon"><i class="fa fa-times"> </i></div><h3>Cannot retrieve location.</h3> <p>Please allow SnapBid to see your location for the nearby search to take place</p></div></div>';
	  });
	};

	var browserGeolocationSuccess = function(position) {
		var myLat = position.coords.latitude;
		var myLng = position.coords.longitude;
		var div = document.getElementById('map');
		div.innerHTML = div.innerHTML + '<div class="noLocation finding"><div class="container"><div class="icon"><i class="fa fa-spinner fa-spin"> </i></div><h3>Retrieving location...</h3> <p>Please be patient whilst we gather your location and nearby hotels.</p></div></div>';
		document.cookie = "myCoords = " + myLat + "," + myLng;
		setTimeout(function () { location.reload(true); }, 5000);
	};

	var browserGeolocationFail = function(error) {
	  switch (error.code) {
	    case error.TIMEOUT:
	      alert("Browser geolocation error !\n\nTimeout.");
	      break;
	    case error.PERMISSION_DENIED:
	      if(error.message.indexOf("Only secure origins are allowed") == 0) {
	        tryAPIGeolocation();
	      }
	      break;
	    case error.POSITION_UNAVAILABLE:
	      alert("Browser geolocation error !\n\nPosition unavailable.");
	      break;
	  }
	};

	var tryGeolocation = function() {
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(
	    	browserGeolocationSuccess,
	      browserGeolocationFail,
	      {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
	  }
	};

	tryGeolocation();