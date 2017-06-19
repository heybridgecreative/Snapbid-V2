<div class="sidebar">
<h2 class="filters orange">Refine Search</h2>

<div class="filterSidebar panel-group" id="accordion">
           <form action="<?php echo current_full_url(); ?>" method="post">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsefive"> Sort Results</a>
							<span class="glyphicon glyphicon-triangle-bottom"> </span>
                        </h4>
                    </div>
                    <div id="collapsefive" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <input <?php if(isset($sortby) && $sortby === "priceASC") { echo "checked"; } ?> type="radio" value="priceASC" name="sortby" id="priceASC">
                                        <label class="priceASC" for="priceASC"> Room Price Asc<span>ending</span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($sortby) && $sortby === "priceDESC") { echo "checked"; } ?> type="radio" value="priceDESC" name="sortby" id="priceDESC">
                                        <label class="priceDESC" for="priceDESC"> Room Price Desc<span>ending</span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($sortby) && $sortby === "nameASC") { echo "checked"; } ?> type="radio" value="nameASC" name="sortby" id="nameASC">
                                        <label class="nameASC" for="nameASC"> Hotel Name Asc<span>ending</span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($sortby) && $sortby === "nameDESC") { echo "checked"; } ?> type="radio" value="nameDESC" name="sortby" id="nameDESC">
                                        <label class="nameDESC" for="nameDESC"> Hotel Name Desc<span>ending</span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($sortby) && $sortby === "starASC") { echo "checked"; } ?> type="radio" value="starASC" name="sortby" id="starASC">
                                        <label class="starASC" for="starASC"> Star Rating Asc<span>ending</span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($sortby) && $sortby === "starDESC") { echo "checked"; } ?> type="radio" value="starDESC" name="sortby" id="starDESC">
                                        <label class="starDESC" for="starDESC"> Star Rating Desc<span>ending</span></label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
			
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Total Price</a>
							<span class="glyphicon glyphicon-triangle-bottom"> </span>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <input <?php if(isset($price) && in_array($price1, $price)) { echo "checked"; } ?> type="checkbox" name="price[]" id="price1" value="<?php echo $price1; ?>">
                                        <label for="price1"> <?php echo $viewprice1; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($price) && in_array($price2, $price)) { echo "checked"; } ?> type="checkbox" name="price[]" id="price2" value="<?php echo $price2; ?>">
                                        <label for="price2"> <?php echo $viewprice2; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($price) && in_array($price3, $price)) { echo "checked"; } ?> type="checkbox" name="price[]" id="price3" value="<?php echo $price3; ?>">
                                        <label for="price3"> <?php echo $viewprice3; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($price) && in_array($price4, $price)) { echo "checked"; } ?> type="checkbox" name="price[]" id="price4" value="<?php echo $price4; ?>">
                                        <label for="price4"> <?php echo $viewprice4; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
										<input <?php if(isset($price) && in_array($price5, $price)) { echo "checked"; } ?> type="checkbox" name="price[]" id="price5" value="<?php echo $price5; ?>"> 
                                        <label for="price5"> <?php echo $viewprice5; ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
										<input <?php if(isset($price) && in_array($price6, $price)) { echo "checked"; } ?> type="checkbox" name="price[]" id="price6" value="<?php echo $price6; ?>"> 
                                        <label for="price6"> <?php echo $viewprice6; ?></label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Star Rating</a>
							<span class="glyphicon glyphicon-triangle-bottom"> </span> 
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <input <?php if(isset($starrating) && in_array("1", $starrating)) { echo "checked"; } ?> type="checkbox" name="starrating[]" id="star1" value="1">
                                        <label for="star1"> 
											<span class="glyphicon glyphicon-star"></span>
										</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($starrating) && in_array("2", $starrating)) { echo "checked"; } ?> type="checkbox" name="starrating[]" id="star2" value="2">
                                        <label for="star2"> 
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
										</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($starrating) && in_array("3", $starrating)) { echo "checked"; } ?> type="checkbox" name="starrating[]" id="star3" value="3"> 
                                        <label for="star3">
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
										</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($starrating) && in_array("4", $starrating)) { echo "checked"; } ?> type="checkbox" name="starrating[]" id="star4" value="4">
                                        <label for="star4"> 
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
										</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($starrating) && in_array("5", $starrating)) { echo "checked"; } ?> type="checkbox" name="starrating[]" id="star5" value="5">
                                        <label for="star5"> 
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
										</label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> Review Score</a>
							<span class="glyphicon glyphicon-triangle-bottom"> </span>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <input <?php if(isset($reviewscore) && in_array("all", $reviewscore)) { echo "checked"; } ?> class="allRatings" type="checkbox" value="all" name="reviewscore[]" id="no">
                                        <label for="no"> All Ratings</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($reviewscore) && in_array("0", $reviewscore)) { echo "checked"; } ?> type="checkbox" value="0" name="reviewscore[]" id="no">
                                        <label for="no"> No Rating</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($reviewscore) && in_array("1+", $reviewscore)) { echo "checked"; } ?> type="checkbox" value="1+" name="reviewscore[]" id="1">
                                        <label for="1"> Pleasant 1+</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($reviewscore) && in_array("2+", $reviewscore)) { echo "checked"; } ?> type="checkbox" value="2+" name="reviewscore[]" id="2">
                                        <label for="2"> Good 2+</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($reviewscore) && in_array("3+", $reviewscore)) { echo "checked"; } ?> type="checkbox" value="3+" name="reviewscore[]" id="3">
                                        <label for="3"> Very Good 3+</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input <?php if(isset($reviewscore) && in_array("4+", $reviewscore)) { echo "checked"; } ?> type="checkbox" value="4+" name="reviewscore[]" id="4">
                                        <label for="4"> Excellent 4+</label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
			
				<button type="submit" class="purpleBtn filterBtn">Submit Filter</button>
				</form>
            </div>

</div>


