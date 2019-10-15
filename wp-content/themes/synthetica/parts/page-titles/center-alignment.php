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
<section class="wow fadeIn <?php echo $is_dark_class; ?> padding-100px-tb md-padding-60px-tb sm-padding-30px-tb top-space">
    <div class="container">
        <div class="row">
            <div class="col-12 page-title-medium text-center d-flex flex-column justify-content-center">
                <!-- start page title -->
                <h1 class="alt-font font-weight-600 m-0 <?php echo $is_dark_text_class; ?>"><?php echo $title ?></h1>
                <!-- end page title -->
                <!-- start sub title -->
                <span class="d-block margin-10px-top alt-font <?php echo $is_dark_text_class; ?>">We provide innovative solutions to expand your business</span>
                <!-- end sub title -->
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->