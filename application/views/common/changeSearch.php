<?php
    $datestring = "%Y-%m-%d";
    $time = time();
    $tomorrow = time() + (1 * 24 * 60 * 60);
?>
<div class="searchbar purpleBG">
        <div class="col-xs-12">
            <h3 style="color:#333;">Change Your Search</h3>
        </div>
<div class="container">
	<form id="searchbar" name="search" action="<?php echo site_url('result'); ?>" method="get">
		<div class="row">
			<div class="col-sm-7 col-xs-12">
				<p><small>Location</small></p>
				<input required id="location" name="location" type="text" placeholder="Enter a Destination" autocomplete="new-password" value="<?php echo $location; ?>">
			</div>
			<div class="col-sm-2 col-xs-6">
				<p><small>Check In</small></p>
				<input id="datef" name="datef" type="datetime" value="" data-value="<?php echo $datef; ?>">
			</div>
			<div class="col-sm-2 col-xs-6">
				<p><small>Check Out</small></p>
				<input id="datet" name="datet" type="datetime" value="" data-value="<?php echo $datet; ?>">
			</div>
			<div class="col-sm-1 col-xs-12">
				<p><small></small></p>
				<button id="change" type="button" class="btn-content orangeBtn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class='fa fa-arrow-right'></i></button>
			</div>
		</div>
		<div class="row inactive">
			<div class="col-sm-1 col-xs-12">
				<p><small></small></p>
				<button id="changeBack" type="button" class="btn-content orangeBtn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class='fa fa-arrow-left'></i></button>
			</div>

			<div class="col-sm-3 col-xs-4">
				<p><small>Rooms</small></p>
				<input id="rooms" name="rooms" type="number" value="<?php echo $roomAmount; ?>">
			</div>
			<div class="col-sm-3 col-xs-4">
				<p><small>Adults</small></p>
				<input id="adults" name="adults" type="number" value="<?php echo $adults; ?>">
			</div>
			<div class="col-sm-2 col-xs-4">
				<p><small>Children</small></p>
				<input id="children" name="children" type="number" value="<?php echo $children; ?>">
			</div>
			<div class="col-sm-3 col-xs-12">
				<p><small></small></p>
				<button id="submitSearch" type="submit" class="btn-content orangeBtn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>">Submit</button>
			</div>
		</div>
	<input id="radius" name="radius" type="hidden" value="4">
	</form>
</div>
</div>

<script>
$('#change').on('click', function (e) {
    $('.inactive').toggleClass("display");
});
</script>

<script>
$('#changeBack').on('click', function (e) {
    $('.display').toggleClass("display");
});
</script>



<script>
$(document).on("keypress", '#searchbar', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        console.log('Inside');
        e.preventDefault();
        return false;
    }
});
</script>

<script src="https://cdn.jsdelivr.net/places.js/1/places.min.js"></script>
<script>
(function() {
  var placesAutocomplete = places({
    container: document.querySelector('#location'),
	type: 'city'
  });

  var $address = document.querySelector('#address-value')
  placesAutocomplete.on('change', function(e) {
    $address.textContent = e.suggestion.value 
  });

  placesAutocomplete.on('clear', function() {
    $address.textContent = 'none';
  });

})();
</script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/pickadate/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/pickadate/themes/default.date.css" id="theme_date">
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.date.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/legacy.js"></script>

<script>
jQuery( document ).ready(function($) {
	$('#datet').pickadate({
  		labelMonthNext: 'Go to the next month',
  		labelMonthPrev: 'Go to the previous month',
  		labelMonthSelect: 'Pick a month from the dropdown',
  		labelYearSelect: 'Pick a year from the dropdown',
  		selectMonths: true,
  		selectYears: true,
		firstday: 1,
		format: 'dd mmmm yyyy',
  		formatSubmit: 'yyyy/mm/dd',
	})

	$('#datef').pickadate({
  		labelMonthNext: 'Go to the next month',
  		labelMonthPrev: 'Go to the previous month',
  		labelMonthSelect: 'Pick a month from the dropdown',
  		labelYearSelect: 'Pick a year from the dropdown',
  		selectMonths: true,
  		selectYears: true,
		firstday: 1,
		format: 'dd mmmm yyyy',
  		formatSubmit: 'yyyy/mm/dd',
	})

var from_$input = $('#datef').pickadate(),
    from_picker = from_$input.pickadate('picker')

var to_$input = $('#datet').pickadate(),
    to_picker = to_$input.pickadate('picker')



from_picker.on('set', function(event) {
  if ( event.select ) {
	if ( from_picker.get('value') > to_picker.get('value')) {
    	to_picker.set('disabled', true);
    	to_picker.set('enabled', true);
	} else {
    	to_picker.set('min', from_picker.get('value'))   
	} 
  }
  else if ( 'clear' in event ) {
    to_picker.set('min', false)
  }
})
to_picker.on('set', function(event) {
  if ( event.select ) {
    from_picker.set('max', to_picker.get('value'))
  }
  else if ( 'clear' in event ) {
    from_picker.set('max', false)
  }
})
	

});

</script>