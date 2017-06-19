<div class="container">
    <div class="row mainInfo">
        <div class="col-sm-6">
            <h1><?php echo $hotelName; ?></h1>
            <p><?php echo $hotelAddress; ?>, <?php echo $hotelCity; ?>, <?php echo $hotelCountry; ?></p>
        </div>
        <div class="col-sm-6">
			<?php $trips = $this->aauth->get_user_var($hotelID); ?>
			<?php if(!$trips) { ?>
				<form id="addToTripsForm">
					<input type="hidden" name="hotelName" value="<?php echo $hotelName; ?>">
					<input type="hidden" name="hotelID" value="<?php echo $this->uri->segment(2); ?>">
					<input type="hidden" name="featuredImage" value="<?php echo $featuredImage; ?>">
					<button class="orangeBtn padding20" id="addToTripsFormsubmit"><i class="fa fa-star-o"></i> Add to Trips</button>
				</form>
				<form id="removefromTripsForm" class="hidden">
					<input type="hidden" name="hotelName" value="<?php echo $hotelName; ?>">
					<input type="hidden" name="hotelID" value="<?php echo $this->uri->segment(2); ?>">
					<input type="hidden" name="featuredImage" value="<?php echo $featuredImage; ?>">
					<button class="orangeBtn padding20" id="removefromTripsFormsubmit"><i class="fa fa-star"></i> Remove from Trips</button>
				</form>
			<?php } else { ?>
				<form id="addToTripsForm" class="hidden">
					<input type="hidden" name="hotelName" value="<?php echo $hotelName; ?>">
					<input type="hidden" name="hotelID" value="<?php echo $this->uri->segment(2); ?>">
					<input type="hidden" name="featuredImage" value="<?php echo $featuredImage; ?>">
					<button class="orangeBtn padding20" id="addToTripsFormsubmit"><i class="fa fa-star-o"></i> Add to Trips</button>
				</form>
				<form id="removefromTripsForm">
					<input type="hidden" name="hotelName" value="<?php echo $hotelName; ?>">
					<input type="hidden" name="hotelID" value="<?php echo $this->uri->segment(2); ?>">
					<input type="hidden" name="featuredImage" value="<?php echo $featuredImage; ?>">
					<button class="orangeBtn padding20" id="removefromTripsFormsubmit"><i class="fa fa-star"></i> Remove from Trips</button>
				</form>
			<?php } ?>
	<script>
      $(function () {
        $('#addToTripsFormsubmit').on('click', function (e) {
		$(this).toggleClass("adding"); //you can list several class names 
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'addToTrips/',
            data: $('#addToTripsForm').serialize(),
            success: function () {
				$('#addToTripsFormsubmit').toggleClass("added");
				$('#removefromTripsForm').removeClass("hidden"); 
				$('#addToTripsForm').addClass("hidden");  
            }
          });
		  return false;
        });
      });
    </script>
	<script>
      $(function () {
        $('#removefromTripsFormsubmit').on('click', function (e) {
		$(this).toggleClass("removing"); //you can list several class names 
          e.preventDefault();
		  return false;
          $.ajax({
            type: 'post',
            url: 'addToTrips/',
            data: $('#removefromTripsForm').serialize(),
            success: function () {
				$('#removefromTripsFormsubmit').toggleClass("removed"); 
				$('#removefromTripsForm').addClass("hidden"); 
				$('#addToTripsForm').removeClass("hidden"); 
            }
          });
        });
      });
    </script>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-lg-6 main-image">
            <?php foreach($hotelPhotos as $photo) { ?>
                <?php if(!empty($photo->featured)) { ?>
                    <img src="//images.trvl-media.com/<?php echo $photo->url; ?>" alt="<?php echo $photo->displayText; ?>">
                <?php } else { continue; } ?>
            <?php } ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-3 sm-images">
            <div class="imageslide">
                <div>
                    <?php $i = 0; foreach($hotelPhotos as $photo) { ?>
                        <a class="fancybox-thumb" rel="gallery" href="//images.trvl-media.com/<?php echo $photo->url; ?>" title="<?php if(isset($photo->displayText)) { echo $photo->displayText; } else { echo $hotelName; } ?>">
                            <img src="//images.trvl-media.com/<?php echo $photo->thumbnailUrl; ?>" alt="<?php if(isset($photo->displayText)) { echo $photo->displayText; } else { echo $hotelName; } ?>">
                        </a>
                         <?php 
                            $i++;
                            if($i % 12 === 0) {
                                print "<br style='clear:both;' /></div><div>";
                            }
                        ?>

                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 ratingmap">
		<div class="ratingmapContain">
            <div class="rating">
                <h2><?php echo $ratingTitle; ?></h2>
                <h4 style="width:50%; float:left;"><?php echo $rating; ?> <small>out of 5</small></h4>
                <h4 style="width:50%; float:left;"><?php echo $reviews; ?> reviews</h4>
				<div style="clear:both;"></div>
            </div>
            <div id="map">
                <img width="100%" src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $fullAddress;?>&zoom=15&scale=false&key=AIzaSyAjTApW0528nRkzmJKIKyIzOVU_gi9g1HM&size=400x360&maptype=roadmap&format=jpg&visual_refresh=true&markers=size:mid%7Ccolor:0xfe452e%7Clabel:%7C<?php echo $fullAddress;?>" alt="Google Map of <?php echo $fullAddress;?>">
            </div>
        </div>
        </div>
    </div>
    
    <?php if(!$this->aauth->is_loggedin()) { ?>
    <div class="loginToBidReminder">
        <div class="row">
            <div class="col-sm-12">
                <div class="orangeBtn login bounce animated">
                    You don't seem to be logged in. Login now to enjoy the fun and exciting new way of booking a room with SnapBid!
                </div>
            </div>
        </div>
    </div>
	<?php } ?>
    
    
    <div class="row">
        <div class="col-xs-12">
            <h2>Rooms at <?php echo $hotelName; ?></h2>
        </div>
        <div class="col-xs-12">
            <?php echo $hotelRoomInfo; ?>
        </div>
    </div>
    <?php if(isset($datef, $datet)) { ?>
    <div class="row dateSet">
        <div class="col-xs-12">
            <h3>Your Search Criteria</h3>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-6 col-sm-2">
                <p class="checkDate">
					<span class="icon">
						<img src="../../assets/images/checkin.png">
					</span>
					<strong>Check-in:</strong><br /><?php echo $datef; ?>
				</p>
            </div>
            <div class="col-xs-6 col-sm-2">
                <p class="checkDate">
					<span class="icon">
						<img src="../../assets/images/checkout.png">
					</span>
					<strong>Check-out:</strong><br /><?php echo $datet; ?>
				</p>
            </div>
            <div class="col-xs-6 col-sm-2">
                <p class="checkDate">
					<span class="icon">
						<img src="../../assets/images/adults.png">
					</span>
					<strong>Adults:</strong><br /><?php echo $adults; ?>
				</p>
            </div>
                <?php if($children > 0) { ?>
                    <div class="col-xs-6 col-sm-2">
                        <p class="checkDate">
							<span class="icon">
								<img src="../../assets/images/children.png">
							</span>
							<strong>Children:</strong><br /><?php echo $children; ?>
						</p>
                    </div>
                <?php } ?>
            <div class="col-xs-6 col-sm-2">
                <p class="checkDate">
					<span class="icon">
						<img src="../../assets/images/rooms.png">
					</span>
					<strong>Rooms:</strong><br /><?php echo $roomAmount; ?>
				</p>
            </div>
        </div>
    </div>
    
    

    
    <?php
	if($roomTypeList != "noRooms") {
        $already_echoed = array();
        foreach ($roomTypeList as $room) {
            if(isset($room['RemainingCount'])) { 
                if (!in_array($room['Description'], $already_echoed)) { 
                    $uniques[] = $room['Description'];
                }
                $already_echoed[] = $room['Description']; 
            } else {
                continue;
            }
        } 
	}                          
    ?>
    
    <?php $previous = ""; ?>
    
    <?php if(isset($uniques)) { ?>
        <?php foreach($uniques as $unique) { ?>
			<?php $i = 0; ?>
            <?php foreach ($roomTypeList as $room) { ?>
                <?php if($room['Description'] == $unique) { ?>	 
	
					<?php if($room['Description'] === $previous) { ?>
								<div class="col-xs-9 same">
									<div class="col-xs-8 roomInformation roomHeight" id="room<?php echo $i; ?>">
										<ul class="payment">
											<li><strong><?php if($room['PaymentMethod'] == 'Hotel') { ?>No SnapBid booking or credit card fees - Payment taken at Hotel<?php } else { ?>Pay online securely through SnapBid - Payment taken Online<?php } ?></strong></li>
											<?php if($room['FreeCancellation'] !== "false") { ?>
												<li>Free Cancellation until <?php echo date("jS M Y", strtotime($room['FreeCancellationEndDateTime'])); ?></li>
											<?php } ?>
											<li><?php if($room['Refundable'] !== 'false') { ?>Refundable<?php } else { ?>Non-Refundable<?php } ?></li>
										</ul>
										<?php if(isset($room['RoomAmenityList'])) { ?>
											<ul class="amenities">
												<?php if(array_key_exists(0, $room['RoomAmenityList']['RoomAmenity'])) { ?>
													<?php foreach($room['RoomAmenityList']['RoomAmenity'] as $roomAmenity) { ?>
														<li><?php echo $roomAmenity['Name']; ?></li>
													<?php } ?>
												<?php } else { ?>
													<?php foreach($room['RoomAmenityList'] as $roomAmenity) { ?>
														<li><?php echo $roomAmenity['Name']; ?></li>
													<?php } ?>
												<?php } ?>
											</ul>
										<?php } ?>
									</div>
									<div class="col-xs-2 roomPrice roomHeight">
										<div class="price">
											<?php if (array_key_exists('Promotion', $room)) { ?> 
												<h3 class="promotion"><strike><small>&pound;<?php echo $room['Price']['TotalRate']['Value']; ?></small></strike><br /><strong>&pound;<?php $promotionPrice = $room['Price']['TotalRate']['Value'] - $room['Promotion']['Amount']['Value']; echo number_format($promotionPrice, 2, '.', ''); ?></strong></h3>
											<?php } else { ?>
												<h3>&pound;<?php echo $room['Price']['TotalRate']['Value']; ?></h3>
											<?php } ?>
										</div>
									</div>
									<div class="col-xs-2 roomButtons roomHeight">
										<a target="_blank" href="<?php echo $URL; ?>"><button class="purpleBtn width100">Book Room</button></a>
										<a href="#"><button data-toggle="tooltip" data-placement="right" title="Hooray!" class="orangeBtn width100">Send a Bid</button></a>
									</div>
								</div>
                <?php } else { ?>
							<?php  if($i >= 0) { ?><div class="containerForRoom" id="room"><div class="row room"><?php } ?>
                                <div class="col-xs-3 roomsListHeight">
									<div class="roomDetails">
										<img alt="<?php echo $hotelName; ?>" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=Image%20Coming%20Soon&w=270&h=170">
										<h3><?php echo $room['Description']; ?></h3><p><small><?php if(isset($room['RemainingCount'])) { if($room['RemainingCount'] < 3) { echo "Only "; } echo $room['RemainingCount']; ?> Remaining<?php } ?></small></p>
										<p>&nbsp;</p>
									</div>
                                </div>
								<div class="roomsList roomsListHeight" id="room<?php echo $i; ?>">
								<div class="col-xs-9">
									<div class="col-xs-8 roomInformation roomHeight" id="room<?php echo $i; ?>">
										<ul class="payment">
											<li>
												<strong>
													<?php if($room['PaymentMethod'] == 'Hotel') { ?>
														No SnapBid booking or credit card fees - Payment taken at Hotel
													<?php } else { ?>
														Pay online securely through SnapBid - Payment taken Online
													<?php } ?>
												</strong>
											</li>
											<?php if($room['FreeCancellation'] !== "false") { ?>
												<li>Free Cancellation until <?php echo date("jS M Y", strtotime($room['FreeCancellationEndDateTime'])); ?></li>
											<?php } ?>
											<li><?php if($room['Refundable'] !== 'false') { ?>Refundable<?php } else { ?>Non-Refundable<?php } ?></li>
										</ul>
										<?php if(isset($room['RoomAmenityList'])) { ?>
											<ul class="amenities">
												<?php if(array_key_exists(0, $room['RoomAmenityList']['RoomAmenity'])) { ?>
													<?php foreach($room['RoomAmenityList']['RoomAmenity'] as $roomAmenity) { ?>
														<li><?php echo $roomAmenity['Name']; ?></li>
													<?php } ?>
												<?php } else { ?>
													<?php foreach($room['RoomAmenityList'] as $roomAmenity) { ?>
														<li><?php echo $roomAmenity['Name']; ?></li>
													<?php } ?>
												<?php } ?>
											</ul>
										<?php } ?>
									</div>
									<div class="col-xs-2 roomPrice roomHeight">
										<div class="price">
											<?php if (array_key_exists('Promotion', $room)) { ?> 
												<h3 class="promotion"><strike><small>&pound;<?php echo $room['Price']['TotalRate']['Value']; ?></small></strike><br /><strong>&pound;<?php $promotionPrice = $room['Price']['TotalRate']['Value'] - $room['Promotion']['Amount']['Value']; echo number_format($promotionPrice, 2, '.', ''); ?></strong></h3>
											<?php } else { ?>
												<h3>&pound;<?php echo $room['Price']['TotalRate']['Value']; ?></h3>
											<?php } ?>
										</div>
									</div>
									<div class="col-xs-2 roomButtons roomHeight">
										<a target="_blank" href="<?php echo $URL; ?>"><button class="purpleBtn width100">Book Room</button></a>
										<a href="#"><button data-toggle="tooltip" data-placement="right" title="Hooray!" class="orangeBtn width100">Send a Bid</button></a>
									</div>
								</div>
						
                    <?php } ?>
                <?php $previous = $room['Description']; ?>
                <?php } ?>
				<?php if ($room === end($roomTypeList)) {
        			echo '<div style="clear:both"></div></div></div></div>';
				} ?>
				<?php $i++; ?>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <div class="noRoomsNot">
            <div class="col-xs-12">
                <div class="orangeBtn noRooms bounce animated">
                    Sorry! There are no rooms available for the above search. Please try again with different dates!
                </div>
            </div>
        </div>
		<?php $this->view('common/searchbarHotel.php'); ?>
    <?php } ?>
    
    <? } else { ?>
    <h3>Please choose your dates:</h3> 
    <div class="roomSearch">
		<?php $this->view('common/searchbarHotel.php'); ?>
    </div>
    <?php } ?>
    
    <div class="row">
        <div class="col-xs-12">
            <h2>Hotel Details</h2>
        </div>
        <div class="col-sm-7 col-xs-12 hotelDetails">
            <?php echo $hotelAmenities; ?>
        </div>
        <div class="col-sm-5 col-xs-12">
            <div class="fees">
                <?php echo $hotelFees; ?>
            </div>
        
            <div class="location">
                <?php echo $locationDetails; ?>
                <?php echo $pointsOfInterest; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2>Extra Information</h2>
            <?php echo $otherDescription; ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<script>
    $('.imageslide').slick({
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
        dots: true,
        arrows: true
    });
</script>
<script>
    $(document).ready(function() {
        $(".fancybox-thumb").fancybox({
            prevEffect	: 'none',
            nextEffect	: 'none',
            helpers	: {
                title	: {
                    type: 'outside'
                },
                thumbs	: {
                    width	: 50,
                    height	: 50
                }
            }
        });
    });
</script>
<script>
	equalheight = function(container){

	var currentTallest = 0,
		 currentRowStart = 0,
		 rowDivs = new Array(),
		 $el,
		 topPosition = 0;
	 $(container).each(function() {

	   $el = $(this);
	   $($el).height('auto')
	   topPostion = $el.position().top;

	   if (currentRowStart != topPostion) {
		 for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		   rowDivs[currentDiv].height(currentTallest);
		 }
		 rowDivs.length = 0; // empty the array
		 currentRowStart = topPostion;
		 currentTallest = $el.height();
		 rowDivs.push($el);
	   } else {
		 rowDivs.push($el);
		 currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
	  }
	   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		 rowDivs[currentDiv].height(currentTallest);
	   }
	 });
	}

	$(window).load(function() {
	  equalheight('.roomHeight');
	  equalheight('.roomsListHeight');
	});

	$(window).resize(function(){
	  equalheight('.roomHeight');
	  equalheight('.roomsListHeight');
	});
</script>





<div id="SABModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
jQuery(function ($) {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

