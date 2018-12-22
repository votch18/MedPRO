<!DOCTYPE html>
<html>
<head>
    <meta name="google-site-verification" content="6RlxAasSqBJpNnnuOPs05px8gu60UgzGYIFeGq4Qbk0" />
    <title><?=ucwords(strtolower(Setting::get("site_name"))) ?></title>
    <meta charset="UTF-8">
    <!-- Site made with Mobirise Website Builder v3.10.5, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">
    <meta name="description" content="Sarnimian Inland Resort the best Inland Resort in the Province of Agusan del Sur">
    <meta name="keywords" content="sarnimian resort rosario agusan del sur, sarnimian resort rosario, sarnimian inland resort rosario agusan del sur, sarnimian inland resort map, sarnimian inland resort map, agusan del sur resorts, rosario agusan del sur philippines, agusan del sur tourist spots, agusan del sur list of hotels">


    <?php if (App::getRouter()->getController() == "home" && App::getRouter()->getAction() == "signup") { ?>


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php } ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/assets/bootstrap-material-design-font/css/material.css">
    <link rel="stylesheet" href="/assets/et-line-font-plugin/style.css">
    <link rel="stylesheet" href="/assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="/assets/tether/tether.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/dropdown/css/style.css">
    <link rel="stylesheet" href="/assets/animate.css/animate.min.css">
    <link rel="stylesheet" href="/assets/theme/css/style.css">
    <link rel="stylesheet" href="/assets/mobirise-gallery/style.css">
    <link rel="stylesheet" href="/assets/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="stylesheet" href="/css/calendar.css" type="text/css">



    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=215405009196469&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<section id="ext_menu-0">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">
                    <div class="navbar-brand">
                        <a href="/" class="navbar-logo"><img src="/assets/images/logo.png"></a>
                        <a class="navbar-caption text-black" href="/"><?=strtoupper(Setting::get("site_name"))?><br></a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                      <!--<li class="nav-item"><a class="nav-link link" href="/home#services">OUR SERVICES</a></li>-->                      
                        <li class="nav-item"><a class="nav-link link" href="/blogs/">BLOG</a></li>
                      <li class="nav-item"><a class="nav-link link" href="/home#gallery">AMENITIES</a></li>
                        <li class="nav-item"><a class="nav-link link" href="/rooms/available/">ROOMS</a></li>
                        <li class="nav-item"><a class="nav-link link" href="/home/signup/">SIGN-UP</a></li>
                        <li class="nav-item nav-btn"><a class="nav-link btn btn-black-outline btn-black" href="/u/login/">LOGIN</a></li>
                        <li class="nav-item nav-btn">
                            <a class="nav-link btn btn-primary" href="/home/room_check/">BOOK NOW</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

             <?php echo $content['content_html']; ?>

<section class="mbr-section mbr-section-md-padding mbr-footer footer2" id="contacts2-b" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">

    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Address</strong><br><?=Setting::get("address")?><br><br><br>
                    <strong>Contacts</strong><br>
                    <?=Setting::get("contact_no")?></p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3"><strong>Links</strong>
                <ul>
                    <li><a class="text-white" href="/">LGU-Rosario, ADS</a></li>
                    <li><a class="text-white" href="/">PNP</a></li>
                    <li><a class="text-white" href="/">BFP</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="mbr-map" title="Sarnimian Inland Resort Map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:ChIJ4Qm6BDPh_TIR4qFaAPEeowk" allowfullscreen=""></iframe></div>
            </div>
        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-c" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    <div class="container">
    <?php
    $now = new DateTime("now");
    ?>
        <p class="text-xs-center"><?=Setting::get('footer')?> Copyright (c) <?=$now->format('Y')?> <?=strtoupper(Setting::get("site_name"))?></p>
    </div>
</footer>


<script src="/assets/web/assets/jquery/jquery.min.js"></script>
<script src="/assets/tether/tether.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/smooth-scroll/SmoothScroll.js"></script>
<script src="/assets/dropdown/js/script.min.js"></script>
<script src="/assets/touchSwipe/jquery.touchSwipe.min.js"></script>
<script src="/assets/jarallax/jarallax.js"></script>
<script src="/assets/masonry/masonry.pkgd.min.js"></script>
<script src="/assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>
<script src="/assets/viewportChecker/jquery.viewportchecker.js"></script>
<script src="/assets/theme/js/script.js"></script>
<script src="/assets/mobirise-gallery/player.min.js"></script>
<script src="/assets/mobirise-gallery/script.js"></script>
<script src="/assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>

<script src="/js/myjs.js"></script>
<input name="animation" type="hidden">

</body>
</html>
