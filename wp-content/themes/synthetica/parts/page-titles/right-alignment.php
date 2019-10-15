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
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 text-center text-md-left breadcrumb justify-content-center justify-content-md-start text-small alt-font">
                <!-- start breadcrumb -->
                <?php snth_the_breadcrumbs(); ?>
                <!-- end breadcrumb -->
            </div>
            <div class="col-lg-8 col-md-6 sm-margin-10px-top text-center text-md-right">
                <!-- start page title -->
                <h1 class="entry-title alt-font text-extra-dark-gray font-weight-600 mb-0"><?php echo $title ?></h1>
                <!-- end page title -->
                <!-- start sub title -->
                <span class="d-block margin-5px-top alt-font">Short page title tagline goes here</span>
                <!-- end sub title -->
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->
