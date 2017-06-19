
<div class="searchbar purpleBG col-xs-12">
	<form id="searchbar" name="search" method="get">
		<div class="row">
			<div class="col-xs-6 col-sm-5">
				<p><small>Check In</small></p>
				<input id="datef" name="datef" type="datetime" value="">
			</div>
			<div class="col-xs-6 col-sm-5">
				<p><small>Check Out</small></p>
				<input id="datet" name="datet" type="datetime" value="">
			</div>
			<div class="col-sm-2 col-xs-12">
				<p><small></small></p>
				<button id="change" type="button" class="btn-content orangeBtn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class='fa fa-arrow-right'></i></button>
			</div>
		</div>
		<div class="row inactive">
			<div class="col-sm-2 col-xs-12">
				<p><small></small></p>
				<button id="changeBack" type="button" class="btn-content orangeBtn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class='fa fa-arrow-left'></i></button>
			</div>
			<div class="col-sm-2 col-xs-3">
				<p><small>Rooms</small></p>
				<input id="rooms" name="roomAmounts" type="number" value="1">
			</div>
			<div class="col-sm-2 col-xs-3">
				<p><small>Adults</small></p>
				<input id="adults" name="adults" type="number" value="2">
			</div>
			<div class="col-sm-2 col-xs-3">
				<p><small>Children</small></p>
				<input id="children" name="children" type="number" value="0">
			</div>
			<div class="col-sm-4 col-xs-12">
				<p><small></small></p>
				<button id="submitSearch" name="roomSubmit" type="submit" class="btn-content orangeBtn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>">Submit</button>
			</div>
		</div>
	</form>
</div>

<script>
$('#change').on('click', function (e) {
    $('.inactive').toggleClass("display");
});

$('#changeBack').on('click', function (e) {
    $('.display').toggleClass("display");
});

$(document).on("keypress", '#searchbar', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        console.log('Inside');
        e.preventDefault();
        return false;
    }
});
</script>

<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/knockout-3.2.0.js"></script>
<script src="<?php echo base_url(); ?>assets/js/material-datepicker/js/material.datepicker.js"></script>
<script>
jQuery( document ).ready(function($) {
	$('#datet').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: new Date()  }).on('dateSelected', function(e, date) {
		$('#datef').bootstrapMaterialDatePicker('setMaxDate', date);		
		$('#datet').attr("value", date);
	});
	$('#datef').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: new Date() }).on('dateSelected', function(e, date) {
		$('#datet').bootstrapMaterialDatePicker('setMinDate', date);	
		$('#datef').val(date);
	});
});
</script>