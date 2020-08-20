<!-- JS Global Compulsory -->
<script src="<?php echo $data['media_path']; ?>js/jquery-migrate.min.js"></script>
<script src="<?php echo $data['media_path']; ?>js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="<?php echo $data['media_path']; ?>js/back-to-top.js"></script>
<!--<script src="<?php echo $data['media_path']; ?>js/smoothScroll.js"></script>-->

<script src="<?php echo $data['media_path']; ?>js/waypoints.min.js"></script>
<script src="<?php echo $data['media_path']; ?>js/jquery.counterup.min.js"></script>
<script src="<?php echo $data['media_path']; ?>js/jquery.fancybox.pack.js"></script>
<script src="<?php echo $data['media_path']; ?>js/owl.carousel.js"></script>
<script src="<?php echo $data['media_path']; ?>js/masterslider.js"></script>
<script src="<?php echo $data['media_path']; ?>js/jquery.easing.min.js"></script>
<script src="<?php echo $data['media_path']; ?>js/modernizr.js"></script>
<script src="<?php echo $data['media_path']; ?>js/main.js"></script> <!-- Gem jQuery -->
<!-- JS Customization -->
<script src="<?php echo $data['media_path']; ?>js/custom.js"></script>

<script src="<?php echo $data['media_path']; ?>js/lightbox-plus-jquery.min.js?v2"></script>

<!-- JS Page Level -->
<script src="<?php echo $data['media_path']; ?>js/app.js"></script>
<script src="<?php echo $data['media_path']; ?>js/fancy-box.js"></script>
<script src="<?php echo $data['media_path']; ?>js/owl-carousel.js"></script>
<script src="<?php echo $data['media_path']; ?>js/master-slider-showcase1.js"></script>
<script src="<?php echo $data['media_path']; ?>js/style-switcher.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
    $('.carousel').carousel({
        pause: true,
        interval: false
    });
    jQuery(document).ready(function () {
        App.init();
        App.initCounter();
        FancyBox.initFancybox();
        OwlCarousel.initOwlCarousel();
        OwlCarousel.initOwlCarousel2();
        StyleSwitcher.initStyleSwitcher();
        MasterSliderShowcase1.initMasterSliderShowcase1();
    });
</script>