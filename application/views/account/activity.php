<div class="container">
<div class="row quicklinks">
		<div class="col-xs-12 buttns">
			<h3>Quick Links:</h3>
			<div class="col-xs-2">
				<a href="<?php echo site_url('/account/dashboard'); ?>"><p><i class="fa-dashboard fa"></i><br />
				Dashboard</p></a>
			</div>
			<div class="col-xs-2 active">
				<a href="<?php echo site_url('/account/activity'); ?>"><p><i class="fa-bolt fa"></i><br />
				Activity</p></a>
			</div>
			<div class="col-xs-2">
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
<h1>Your Activity</h1>
<p>Find your recent searches and hotel views. Re-live your recent search and find the great hotel you've already stayed in.</p>
<p>&nbsp;</p>

	<h3>Recent Searches</h3>
		<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th style="width:35%;">Location</th>
				<th>Radius (km)</th>
				<th>Search Dates</th>
				<th>Adults</th>
				<th>Children</th>
				<th>Rooms</th>
				<th>Date Searched</th>
			</tr>
		<?php foreach ($searches->result() as $row) { ?>
			<tr>
				<td><?php echo $row->wordLocation; ?></td>
				<td><?php echo $row->radius; ?></td>
				<td>
					<?php if($row->dateF != "Dateless Search") { ?><?php echo date("jS M Y", strtotime($row->dateF)); ?> <?php } else { echo "Dateless Explore Search"; } ?>
					<?php if($row->dateF != "Dateless Search") { ?> - <?php echo date("d-m-Y", strtotime($row->dateT)); ?> <?php } ?>
				</td>
				<td><?php echo $row->adults; ?></td>
				<td><?php echo $row->children; ?></td>
				<td><?php echo $row->roomAmount; ?></td>
				<td><?php echo date("jS M Y - H:i", strtotime($row->dateSearched)); ?></td>
			</tr>
		<?php } ?>
		</table>
	</div>
			<div class="mobile-scroll-tip">
				<i class="fa fa-arrow-left"> </i> <p>Scroll to view more</p> <i class="fa fa-arrow-right"> </i>
			</div>
	</div>
</div>
	<div class="row">

	<div class="col-xs-12">
	<h3>Recent Hotel Views</h3>
		<div class="table-responsive">
		<table class="table table-striped">
				<tr>
					<th>Hotel Name</th>
					<th>Hotel Location</th>
					<th>Link to Hotel</th>
				</tr>
				<?php foreach ($views->result() as $row) { ?>
					<tr>	
						<td><?php echo $row->hotelName; ?></td>
						<td><?php echo $row->hotelLocation; ?></td>
						<td><a href="<?php echo site_url('hotel'); ?>/<?php echo $row->hotelID; ?>">Link</a></td>
					</tr>	
				<?php } ?>		
			</table>
		</div>
		
			<div class="mobile-scroll-tip">
				<i class="fa fa-arrow-left"> </i> <p>Scroll to view more</p> <i class="fa fa-arrow-right"> </i>
			</div>

		</div>
	</div>
</div>