<div class="container">

<div class="row">
	<div class="col-xs-12">
		<?php 
			$locationName = $this->uri->segment(3, 0);
			$locationName = explode("--", $locationName); 
		?>
		<div class="locationBanner">
			<h1><?php echo $locationName[0]; ?></h1>
			<p><?php echo $locationName[1]; ?></p>
		</div>
	</div>
</div>
		
<div class="row">
    <div class="col-md-3">

        <?php $this->load->view('common/sidebarLocation'); ?>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-9 hotels">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<h2>Search Results</h2>
		</div>
		<div class="col-xs-12 col-sm-6 text-right">
			<h2><small>Sort By: <span></span></small></h2>
		</div>
    </div>
	<?php if(isset($error)) { ?>
        <div class="alert alert-success">
            <p>echo $error; } ?></p>
        </div>
    <?php } else { ?>
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
} );
</script>
