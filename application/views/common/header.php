    <?php $this->load->view('common/menu'); ?>
    
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/images/logo-text.png" height="60px"></a>
        </div>
    
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url(""); ?>">Home</a></li>
            <li><a href="<?php echo site_url("/about"); ?>">About</a></li>
            <li><a href="<?php echo site_url('customerservice/help'); ?>">How SnapBid works</a></li>
            <li><a href="http://snapbidlocal.heybridgeclients.co.uk/">Snapbid Local</a></li>
            <li>
              <a class="btn btn-default btn-outline accountBtn"  data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="account">Account</a>
            </li>
          </ul>
          <div class="collapse nav navbar-nav nav-collapse" id="account" style="padding-top:16px;">
			  <?php if(!$this->aauth->is_loggedin()) { ?>

					<form action="<?php echo site_url('/account/login'); ?>" method="post" class="navbar-form navbar-right form-inline" role="form">
					  <div class="form-group">
						<label class="sr-only" for="Email">Email</label>
						<input type="email" name="email" class="form-control" id="Email" placeholder="Email" autofocus required />
					  </div>
					  <div class="form-group">
						<label class="sr-only" for="Password">Password</label>
						<input type="password" name="password" class="form-control" id="Password" placeholder="Password" required />
					  </div>
						<input type="hidden" name="return" value="<?php echo current_url(); ?>" />
					  <button style="float:none;" type="submit" class="orangeBtn">Sign in</button>
						<a style="margin-left:6px; float:right;" href="<?php echo site_url('/account/register'); ?>"><p class="purpleBtn">Register</p></a>
					</form>
			  
			  <?php } else { ?>
			  		<a style="margin-left:6px; float:right;" href="<?php echo site_url('/account/trips'); ?>"><p class="greyBtn">View Trips</p></a>
			  		<a style="margin-left:6px; float:right;" href="<?php echo site_url('/account/dashboard'); ?>"><p class="purpleBtn">Dashboard</p></a>
			  		<a style="margin-left:16px; float:right;" href="<?php echo site_url('/account/logout'); ?>"><p class="orangeBtn">Log Out</p></a>
			  		<h5 style="text-align:right; float:right;">
						Welcome <strong>
							<?php $name = $this->aauth->get_user_var("name"); $user = $this->aauth->get_user(); if($name == "") { 
								echo $user->username; 
							} else { 
								echo $name;
							} ?>
						</strong>
			  		</h5>
			  		
			  <?php } ?>
          </div>
        </div>
      </div>
    </nav>