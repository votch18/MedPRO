<?php

$access = Session::get('access');

?>

<!DOCTYPE html>
<html>
<head>
   
    <title><?=ucwords(strtolower(Setting::get("site_name"))) ?></title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/fonts/themify/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/fonts/elegant-font/html-css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/daterangepicker/daterangepicker.css">	
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/lightbox2/css/lightbox.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/vendor/noui/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/css/util.css">
	<link rel="stylesheet" type="text/css" href="/assets/default/css/main.css">

	<script type="text/javascript" src="/assets/default/vendor/jquery/jquery-3.2.1.min.js"></script>	
	<script type="text/javascript" src="/assets/default/vendor/sweetalert/sweetalert.min.js"></script>

	<style>
	/*Custom Scroll bar */
	/* width */
	::-webkit-scrollbar {
	width: 5px;
	}

	/* Track */
	::-webkit-scrollbar-track {
	background: #f1f1f1; 
	}
	
	/* Handle */
	::-webkit-scrollbar-thumb {
	background: #888; 
	}

	/* Handle on hover */
	::-webkit-scrollbar-thumb {
	border-radius: 2px;
	}
	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
	background: #555;   
	}
	</style>

</head>
<body class="animsition">

<!-- Header -->
<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<span class="topbar-child1">
					Free shipping for standard order over $100
				</span>

				<div class="topbar-child2">
					<span class="topbar-email">
						fashe@example.com
					</span>

					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option>USD</option>
							<option>EUR</option>
						</select>
					</div>
				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<h1 style="font-weight: bold;">MedPro</h1>
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="/">Home</a>								
							</li>

							<li>
								<a href="/products/">Shop</a>
							</li>

							<li class="sale-noti">
								<a href="/products/sale/">Sale</a>
							</li>

							<li>
								<a href="/orders/">Features</a>
							</li>

							<li>
								<a href="blog.html">Blog</a>
							</li>

							<li>
								<a href="/home/about/">About</a>
							</li>

							<li>
								<a href="/home/contact/">Contact</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<div class="header-wrapicon1 dis-block">
						<?php if ( !isset($access) ) { ?>
							<a href="/login/">Sign-in</a>
						<?php }else { ?>
							<img src="/assets/default/images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<div class="header-cart header-dropdown">
								<ul class="header-cart-wrapitem">
									<li class="header-cart-item">
										<div class="header-cart-item-txt">
											<a href="#" class="header-cart-item-name">
												Profile
											</a>
										</div>
										<div class="header-cart-item-txt">
											<a href="/users/logout" class="header-cart-item-name">
												Sign-out
											</a>
										</div>
									</li>
								</ul>
							</div>
						<?php } ?>
					</div>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<?php if ( !isset($access) ) { ?>
							<a href="/signup/">Sign-up</a>
						<?php }else { ?>
							<img src="/assets/default/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<span class="header-icons-noti">0</span>
						<?php } ?>
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem" id="cart-desktop">
								
								<!--
									Orders Ajax
								-->

							</ul>

							<div class="header-cart-total" id="cart-total-desktop">
								
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/orders/" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/orders/checkout/" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<h1 style="font-weight: bold;">MedPro</h1>
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="/assets/default/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="/assets/default/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem" id="cart-mobile">
								
								<!--
									Orders Ajax
								-->

							</ul>

							<div class="header-cart-total"  id="cart-total-mobile">
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>

							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>USD</option>
									<option>EUR</option>
								</select>
							</div>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="/">Home</a>
					</li>

					<li class="item-menu-mobile">
						<a href="/products/">Shop</a>
					</li>

					<li class="item-menu-mobile">
						<a href="/products/sale/">Sale</a>
					</li>

					<li class="item-menu-mobile">
						<a href="/orders/">Features</a>
					</li>

					<li class="item-menu-mobile">
						<a href="blog.html">Blog</a>
					</li>

					<li class="item-menu-mobile">
						<a href="/home/about/">About</a>
					</li>

					<li class="item-menu-mobile">
						<a href="/home/contact/">Contact</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

