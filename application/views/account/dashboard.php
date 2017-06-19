<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<div class="container">
	<div class="row">
      <div class="col-xs-12 col-sm-10">
        <h1>You are logged in!</h1>
        <?php $user = $this->aauth->get_user(); ?>
		<?php $name = $this->aauth->get_user_var("name"); ?>
		<?php if(isset($name)) { ?>
			<h3>Hello <?php echo $name; ?></h3>
		<?php } ?>
        <p>Your email adress is:<br /><b><span id="email"><?=$user->email?></span> <i class="fa fa-pencil"> </i></b></p> 
        <p>Your username is:<br /><b><span id="username"><?=$user->username?></span> <i class="fa fa-pencil"> </i></b></p> 
      </div>
		
			<div class="col-xs-12 col-sm-2">
				<div class="buttns">
					<div class="col-xs-12" style="margin-top:50px;">
						<a href="<?php echo site_url('/account/logout'); ?>"><p><i class="fa-sign-out fa"></i><br /> Log Out</p></a>
					</div>
				</div>
			</div>
	</div>


	<!--<?php if($name == "") { ?>-->
	<div class="row moreabout purpleBG padding20">
		<div class="col-sm-12">
			<h3>Tell us a bit about yourself?</h3>
			<form method="post" action="" >
			<div class="row">
        		<div class="form-group">
          			<label for="inputName" class="col-sm-12 control-label">Name</label>
          			<div class="col-sm-6">
            			<input type="text" class="form-control" name="firstname" id="inputName" placeholder="First Name" required>
          			</div>
          			<div class="col-sm-6">
            			<input type="text" class="form-control" name="lastname" id="inputName" placeholder="Last Name" required>
          			</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-12">
					<button type="submit" class="pull-right btn btn-labeled btn-success">
                		<span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span> Submit
					</button>
				</div>
			</div>
		</div>
	</div>
	<!--<?php } ?>-->

	<div class="row quicklinks">
		<div class="col-xs-12 buttns">
			<h3>Quick Links:</h3>
			<div class="col-xs-6 col-sm-3" style="margin-bottom:20px;">
				<a href="<?php echo site_url('/account/activity'); ?>"><p><i class="fa-bolt fa"></i><br />
				Activity</p></a>
			</div>
			<div class="col-xs-6 col-sm-3" style="margin-bottom:20px;">
				<a href="<?php echo site_url('/account/trips'); ?>"><p><i class="fa-star fa"></i><br />
				My Trips</p></a>
			</div>
			<div class="col-xs-6 col-sm-3" style="margin-bottom:20px;">
				<a href="#"><p><i class="fa-gavel fa"></i><br />
				Bids<span class="comingsoon"><i class="fa fa-clock-o fa-spin"></i> Coming Soon</span></p></a>
			</div>

			<div class="col-xs-6 col-sm-3" style="margin-bottom:20px;">
				<a href="<?php echo site_url(); ?>"><p><i class="fa-building fa"></i><br />
				Search for Hotels</p></a>
			</div>
        </div>
    </div>
	<div class="row padding10">
		<div class="col-sm-6">
			<h3>Most Recent Searches</h3>
			<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th>Location</th>
					<th>Check In Date</th>
					<th>Check Out Date</th>
				</tr>
				<?php foreach ($searches->result() as $row) { ?>
					<tr>	
						<td><?php echo $row->wordLocation; ?></td>
						<td><?php echo $row->dateF; ?></td>
						<td><?php echo $row->dateT; ?></td>
					</tr>	
				<?php } ?>	
			</table>
			</div>
			<div class="mobile-scroll-tip">
				<i class="fa fa-arrow-left"> </i> <p>Scroll to view more</p> <i class="fa fa-arrow-right"> </i>
			</div>
		</div>
		<div class="col-sm-6">
			<h3>Most Recent Views</h3>
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

<script>

$.fn.editable.defaults.mode = 'inline';
$('#email').editable({
    type: 'text',
    pk: 1,
    url: '<?php echo site_url('/account/dashboard'); ?>',
    title: 'Edit username'
});
$('#username').editable({
    type: 'text',
    pk: 1,
    url: '<?php echo site_url('/account/dashboard'); ?>',
    title: 'Edit email address'
});
</script>