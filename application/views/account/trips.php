<div class="container">
<div class="row quicklinks">
		<div class="col-xs-12 buttns">
			<h3>Quick Links:</h3>
			<div class="col-xs-2">
				<a href="<?php echo site_url('/account/dashboard'); ?>"><p><i class="fa-dashboard fa"></i><br />
				Dashboard</p></a>
			</div>
			<div class="col-xs-2">
				<a href="<?php echo site_url('/account/activity'); ?>"><p><i class="fa-bolt fa"></i><br />
				Activity</p></a>
			</div>
			<div class="col-xs-2 active">
				<a href="<?php echo site_url('/account/trips'); ?>"><p><i class="fa-globe fa"></i><br />
				My Trips</p></a>
			</div>
			<div class="col-xs-2">
				<a href="#"><p><i class="fa-gavel fa"></i><br />
				Bids<span class="comingsoon"><i class="fa fa-clock-o fa-spin"></i> Coming Soon</span></p></a>
			</div>
			<div class="col-xs-2">
				<a href="<?php echo site_url('/account/logout'); ?>"><p><i class="fa-sign-out fa"></i><br />
				Log Out</p></a>
			</div>

			<div class="col-xs-2">
				<a href="<?php echo site_url(); ?>"><p><i class="fa-building fa"></i><br />
				Search for Hotels</p></a>
			</div>
        </div>
    </div>
<div class="row">

		<div class="col-xs-12">
<h1>Your Trips</h1>
<p>The page holds the Hotels that you have asked to be held with Your Trips</p>
	<div class="row">
		<?php foreach ($tripList as $key => $trip) { ?>
			<?php $tripDetails = json_decode($this->aauth->get_user_var($trip), true); ?>
			<?php if(!$tripDetails['featuredImage']) {
				continue;
			} else { ?>
				<div class="col-sm-4">
					<div class="tripDetails">
						<p><img src="//images.trvl-media.com<?php echo $tripDetails['featuredImage']; ?>" alt="Featured Image"></p>
						<div class="content">
							<h3><?php echo $tripDetails['hotelName']; ?></h3>
							<a href="http://snapbidv2.azurewebsites.net/index.php/<?php echo "hotel/"; echo $tripDetails['hotelID']; ?>">Hotel Link</a>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
	</div>
</div>
</div>