<!-- End Header -->

<!-- Content -->

    <?php echo $content['content_html']; ?>

<!-- End Content -->



<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div>
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Categories
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Men
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Women
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Dresses
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Sunglasses
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Links
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Search
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							About Us
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Contact Us
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Returns
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Help
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Track Order
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Returns
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Shipping
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							FAQs
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
					</div>

				</form>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<a href="#">
				<img class="h-size2" src="/assets/default/images/icons/paypal.png" alt="IMG-PAYPAL">
			</a>

			<a href="#">
				<img class="h-size2" src="/assets/default/images/icons/visa.png" alt="IMG-VISA">
			</a>

			<a href="#">
				<img class="h-size2" src="/assets/default/images/icons/mastercard.png" alt="IMG-MASTERCARD">
			</a>

			<a href="#">
				<img class="h-size2" src="/assets/default/images/icons/express.png" alt="IMG-EXPRESS">
			</a>

			<a href="#">
				<img class="h-size2" src="/assets/default/images/icons/discover.png" alt="IMG-DISCOVER">
			</a>

			<div class="t-center s-text8 p-t-20">
				Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<!-- Container Selection1 -->
	<div id="dropDownSelect2"></div>

	
	<script type="text/javascript" src="/assets/default/vendor/animsition/js/animsition.min.js"></script>
	<script type="text/javascript" src="/assets/default/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="/assets/default/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/default/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
	<script type="text/javascript" src="/assets/default/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="/assets/default/js/slick-custom.js"></script>
	<script type="text/javascript" src="/assets/default/vendor/countdowntime/countdowntime.js"></script>
	<script type="text/javascript" src="/assets/default/vendor/lightbox2/js/lightbox.min.js"></script>
	<script type="text/javascript" src="/assets/default/vendor/noui/nouislider.min.js"></script>
	<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 50, 200 ],
	        connect: true,
	        range: {
	            'min': 50,
	            'max': 200
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
	</script>
	<script src="/assets/default/js/main.js"></script>

	<?php 
		
		if ( Session::get('userid') != null ) {			
	?>
	<script>
		/**
		 * if logged-in fetch for customer's order or pending order
		 */
		function getOrders(){
			
			return $.ajax({
				type: 'POST',
				url: '/ajax/orders/getorders/',
				data: { id: "<?=Session::get('userid')?>" },
				dataType: 'json',
				crossDomain: true,
				headers: {'X-Requested-With': 'XMLHttpRequest'},
				success: function (response) {
					if (response) {    
						
					}
				}
			});
		}

		/**
		 * fetch order's every second and display to cart
		 */
		setInterval(() => {
			getOrders().done(function($data) {
				$data = JSON.parse($data);

				var $qty = $data.length;
				$('.header-icons-noti').text( $qty );

				var $orders = '';
				var $total = 0;

				$.each( $data, function(index, value){

					var $photo = value.images.split(',');

					$orders += '	<li class="header-cart-item">' +
									'<div class="header-cart-item-img">' +
										'<img src="/uploads/products/' + $photo[0] + '" alt="IMG">' + 
									'</div>' +
									'<div class="header-cart-item-txt">' +
										'<a href="#" class="header-cart-item-name">' +
											value.name +
										'</a>' +

										'<span class="header-cart-item-info">' +
											value.price +
										'</span>' +
									'</div>' +
								'</li>';

					$total += parseFloat(value.price);
				});

				$('#cart-desktop').html($orders);
				$('#cart-mobile').html($orders);

				$('#cart-total-desktop').html($total.toFixed(2));
				$('#cart-total-mobile').html($total.toFixed(2));
			
			});
		}, 1000);
	</script>

	<?php } ?>

</body>
</html>
