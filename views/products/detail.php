<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
					<?php
						$images = explode(",", $this->data['images']);
						
						foreach($images as $res){
							if( file_exists(realpath('uploads/products/'.$res)) && !is_dir(realpath('uploads/products/'.$res)) ) {
					?>
							
						<div class="item-slick3" data-thumb="/uploads/products/<?=$res?>">
							<div class="wrap-pic-w">
								<img src="/uploads/products/<?=$res?>" alt="IMG-PRODUCT">
							</div>
						</div>
					<?php
								}
							}
					?>
						
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?=$this->data['name']?>
				</h4>

				<span class="m-text17">
					<?=Util::number_format($this->data['price'])?>
				</span>

				<p class="s-text8 p-t-10 pb-2">
					By: <?=$this->data['company']?> 					
				</p>
				<a href="#" id="msg" class="btn btn-outline-dark"><i class="fa fa-comment-o fa-lg"></i> Inquire</a>

				<!--  -->
				<div class="p-t-33 p-b-60">
					
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: <?=$this->data['sku']?></span>
					<span class="s-text8">Category: <?=$this->data['categories']?></span>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
						<?=$this->data['company']?>
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Additional information
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Reviews 					
						<?php
							$rating = new Rate();
							$ratings = $rating->getRatingsByProductId($this->data['prodid']);
							
							if( $ratings ) {
								echo '('.Util::number_format($ratings['ratings']).')';
								$ratings = (int)$ratings['ratings'];
						?>

						<fieldset class="rate">
							<input type="radio" id="star5" name="rate" value="5" <?php if( $ratings == 5 ) echo 'checked'; ?>/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input type="radio" id="star4half" name="rate" value="4 and a half" <?php if( $ratings < 5 && $ratings >= 4.5 ) echo 'checked'; ?>/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input type="radio" id="star4" name="rate" value="4" <?php if( $ratings == 4 ) echo 'checked'; ?>/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="star3half" name="rate" value="3 and a half" <?php if( $ratings < 4 && $ratings >= 3.5 ) echo 'checked'; ?>/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input type="radio" id="star3" name="rate" value="3" <?php if( $ratings == 3 ) echo 'checked'; ?>/><label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input type="radio" id="star2half" name="rate" value="2 and a half" <?php if( $ratings < 3 && $ratings >= 2.5 ) echo 'checked'; ?>/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input type="radio" id="star2" name="rate" value="2" <?php if( $ratings == 2 ) echo 'checked'; ?>/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="star1half" name="rate" value="1 and a half" <?php if( $ratings < 2 && $ratings >= 1.5 ) echo 'checked'; ?>/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input type="radio" id="star1" name="rate" value="1" <?php if( $ratings == 1 ) echo 'checked'; ?>/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input type="radio" id="starhalf" name="rate" value="half" <?php if( $ratings < 1 && $ratings >= 0.5 ) echo 'checked'; ?>/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
						</fieldset>
						<?php
							}
						?>
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>
					
					<div class="dropdown-content dis-none  p-t-15 p-b-23">
						<?php
							$ratings = $rating->getRatings($this->data['prodid']);

							foreach( $ratings as $row ) {
						?>
							<p class="s-text8">
							<?=$row['message']?>
							</p>
						<?php
							}
							$count = $rating->getRatingsByCustomerByProduct($this->data['prodid']);
							if ((int)$count['count'] < 0 && Session::get('userid') != "") {

								
						?>
						<div style="padding: 20px; background-color: #f8f8f8; border-radius: 10px;">
							<form method="POST" action="/ratings/rate/<?=$this->data['prodid']?>/">
								<input type="hidden" name="prodid" value="<?=$this->data['prodid']?>"/>
								<div class="form-group">
									<label for="rating">Rate</label>
									<select name="rating" class="form-control">
										<option value="5">5 - Awesome</option>
										<option value="4">4 - Pretty good</option>
										<option value="3">3 - Good</option>
										<option value="2">2 - Kinda bad</option>
										<option value="1">1 - Bad</option>
									</select>
								</div>
								<div class="form-group">
									<label for="message">Remarks</label>
									<textarea name="message" rows="5" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<button class="btn btn-success">Rate Now</button>
								</div>
							</form>
						</div>

						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="images/item-02.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Herschel supply co 25l
								</a>

								<span class="block2-price m-text6 p-r-5">
									$75.00
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="images/item-03.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Denim jacket blue
								</a>

								<span class="block2-price m-text6 p-r-5">
									$92.50
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="images/item-05.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Coach slim easton black
								</a>

								<span class="block2-price m-text6 p-r-5">
									$165.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="images/item-07.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Frayed denim shorts
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									$29.50
								</span>

								<span class="block2-newprice m-text8 p-r-5">
									$15.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="images/item-02.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Herschel supply co 25l
								</a>

								<span class="block2-price m-text6 p-r-5">
									$75.00
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="images/item-03.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Denim jacket blue
								</a>

								<span class="block2-price m-text6 p-r-5">
									$92.50
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="images/item-05.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Coach slim easton black
								</a>

								<span class="block2-price m-text6 p-r-5">
									$165.90
								</span>
							</div>
						</div>
					</div>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
								<img src="images/item-07.jpg" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
									Frayed denim shorts
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									$29.50
								</span>

								<span class="block2-newprice m-text8 p-r-5">
									$15.90
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- Option Modal -->
	<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form id="option" action="" method="POST" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Inquire <?=$this->data['company']?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" id="receiver" name="receiver" value="<?=$this->data['custid']?>">
							<textarea id="message" name="message" class="form-control" style="height: 100px;" placeholder="Your message here..."></textarea>
						</div>      
						<div class="form-group text-right">		
							<button class="btn btn-primary" id="send"><i class="fa fa-send"></i> Send</button>
						</div>     
					</div>
				</div>
			</form>
		</div>
	</div>

	<script>
	
		/**
		 * Add product to cart button is click
		 */

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				var $userid = "<?=Session::get('userid')?>";
				if( $userid != ""){
					var item = {
						prodid: "<?=$this->data['prodid']?>",
						qty: $('.num-product').val()
					}

					addItemtoOrder(item);

					//show sweetalert success message
					swal(nameProduct, "is added to cart !", "success");
				} else {
					swal("You need to sign-in inorder to purchase?", {
						buttons: {
							cancel: "Cancel",
							signup: "Sign-up",
							signin: "Sign-in",
						},
						})
						.then((value) => {
						switch (value) {
						
							case "signin":
							window.location = '/login/';
							break;

							case "signup":
							window.location = '/signup/';
							break;

							default:
							
						}
					});
				}
			});
		});


		/**
		 * Add product to cart
		 */
		function addItemtoOrder(item){
			
			return $.ajax({
				type: 'POST',
				url: '/ajax/orders/additem/',
				data: item,
				dataType: 'json',
				crossDomain: true,
				headers: {'X-Requested-With': 'XMLHttpRequest'},
				success: function(response){
					switch(response.message){
						case 'success': 
							break
						case 'error':
							//show sweetalert error message
							swal({
								title: "Error",
								text: "An error occured while saving your changes",
								type: "error",
								confirmButtonText: '',
								showCancelButton: true,
								showConfirmButton: false,
							});
							break
					}
				}
			});
		}

		$('#msg').on('click', function (e) {		
			$('#msgModal').modal("toggle");
		});


		$('#send').on('click', function (e) {
			e.preventDefault();

			var message = {
				receiver: $("#receiver").val(),
				message: $("#message").val(),
			}

			sendMessage(message).done(function($data){
				$data = JSON.parse($data);

				if ($data.result){
					$('#msgModal').modal("toggle");
					
					swal({
                        title: "Success",
                        text: "Your message has been successfully sent!",
                        type: "success",
                        confirmButtonText: '',
                        showCancelButton: true,
                        showConfirmButton: false,
                    });
				}
			});
		});


			/**
		 * Add product to cart
		 */
		function sendMessage(message){
			
			return $.ajax({
				type: 'POST',
				url: '/ajax/messages/send/',
				data: message,
				dataType: 'json',
				crossDomain: true,
				headers: {'X-Requested-With': 'XMLHttpRequest'},
				success: function(response){
					switch(response.message){
						case 'success': 
							break
						case 'error':
							//show sweetalert error message
							swal({
								title: "Error",
								text: "An error occured while saving your changes",
								type: "error",
								confirmButtonText: '',
								showCancelButton: true,
								showConfirmButton: false,
							});
							break
					}
				}
			});
		}
	</script>

	<style>
		fieldset, label { margin: 0; padding: 0; }
		body{ margin: 20px; }
		h1 { font-size: 1.5em; margin: 10px; }
	
		/** rate **/
		
		.rate { 
		border: none;
		float: left;
		}

		.rate > input { display: none; } 
		.rate > label:before { 
		margin: 5px;
		font-size: 1.25em;
		font-family: FontAwesome;
		display: inline-block;
		content: "\f005";
		}

		.rate > .half:before { 
		content: "\f089";
		position: absolute;
		}

		.rate > label { 
		color: #ddd; 
		float: right; 
		}

		.rate > input:checked ~ label { color: #FFD700; }

	</style>