<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg); background-color: #D3D3D3;">
		<h2 class="l-text2 t-center">
			Sign-up
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-3 p-b-30">
				
				</div>

				<div class="col-md-6 p-b-30">
					<form class="leave-comment" method="POST">
					<?php if (Session::hasFlash()) {  ?>
						<div id="alert" class="alert alert-danger"><?= Session::flash(); ?></div>
					<?php } ?>
						<h4 class="m-text26 p-b-36 p-t-15">
							Sign-in to your account.
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="username" placeholder="Email Address" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Password" required>
						</div>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Sign-in
							</button>
						</div>
					</form>
				</div>

				<div class="col-md-3 p-b-30">
					
				</div>

			</div>
		</div>
	</section>
