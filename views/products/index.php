<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg); background-color: #d0d0d0;">
		<h2 class="l-text2 t-center">
			Products
		</h2>
		<p class="m-text13 t-center">
			<?=isset($this->data['query']) ? $this->data['query'] : ''?>
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

						<?php
							/**
							 * Show product categories for search
							 */

							$category = new Category();
							$categories = $category->getCategories();

							$count = 0;
							foreach($categories as $row) {
								$count++;
						?>
							<li class="p-t-4">
								<a href="/products/?category=<?=$row['description']?>" class="s-text13 <?=count == 1 ? active1 : ''?>">
									<?=$row['description'] ?>
								</a>
							</li>

						<?php
							 }
						?>
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
									Range: <span id="value-lower">610</span> - <span id="value-upper">980</span>
								</div>
							</div>
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
									<option>0.00 - 50.00</option>
									<option>50.00 - 100.00</option>
									<option>100.00 - 150.00</option>
									<option>150.00 - 200.00</option>
									<option>200.00+</option>

								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
					</div>

                    <?php 
                    
                    if(count ($this->data['data']) > 0 ) { 
						
						$valid_products = [];

						//validate products and images
						foreach($this->data['data'] as $row) {
							$main_photo = explode(",", $row['images']);
							//if valid add to array
                            if( file_exists(realpath('uploads/products/'.$main_photo[0])) && !is_dir(realpath('uploads/products/'.$main_photo[0])) ) {
								$valid_products[] = $row;
							}
						}

						//get number of rows by set of 3
						$rows =  ceil(count ($valid_products) / 3);
						
					
						for ( $x = 0; $x <= $rows; $x++){

							//get products within the set
							$product_1st = isset($valid_products[($x * 3)]) ? $valid_products[($x * 3)] : null;
							$product_2nd = isset($valid_products[($x * 3) + 1]) ? $valid_products[($x * 3) + 1] : null;
							$product_3rd = isset($valid_products[($x * 3) + 2]) ? $valid_products[($x * 3) + 2] : null;

							//explode images of products
							$photo_1st = isset($product_1st) ? explode(",", $product_1st['images']) : null;
							$photo_2nd = isset($product_2nd) ? explode(",", $product_2nd['images']) : null;
							$photo_3rd = isset($product_3rd) ? explode(",", $product_3rd['images']) : null;

							//get main photo of each product within the set
							$photo_1st = isset($photo_1st[0]) ? $photo_1st[0] : null;
							$photo_2nd = isset($photo_2nd[0]) ? $photo_2nd[0] : null;
							$photo_3rd = isset($photo_3rd[0]) ? $photo_3rd[0] : null;
                           
                        ?>
					
					<div class="row">
					
					<?php 
					//display product 1 of $x set
					if ( file_exists(realpath('uploads/products/'.$photo_1st)) && !is_dir(realpath('uploads/products/'.$photo_1st)) ) {
						?>
					<!-- Product -->
							
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="/uploads/products/<?=$photo_1st?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a id="<?=$product_1st['prodid'] ?>" href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" style="color: red;"aria-hidden="true"></i>
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
									<a href="/products/detail/<?=$product_1st['prodid'] ?>" class="block2-name dis-block s-text3 p-b-5">
										<?=$product_1st['name']?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?=$product_1st['price']?>
									</span>
								</div>
							</div>
						</div>

						<?php }
							//display product 2 of $x set
							if ( file_exists(realpath('uploads/products/'.$photo_2nd)) && !is_dir(realpath('uploads/products/'.$photo_2nd)) ){
						
						?>
                 
				 		<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="/uploads/products/<?=$photo_2nd?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a id="<?=$product_2nd['prodid'] ?>" href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
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
									<a href="/products/detail/<?=$product_2nd['prodid'] ?>" class="block2-name dis-block s-text3 p-b-5">
										<?=$product_2nd['name']?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?=$product_2nd['price']?>
									</span>
								</div>
							</div>
						</div>
						<?php }
							//display product 3 of $x set
							if ( file_exists(realpath('uploads/products/'.$photo_3rd)) && !is_dir(realpath('uploads/products/'.$photo_3rd)) ){
						
						?>

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="/uploads/products/<?=$photo_3rd?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a id="<?=$product_3rd['prodid'] ?>" href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
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
									<a href="/products/detail/<?=$product_3rd['prodid'] ?>" class="block2-name dis-block s-text3 p-b-5">
										<?=$product_3rd['name']?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										<?=$product_3rd['price']?>
									</span>
								</div>												
							</div>
						</div>
						<?php 
							}  ?>	
							</div>
						
						
                    <?php } 
                    } else {  ?>
                        <p class="alert alert-warning">No records found!</p>
                    <?php }  ?>

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

		/**
		 * Add to cart button is click
		 */
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){

				var item = {
					prodid: $(this).children().attr('id'),
				}

				addItemtoOrder(item);

				//show sweetalert success message
				swal(nameProduct, "is added to cart !", "success");
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


		/**
		 * Add to wishlist is click
		 */
		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				var item = {
					prodid: $(this).attr('id'),
				}

				addItemtoWishlist(item);
				//show sweetalert success message
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

		/**
		 * Add to wishlist 
		 */
		function addItemtoWishlist(item){
			
			return $.ajax({
				type: 'POST',
				url: '/ajax/wishlists/additem/',
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

	</script>