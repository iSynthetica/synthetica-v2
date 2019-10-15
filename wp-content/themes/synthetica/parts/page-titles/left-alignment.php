<?php
/**
 * @var $title
 * @var $subtitle
 * @var $is_breadcrumb
 * @var $is_dark
 */

$is_dark_class = !empty($is_dark) ? 'bg-extra-dark-gray' : 'bg-light-gray';
$is_dark_text_class = !empty($is_dark) ? 'text-white-2' : 'text-extra-dark-gray';
?>

<!-- start page title section -->
<section class="wow fadeIn <?php echo $is_dark_class; ?> padding-50px-tb sm-padding-30px-tb page-title-small top-space">
    <div class="container">
        <div class="row align-items-center alt-font">
            <div class="col-lg-8 col-md-6 text-center text-md-left">
                <!-- start page title -->
                <h1 class="entry-title font-weight-600 mb-0 <?php echo $is_dark_text_class; ?>"><?php echo $title ?></h1>
                <!-- end page title -->
                <!-- start sub title -->
                <span class="d-block margin-5px-top <?php echo $is_dark_text_class; ?>">Short page title tagline goes here</span>
                <!-- end sub title -->
            </div>
            <div class="col-lg-4 col-md-6 sm-margin-10px-top breadcrumb text-small justify-content-center justify-content-md-end">
                <!-- start breadcrumb -->
                <?php snth_the_breadcrumbs(); ?>
                <!-- end breadcrumb -->
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->
