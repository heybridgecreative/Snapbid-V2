        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Snapbid Admin v1.3</a>
            </div>
            <!-- /.navbar-header -->

			
            
            <div class="navbar-default sidebar" role="navigation">
                <div  class="sidebar-nav navbar-collapse">
				
					
                    <ul data-step="1" data-intro="This is a tooltip!"  class="nav" id="side-menu">
                        <li class="user-section">
							
							<h4 style="margin-top:0px;"><?php echo $_SESSION['adfirstname']; ?> <?php echo $_SESSION['adsurname']; ?></h4>
							<p><?php echo $_SESSION['adusername']; ?></p>
							<small><?php echo $_SESSION['ademail']; ?></small>
						</li>
					   <li class="linkToSite">
                            <a target="_blank" href="../../"><i class="fa fa-sign-out fa-fw"></i> Snapbid Website</a>
                        </li>
                        <li class="dashboard">
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li class="hotels">
                            <a href="#"><i class="fa fa-building fa-fw"></i> Hotels</a>
							<ul class="nav nav-second-level">
								<li><a href="hotels.php"><i class="fa fa-list fa-fw"></i> Manager</a></li>
								<li class="addhotels"><a href="addhotels.php"><i class="fa fa-plus-circle fa-fw"></i> Add Hotel</a></li>
							</ul>
                        </li>
						<li class="rooms">
                            <a href="#"><i class="fa fa-bed fa-fw"></i> Rooms</a>
							<ul class="nav nav-second-level">
								<li><a href="rooms.php"><i class="fa fa-list fa-fw"></i> Manager</a></li>
								<li class="availability"><a href="availability.php"><i class="fa fa-calendar fa-fw"></i> Availability Manager</a></li>
								<li class="roomPrice"><a href="priceRoom.php"><i class="fa fa-money fa-fw"></i> Room Price Manager</a></li>
								<li class="addrooms"><a href="addrooms.php"><i class="fa fa-plus-circle fa-fw"></i> Add Rooms</a></li>
							</ul>
                        </li>
						<li class="specials">
                            <a href="#"><i class="fa fa-gift fa-fw"></i> Special Offers</a>
							<ul class="nav nav-second-level">
								<li><a href="specials.php"><i class="fa fa-list fa-fw"></i> Manager</a></li>
								<li class="addspecial"><a href="addspecials.php"><i class="fa fa-plus-circle fa-fw"></i> Add Special Offers</a></li>
							</ul>
                        </li>
						<li class="bookings">
                            <a href="#"><i class="fa fa-key fa-fw"></i> Bookings</a>
							<ul class="nav nav-second-level">
								<li><a href="bookings.php"><i class="fa fa-list fa-fw"></i> Manager</a></li>
							</ul>
                        </li>

						<?php if($_SESSION['adusertype'] == 1) : ?>
						<li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Special Events</a>
							<ul class="nav nav-second-level">
								<li><a href="specialevents.php"><i class="fa fa-list fa-fw"></i> Manager</a></li>
								<li><a href="addspecialevent.php"><i class="fa fa-plus-circle fa-fw"></i> Add Special Event</a></li>
							</ul>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-globe fa-fw"></i> Home Page Locations</a>
							<ul class="nav nav-second-level">
								<li><a href="locations.php"><i class="fa fa-list fa-fw"></i> Manager</a></li>
								<li><a href="addlocation.php"><i class="fa fa-plus-circle fa-fw"></i> Add Location</a></li>
							</ul>
                        </li>
						<li>
                            <a href="user.php"><i class="fa fa-user fa-fw"></i> User Manager</a>
                        </li>
						<?php endif; ?>

						
						<li class="logout">
                            <a href="../logout.php?logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>


						<li style="margin-top:60px;border-top:1px solid #D83026;border-bottom:1px solid #D83026;" id="startButton">
                            <a href="#"><i class="fa fa-magic fa-fw"></i> Begin Tutorial</a>
                        </li>
                </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>