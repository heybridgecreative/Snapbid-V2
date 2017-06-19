<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Increase your room sales with SnapBid.com</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<h3>Tell us about your property</h3>
			<form action="add-request.php" method="post" class="addProperty">
				<div class="input-group">
					<p>Please select a property type for your property</p>
					<label for="propertyType">
					<select name="propertyType" id="propertyType" class="form-control">
					<option value="0">Please select</option>
					<option value="Apartment">Apartment</option>
					<option value="BedAndBreakfast">Bed and Breakfast</option>
					<option value="Hotel">Hotel</option>
					<option value="EconomyHotel">Economy hotel</option>
					</select>
					</label>
				</div>


			<div class="Apartment">
				<p>What's the address of your Apartment?</p>
				<input name="propertylocation">
				<p>How many bedrooms do you have in your Apartment?</p>
				<input name="guests">
				<p>Your first name:</p>
				<input name="fname">
				<p>Your last name:</p>
				<input name="lname">
				<p>Your contact email address:</p>
				<input name="email">
			</div>

			<div class="BedAndBreakfast">
				<p>What's the name of your Bed And Breakfast you wish to add?</p>
				<input name="propertyname">
				<p>What's the location of your B&B?</p>
				<input name="propertylocation">
				<p>How many rooms do you have in your B&B?</p>
				<input name="guests">
				<p>Your first name:</p>
				<input name="fname">
				<p>Your last name:</p>
				<input name="lname">
				<p>Your contact email address:</p>
				<input name="email">
			</div>

			<div class="Hotel">
				<p>What's the name of your Hotel you wish to add?</p>
				<input name="propertyname">
				<p>What's the location of your Hotel?</p>
				<input name="propertylocation">
				<p>How many rooms do you have in your Hotel?</p>
				<input name="guests">
				<p>Your first name:</p>
				<input name="fname">
				<p>Your last name:</p>
				<input name="lname">
				<p>Your contact email address:</p>
				<input name="email">
			</div>

			<div class="EconomyHotel">
				<p>What's the name of your Economy Hotel you wish to add?</p>
				<input name="propertyname">
				<p>What's the location of your Economy Hotel?</p>
				<input name="propertylocation">
				<p>How many rooms do you have in your Hotel?</p>
				<input name="guests">
				<p>Your first name:</p>
				<input name="fname">
				<p>Your last name:</p>
				<input name="lname">
				<p>Your contact email address:</p>
				<input name="email">
			</div>

			<div class="input-group">
			<p> </p>
				<button type="submit" href="extranet" style="width:100%;" class="orangeBtn">Get Started</button>

			<!--<input class="bid-btn" type="submit" value="Get Started">-->
			<p><small>By continuing, you agree to let SnapBid.com email you regarding your property registration.</small></p>

			</div>

			</form>

		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Why use SnapBid.com</h3>
			<ul class="propertyadd">
				<li>Snapbid® is a new innovative booking site.<br /><span>Creating an instant link between customer and hotelier</span></li>
				<li>Sell your empty rooms and increase your occupancy rates.<br /><span>Forget about the days where you've got empty rooms, let SnapBid help you fill them</span></li>
				<li>Create a friendly experience for your customers.<br /><span>With the fun aspect and the SnapBid process, customers will be coming back again and again.</span></li>
			</ul>
		</div>
	</div>
</div>

<script>
    (function($) {
		$(window).load(function(){
		$("select").change(function () {
			$("select option:selected").each(function () {
				var apartment = $(".Apartment"),
					bedandbreakfast = $(".BedAndBreakfast"),
					hotel = $(".Hotel"),
					economyhotel = $(".EconomyHotel");

				if ($(this).val() == "Apartment") {
					apartment.fadeIn();
					bedandbreakfast.fadeOut();
					hotel.fadeOut();
					economyhotel.fadeOut();

				} else if ($(this).val() == "BedAndBreakfast") {
					apartment.fadeOut();
					bedandbreakfast.fadeIn();
					hotel.fadeOut();
					economyhotel.fadeOut();

				} else if ($(this).val() == "Hotel") {
					apartment.fadeOut();
					bedandbreakfast.fadeOut();
					hotel.fadeIn();
					economyhotel.fadeOut();

				} else if ($(this).val() == "EconomyHotel") {
					apartment.fadeOut();
					bedandbreakfast.fadeOut();
					hotel.fadeOut();
					economyhotel.fadeIn();
				} else if ($(this).val() == "0") {
					apartment.fadeOut();
					bedandbreakfast.fadeOut();
					hotel.fadeOut();
					economyhotel.fadeOut();
				} 
			});
		});
		});
    })(jQuery);

</script>