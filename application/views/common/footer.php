<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <h3>SnapBid</h3>
                <div class="col-xs-6 col-sm-4">
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="<?php echo site_url('customerservice/help'); ?>">How SnapBid works?</a></li>
                    <li><a href="<?php echo site_url('customerservice/joining'); ?>">Joining SnapBid</a></li>
                    <li><a href="<?php echo site_url('customerservice/faqs'); ?>">FAQs</a></li>
                    <li><a href="<?php echo site_url('customerservice/terms'); ?>">Terms &amp; Conditions</a></li>
                    <li><a href="<?php echo site_url('customerservice/privacy'); ?>">Privacy</a></li>
                    <li><a href="<?php echo site_url('customerservice/recruit'); ?>">Recruitment</a></li>
                </ul>
                </div>
                <div class="col-xs-6 col-sm-6">
                <ul>
                    <li><a href="admin">Hotel Login</a></li>
                    <li><a href="user.php">Customer Login</a></li>
                    <li>&nbsp;</li>
                    <li>Apply to add a property to SnapBid</li>
                    <li><a href="add.php">Click Here</a></li>
                </ul>
                </div>
                <div class="col-xs-12 col-sm-2">
                <!--Blank-->
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-xs-12">

                <div class="col-xs-12 col-sm-3">
                    <!--Blank-->
                </div>
                <div class="col-xs-8">
                    <h3>SnapBid on the go!</h3>
                </div>


                <div class="col-xs-3">
                    <!--Blank-->
                </div>

                <div class="col-xs-5">
                    <ul class="tick">
                        <li>bid on the go</li>
                        <li>anytime, anywhere</li>
                        <li>book last minute</li>
                        <li>manage your bookings</li>
                    </ul>
                </div>

                <div class="col-xs-4">
                    <img style="width:100%; height:auto;" src="<?php echo base_url(); ?>assets/images/app-preview.png">
                </div>



            </div>
        </div>
    </div>
</div>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <p>© snapbid</p>
            </div>
            <div class="col-xs-6 text-right social">
                <i class="fa fa-facebook"> </i> <i class="fa fa-twitter"> </i> <i class="fa fa-google-plus"> </i>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-select.js">

<script>
$('.exploreLocations').on('click', function(){
    $(this).addClass('loading');
});
</script>

<script>
$(function(){
    $('.fadein img:gt(0)').hide();
    setInterval(function(){
      $('.fadein :first-child').fadeOut()
         .next('img').fadeIn()
         .end().appendTo('.fadein');}, 
      3000);
});
</script>

<script>
    $(".btn-content").click(function() {
        var $btn = $(this);
        $btn.button('loading');
        // Then whatever you actually want to do i.e. submit form
        // After that has finished, reset the button state using
        setTimeout(function () {
            $btn.button('reset');
        }, 4000);
    });
</script>