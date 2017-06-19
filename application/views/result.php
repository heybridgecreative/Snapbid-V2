<div class="container">
	
	<div class="row dateSet">
        <div class="col-xs-12">
            <h3>Your Search Criteria</h3>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-12 col-md-3 col-sm-12">
                <p class="checkDate">
					<span class="icon">
						<img src="../assets/images/location.png">
					</span>
					<strong>Location:</strong><br /><?php echo $location; ?>
				</p>
            </div>
			<div class="col-xs-6 col-md-2 col-xs-6">
                <p class="checkDate">
					<span class="icon">
						<img src="../assets/images/checkin.png">
					</span>
					<strong>Check-in:</strong><br /><?php echo $datef; ?>
				</p>
            </div>
			<div class="col-xs-6 col-md-2 col-xs-6">
                <p class="checkDate">
					<span class="icon">
						<img src="../assets/images/checkout.png">
					</span>
					<strong>Check-out:</strong><br /><?php echo $datet; ?>
				</p>
            </div>
			<div class="col-xs-12 col-md-3 col-xs-12">
                <p class="checkDate">
					<span class="icon">
						<img src="../assets/images/adults.png">
					</span>
					<strong>Persons and Rooms:</strong><br /><?php echo $adults; ?> adults - <?php echo $roomAmount; ?> rooms
				</p>
            </div>
                <?php if($children > 0) { ?>
			<div class="col-xs-6 col-md-2 col-xs-6">
                        <p class="checkDate">
							<span class="icon">
								<img src="../assets/images/children.png">
							</span>
							<strong>Children:</strong><br /><?php echo $children; ?>
						</p>
                    </div>
                <?php } ?>
			<div class="col-xs-12 col-md-2 col-xs-12">
                <p class="checkDate editSearch">
					<span class="icon">
						Change Search
					</span>
					<strong>&nbsp;</strong><br />&nbsp;
				</p>
            </div>
        </div>
    </div>


	<div class="row dateChange" style="display:none">
        <?php $this->load->view('common/changeSearch'); ?>
    </div>



<script>
	jQuery(document).ready(function($) {
		$('.editSearch').click(function(){
			$('.dateSet').hide();
			$('.dateChange').show();
    		$('#location').focus();
			$('#datef').pickadate({
				onSet: function() {
					alert('fuck');
				}
			});
		});
		$('.changeSearch').click(function(){
			$('.dateSet').show();
			$('.dateChange').hide();
		});
	});
</script>
	
<div class="row">
    <div class="col-md-3">

        <?php $this->load->view('common/sidebar'); ?>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-9 hotels">
	<div class="row">
		<div class="col-xs-12">
			<h2>Search Results</h2>
		</div>
    </div>
	<?php if(isset($error)) { ?>
        <div class="alert alert-success">
            <p>echo $error; } ?></p>
        </div>
    <?php } else { ?>
            <?php foreach ($hotelsPage as $hotel) { ?>
              <a href="hotel/<?php echo $hotel['ID']; ?>" target="_blank">
                <div class="row hotel">
                    <div class="col-xs-12 col-sm-4 hotel-image">
                        <div class="image" style="background-image:url(<?php echo $hotel['Image']; ?>);">

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 hotel-info">
						<div class="row">
                            <div class="col-xs-8">
                                <p class="title"><?php echo $hotel['Name'] ?></p>
                                <p class="hotelAddress"><?php echo $hotel['Address'] . ', ' . $hotel['City'] . ', ' . $hotel['Province']; ?></p>

                                <p>
                                    <?php 
                                        echo str_repeat("<i class='fa fa-star'> </i>", $hotel['StarRating'] - 0);  
                                        $outlines = 5 - ($hotel['StarRating'] - 0); 
                                        echo str_repeat("<i class='fa fa-star-o'> </i>", $outlines); 
                                    ?>
                                </p>

                            </div>
                            <div class="col-xs-4">
                                <p><?php echo $hotel['GuestRating']; ?> (<?php echo $hotel['GuestRating']; ?>)<br /><?php echo $hotel['GuestReviewCount']; ?> Reviews</p>
                                <p>&nbsp;</p>
                                <p class="hotelPrice"><strong><?php echo $hotel['TotalPrice'] . ' ' . $hotel['Currency']; ?></strong></p>
                            </div>
                            <div style="clear:both;"></div>
                            <!--
							<div class="row buttons">
                                <div class="col-xs-12 buttons">
                                    <button class="purpleBtn">Book</button>
                                    <a href="hotel/<?php echo $hotel['ID']; ?>" class="greyBtn">More Info</a>
                                </div>
                            </div>
							-->
                        </div>
                    </div>
                    </div>
				</a>
            <?php }  ?>
        <?php }  ?>
        
        <?php echo $pagination; ?>
        
    </div>
</div>
</div>

<div class="filter-button"> 
	<i class="fa-filter fa fa-fw">&nbsp;</i>
</div>

<script>
$('.filter-button').click( function() {
    $(".sidebar").toggleClass("active");
});
</script>
