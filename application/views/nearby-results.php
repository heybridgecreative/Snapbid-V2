<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Snapbid Nearby</h1>
			<p>Find hotels near to your current location!</p>
		</div>
	</div>
</div>

<div id="map-canvas"></div>


<script>
	var LocationData = [
		<?php foreach($hotels as $hotel) { ?>
			[<?php echo $hotel['Latitude']; ?>, <?php echo $hotel['Longitude']; ?>, "<?php echo $hotel['Name']; ?>"],
		<?php } ?>
	];
</script>
<script type="text/javascript">
	function initialize() {	
			var myLatLng = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
			var myOptions = {
      			center: myLatLng,
      			zoom: 12,
				draggable: false
    		};
		    var map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
		    var bounds = new google.maps.LatLngBounds();
		    var infowindow = new google.maps.InfoWindow();
     
		    for (var i in LocationData)
		    {
		        var p = LocationData[i];
		        var latlng = new google.maps.LatLng(p[0], p[1]);
		        bounds.extend(latlng);
         
		        var marker = new google.maps.Marker({
		            position: latlng,
		            map: map,
		            title: p[2],
					icon: {
					url: 'http://snapbidv2.azurewebsites.net/assets/images/map-marker-hotel.png',
			  		scaledSize:new google.maps.Size(22, 32)
			  		}
		        });
     
		        google.maps.event.addListener(marker, 'click', function() {
 		           infowindow.setContent(this.title);
 		           infowindow.open(map, this);
		        });
		    }

			var marker = new google.maps.Marker({
 	      	  position: myLatLng,
	      	  map: map,
	      	  title: '',
			  icon: {
					url: 'http://snapbidv2.azurewebsites.net/assets/images/map-marker.png',
			  		scaledSize:new google.maps.Size(22, 32)
			  }
	    	});

			var cityCircle = new google.maps.Circle({
            	strokeColor: '#000',
            	strokeOpacity: 0.2,
            	strokeWeight: 2,
            	fillColor: '#000',
            	fillOpacity: 0.1,
            	map: map,
            	center: map.center,
            	radius: 5000,
				clickable:false
          	});
			     
	}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjTApW0528nRkzmJKIKyIzOVU_gi9g1HM&callback=initialize"></script>

<div class="container">
<div class="row" style="margin:30px 0px;">
	<div class="col-xs-12">
		<h2>Nearby Search Results</h2>
	</div>	
</div>
<div class="row">
	<?php foreach ($hotelsPage as $hotel) { ?>
              <a href="<?php echo site_url(); ?>/hotel/<?php echo $hotel['ID']; ?>">
                <div class="row hotel">

					

                    <div class="col-xs-4">
                        <div class="image" style="background-image:url(<?php echo $hotel['Image']; ?>);">

                        </div>
                    </div>
                    <div class="col-xs-8 hotel-info">
						<div class="row">
                            <div class="col-xs-12 col-sm-8">
                                <p class="title"><?php echo $hotel['Name'] ?></p>
                                <p class="hotelAddress"><?php if(is_array($hotel['Address'])) { echo implode(",", $hotel['Address']); } else { echo $hotel['Address']; } ?>, <?php if(is_array($hotel['City'])) { echo implode(",", $hotel['City']); } else { echo $hotel['City']; } ?> <?php if(is_array($hotel['Province'])) { echo implode(",", $hotel['Province']); } else { echo $hotel['Province']; } ?></p>

                                <p>
                                    <?php 
                                        echo str_repeat("<i class='fa fa-star'> </i>", $hotel['StarRating'] - 0);  
                                        $outlines = 5 - ($hotel['StarRating'] - 0); 
                                        echo str_repeat("<i class='fa fa-star-o'> </i>", $outlines); 
                                    ?>
                                </p>

                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <p><?php echo $hotel['GuestRating']; ?> (<?php echo $hotel['GuestRating']; ?>)<br /><?php echo $hotel['GuestReviewCount']; ?> Reviews</p>
                                <p>&nbsp;</p>
                                <p class="hotelPrice"><strong>More Information</strong></p>
                            </div>
                            <div style="clear:both;"></div>
                            <!--
							<div class="row buttons">
                                <div class="col-xs-12 buttons">
                                    <button class="purpleBtn">Book</button>
                                    <a href="<?php echo site_url(); ?>/hotel/<?php echo $hotel['ID']; ?>" class="greyBtn">More Info</a>
                                </div>
                            </div>
							-->
                        </div>
                    </div>
                    </div>
				</a>
            <?php }  ?>
        
        <?php echo $pagination; ?>

</div>
</div>