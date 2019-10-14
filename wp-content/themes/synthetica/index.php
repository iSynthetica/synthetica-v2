<?php
/**
 *
 */

$template = 'right-sidebar';

if ('right-sidebar' === $template) {
    $title = 'Blog right sidebar';
} elseif ('left-sidebar' === $template) {
    $title = 'Blog left sidebar';
} elseif ('fullwidth' === $template) {
    $title = 'Blog fullwidth';
}

ob_start();
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        snth_show_template('blog/standart.php');
    }

    $pagination_args = array();

    snth_pagination($pagination_args);
}
$content = ob_get_clean();
?>

<?php get_header('transparent'); ?>

<!-- start page title section -->
<section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url('http://placehold.it/1920x1100');">
    <div class="opacity-medium bg-extra-dark-gray"></div>
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

<section>
    <div class="container">
        <div class="row">
            <?php
            if ('right-sidebar' === $template) {
                ?>
                <main class="col-12 col-lg-9 right-sidebar md-margin-60px-bottom sm-margin-40px-bottom pl-0 md-no-padding-right">
                    <?php echo $content; ?>
                </main>

                <aside class="col-12 col-lg-3 float-right">
                    <?php get_sidebar('blog'); ?>
                </aside>
                <?php
            } elseif ('left-sidebar' === $template) {
                ?>
                <main class="col-12 col-lg-9 left-sidebar md-margin-60px-bottom sm-margin-40px-bottom pr-0 md-no-padding-left">
                    <?php echo $content; ?>
                </main>

                <aside class="col-12 col-lg-3">
                    <?php get_sidebar('blog'); ?>
                </aside>
                <?php
            } else {
                ?>

                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer('dark'); ?>
