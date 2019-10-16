<!-- start footer -->
<footer class="footer-standard">
    <div class="footer-widget-area padding-five-tb sm-padding-30px-tb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 widget border-right border-color-extra-light-gray md-no-border-right md-margin-30px-bottom text-center text-md-left">
                    <!-- start logo -->
                    <a href="index.html" class="margin-20px-bottom d-inline-block"><img class="footer-logo" src="images/logo.png" data-rjs="images/logo@2x.png" alt="Pofo"></a>
                    <!-- end logo -->
                    <?php dynamic_sidebar( 'footer1' ); ?>
                </div>
                <!-- start additional links -->
                <div class="col-lg-3 col-md-6 widget border-right border-color-extra-light-gray padding-45px-left md-padding-15px-left md-no-border-right md-margin-30px-bottom text-center text-md-left">
                    <?php dynamic_sidebar( 'footer2' ); ?>
                </div>
                <!-- end additional links -->
                <!-- start contact information -->
                <div class="col-lg-3 col-md-6 widget border-right border-color-extra-light-gray padding-45px-left md-padding-15px-left sm-clear-both md-no-border-right sm-margin-30px-bottom text-center text-md-left">
                    <?php dynamic_sidebar( 'footer3' ); ?>
                </div>
                <!-- end contact information -->
                <!-- start instagram -->
                <div class="col-lg-3 col-md-6 widget padding-45px-left md-padding-15px-left text-center text-md-left">
                    <?php dynamic_sidebar( 'footer4' ); ?>
                </div>
                <!-- end instagram -->
            </div>
        </div>
    </div>

    <div class="bg-light-gray padding-50px-tb text-center sm-padding-30px-tb">
        <div class="container">
            <div class="row">
                <!-- start copyright -->
                <div class="col-md-6 text-center text-md-left text-small">&copy; 2019 POFO is Proudly Powered by <a href="http://www.themezaa.com" target="_blank" class="text-dark-gray">ThemeZaa</a></div>
                <div class="col-md-6 text-center text-md-right text-small">
                    <a href="javascript:void(0);" class="text-dark-gray">Term and Condition</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="text-dark-gray">Privacy Policy</a>
                </div>
                <!-- end copyright -->
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

<?php snth_show_template('footer/scroll-top-arrow.php'); ?>

<?php wp_footer(); ?>
</body>
</html>
