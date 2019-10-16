<?php
/**
 * @var $title
 * @var $subtitle
 * @var $is_breadcrumb
 * @var $is_dark
 * @var $parallax
 * @var $image
 */
?>

<!-- start page title section -->
<section
    class="wow fadeIn bg-extra-dark-gray<?php echo !empty($parallax) ? ' parallax' : ''; ?>"
    <?php echo !empty($parallax) ? ' data-stellar-background-ratio="0.5"' : ''; ?>
    style="<?php echo !empty($image) ? " background-image:url('http://placehold.it/1920x1100');" : ''; ?>"
>
    <?php
    if (!empty($parallax)) {
        ?><div class="opacity-medium bg-extra-dark-gray"></div><?php
    }
    ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 d-flex flex-column justify-content-center text-center extra-small-screen page-title-large">
                <!-- start page title -->
                <h1 class="text-white-2 alt-font font-weight-600 letter-spacing-minus-1 margin-10px-bottom"><?php echo $title; ?></h1>
                <span class="text-white-2 opacity6 alt-font">Lorem Ipsum is simply dummy text printing</span>
                <!-- end page title -->
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->