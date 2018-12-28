<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
		<h2 class="l-text2 t-center">
			Women
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="#" class="s-text13 active1">
									All
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Women
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Men
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Kids
								</a>
							</li>

							<li class="p-t-4">
								<a href="#" class="s-text13">
									Accesories
								</a>
							</li>
						</ul>

						<!--  -->
						<h4 class="m-text14 p-b-32">
							Filters
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Price
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filter
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
								</div>
							</div>
						</div>

						<div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Color
							</div>

							<ul class="flex-w">
								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
									<label class="color-filter color-filter2" for="color-filter2"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
									<label class="color-filter color-filter4" for="color-filter4"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
									<label class="color-filter color-filter6" for="color-filter6"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li>
							</ul>
						</div>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option>
								</select>
							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Price</option>
									<option>$0.00 - $50.00</option>
									<option>$50.00 - $100.00</option>
									<option>$100.00 - $150.00</option>
									<option>$150.00 - $200.00</option>
									<option>$200.00+</option>

								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
					</div>

                    <?php 
                    
                    if(count ($this->data) > 0 ) { 
						
						$valid_products = [];
						//validate products
						foreach($this->data as $row) {
							$main_photo = explode(",", $row['images']);
							
                            if( file_exists(realpath('uploads/products/'.$main_photo[0])) && !is_dir(realpath('uploads/products/'.$main_photo[0])) ) {
								$valid_products[] = $row;
							}
						}


						$rows =  ceil(count ($valid_products) / 3);

						
						for ( $x = 0; $x <= $rows; $x++){
							$product_1st = isset($valid_products[($x * 3)]) ? $valid_products[($x * 3)] : null;
							$product_2nd = isset($valid_products[($x * 3) + 1]) ? $valid_products[($x * 3) + 1] : null;
							$product_3rd = isset($valid_products[($x * 3) + 2]) ? $valid_products[($x * 3) + 2] : null;

							$photo_1st = isset($product_1st) ? explode(",", $product_1st['images']) : null;
							$photo_2nd = isset($product_2nd) ? explode(",", $product_2nd['images']) : null;
							$photo_3rd = isset($product_3rd) ? explode(",", $product_3rd['images']) : null;

							$photo_1st = isset($photo_1st[0]) ? $photo_1st[0] : null;
							$photo_2nd = isset($photo_2nd[0]) ? $photo_2nd[0] : null;
							$photo_3rd = isset($photo_3rd[0]) ? $photo_3rd[0] : null;
                           
                        ?>
					
					<?php if ( file_exists(realpath('uploads/products/'.$photo_1st)) && !is_dir(realpath('uploads/products/'.$photo_1st)) ) {?>
					<!-- Product -->
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="/uploads/products/<?=$photo_1st?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button id="<?=$product_1st['prodid'] ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
										<?=$product_1st['name']?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?=$product_1st['price']?>
									</span>
								</div>
							</div>
						</div>

						<?php }
						
							if ( file_exists(realpath('uploads/products/'.$photo_2nd)) && !is_dir(realpath('uploads/products/'.$photo_2nd)) ){
						
						?>
                 
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="/uploads/products/<?=$photo_2nd?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button id="<?=$product_2nd['prodid'] ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
										<?=$product_2nd['name']?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?=$product_2nd['price']?>
									</span>
								</div>
							</div>
						</div>

						<?php }
						
							if ( file_exists(realpath('uploads/products/'.$photo_3rd)) && !is_dir(realpath('uploads/products/'.$photo_3rd)) ){
						
						?>

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="/uploads/products/<?=$photo_3rd?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button id="<?=$product_3rd['prodid'] ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
										<?=$product_3rd['name']?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?=$product_3rd['price']?>
									</span>
								</div>
							</div>
						</div>


						<?php 
							}
                        } 
                    
                    } else {  ?>
                        <p class="alert alert-warning">No records found!</p>
                    <?php }  ?>
					</div>

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){

				var item = {
					prodid: $(this).children().attr('id'),
				}

				console.log(item);

				addItemtoOrder(item);

				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

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