<?php
    $datestring = "%Y-%m-%d";
    $time = time();
    $tomorrow = time() + (1 * 24 * 60 * 60);
?>
<div class="container">
    <div class="hero-unit">
        <div class="caption">
            <img src="http://www.snapbid.com/logo-text.png" alt="SnapBid">
            <form id="search" name="search" action="index.php/result" method="get">
                <div class="row">
                    <div class="col-xs-9">
                        <p><small>Location</small></p>
                        <input required id="location" name="location" type="text" placeholder="Enter a Destination">
                    </div>
                    <div class="col-xs-3">
                        <p><small>Radius</small></p>
                        <input id="radius" name="radius" type="number" value="2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <p><small>Date From</small></p>
                        <input id="datef" name="datef" type="datetime" value="<?php echo mdate($datestring, $time); ?>">
                    </div>
                    <div class="col-xs-6">
                        <p><small>Date To</small></p>
                        <input id="datet" name="datet" type="datetime" value="<?php echo mdate($datestring, $tomorrow); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <p><small>Rooms</small></p>
                        <input id="rooms" name="rooms" type="number" value="1">
                    </div>
                    <div class="col-xs-4">
                        <p><small>Adults</small></p>
                        <input id="adults" name="adults" type="number" value="2">
                    </div>
                    <div class="col-xs-4">
                        <p><small>Children</small></p>
                        <input id="children" name="children" type="number" value="0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="btn">
                           <button id="submitSearch" type="submit" class="btn-content" data-loading-text="<i class='fa fa-spinner fa-spin'></i>">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('.btn-content').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 300000);
});
</script>
<script>
$(document).ready(function(){
    $('#submitSearch').attr('disabled',true);
    $('#location').keyup(function(){
        if($(this).val().length !=0)
            $('#submitSearch').attr('disabled', false);            
        else
            $('#submitSearch').attr('disabled',true);
    })
});
</script>