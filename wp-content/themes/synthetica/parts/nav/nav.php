<?php
/**
 * @var $color
 */

$color = !empty($color) ? $color : 'white';
$nav_class = 'background-white header-light';

if ('dark' === $color) {
    $nav_class = 'background-black header-dark white-link';
} elseif ('transparent' === $color) {
    $nav_class = 'header-light background-transparent nav-box-width white-link';
}
?>
    <nav class="navbar navbar-default bootsnav navbar-expand-lg navbar-top <?php echo $nav_class; ?>">
        <!-- start navigation -->
        <div class="container-fluid nav-header-container">
            <!-- start logo -->
            <div class="col-auto pl-0">
                <a href="<?php echo get_home_url('/'); ?>" title="Pofo" class="logo">
                    <?php
                    if ('white' === $color) {
                        ?>
                            <img src="<?php echo SNTH_IMAGES_URL ?>/pofo/logo.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/pofo/logo@2x.png" class="logo-dark default" alt="Pofo">
                            <img src="<?php echo SNTH_IMAGES_URL ?>/pofo/logo-white.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/pofo/logo-white@2x.png" alt="Pofo" class="logo-light">
                        <?php
                    } elseif ('dark' === $color) {
                        ?>
                            <img src="<?php echo SNTH_IMAGES_URL ?>/pofo/logo.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/pofo/logo@2x.png" class="logo-dark" alt="Pofo">
                            <img src="<?php echo SNTH_IMAGES_URL ?>/pofo/logo-white.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/pofo/logo-white@2x.png" alt="Pofo" class="logo-light default">
                        <?php
                    } elseif ('transparent' === $color) {
                        ?>
                            <img src="<?php echo SNTH_IMAGES_URL ?>/pofo/logo.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/pofo/logo@2x.png" class="logo-dark" alt="Pofo">
                            <img src="<?php echo SNTH_IMAGES_URL ?>/pofo/logo-white.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/pofo/logo-white@2x.png" alt="Pofo" class="logo-light default">
                        <?php
                    }
                ?>
                </a>
            </div>
            <!-- end logo -->
            <div class="col accordion-menu pr-0 pr-md-3">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                    <span class="sr-only">toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-end" id="navbar-collapse-toggle-1">
                    <?php snth_main_nav(); ?>
                </div>
            </div>

            <div class="col-auto pr-0">
                <div class="header-searchbar">
                    <a href="#search-header" class="header-search-form"><i class="fas fa-search search-button"></i></a>
                    <!-- search input-->
                    <?php get_search_form(); ?>
                </div>
                <div class="header-social-icon d-none d-md-inline-block">
                    <a href="https://www.facebook.com/" title="Facebook" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/" title="Twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://dribbble.com/" title="Dribbble" target="_blank"><i class="fab fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </nav>
<!-- end navigation -->
