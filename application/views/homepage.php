

<div class="container explain">
	<div class="row">
		<div class="col-xs-12">
		<div class="col-xs-12 col-sm-4">
			<h3>Finding your perfect hotel has never been so easy.</h3> 
			<p>Snapbid means that you are able to quickly search for your desired hotel and offer a price that you think the room would be sold for on the date selected.</p>
			<p style="margin:0px auto;"><a href="index.php/customerservice/help" style="padding:11px 16px;" class="orangeBtn">How SnapBid works</a></p>
		</div>
		<div class="col-xs-12 col-sm-8 fadein">
			<img src="<?php echo base_url(); ?>assets/images/london3.jpg">
			<img src="<?php echo base_url(); ?>assets/images/london2.jpg">
			<img src="<?php echo base_url(); ?>assets/images/london1.jpg">
		</div>
		</div>
	</div>
</div>

<a href="http://snapbidlocal.heybridgeclients.co.uk?rd=hotel">
    <div class="nearby-bar search-bar" style="margin-top:10px; margin-bottom:10px;">
		<div class="container">
			<div class="row nearby">
				<div class="col-sm-9">
					<h3>Sell your unwanted items, quickly and easily on <strong>SnapBid Local</strong></h3>
				</div>
				<div class="col-sm-3" style="text-align:center;">
					<img style="height:110px" src="<?php echo base_url(); ?>assets/images/boxes.png">
				</div>
			</div>
		</div>
    </div>
</a>

<div style="margin-top:40px;" class="container">
	<h2 style="text-align:center;">Explore</h2>
	<p style="text-align:center;">Find your dream place around the globe</p> 
    <div class="row extras explore">
        <p>&nbsp;</p>

	<?php
		$query = 'SELECT * from snapbid_home_locations WHERE location_featured = 1 ORDER BY locations_ordering ASC ';
		$query = $this->db->query($query);
		foreach ($query->result_array() as $row) { ?>  
			<div class="col-sm-6 col-md-4 col-xs-6 exploreLocations">
				<a href="index.php/location/search/<?php echo $row['location_name']; ?>--<?php echo $row['location_description']; ?>">
					<div class="inner extras">
						<img src="<?php echo $row['location_picture']; ?>">
						<div class="caption">
							<p style="margin-bottom:0px;"><?php echo $row['location_name']; ?></p>
							<p><small style="font-size:12px; opacity:0.9;"><?php echo $row['location_description']; ?></small></p>
						</div>
					</div>
				</a>
			</div>      
		<?php } ?>
          
    </div>
</div>

<a href="<?php echo site_url(); ?>/nearby">
    <div class="nearby-bar search-bar" style="margin-top:10px; margin-bottom:10px;">
		<div class="container">
			<div class="row nearby">
				<div class="col-sm-9">
					<h3>Find Hotels and Apartments nearby to your current location! Click here</h3>
				</div>
				<div class="col-sm-3" style="text-align:center;">
					<img style="height:110px" src="<?php echo base_url(); ?>assets/images/nearby.png">
				</div>
			</div>
		</div>
    </div>
</a>



    

