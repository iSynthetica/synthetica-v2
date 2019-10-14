<?php
/**
 *
 */

$template = 'right-sidebar';

ob_start();

while ( have_posts() ) {
    the_post();
    ?>
    <div class="col-12 blog-details-text last-paragraph-no-margin">
        <?php the_content(); ?>
    </div>
    <?php
}
?>
<div class="col-12 margin-seven-bottom margin-eight-top">
    <div class="divider-full bg-medium-light-gray"></div>
</div>
<div class="row mx-0">
    <div class="col-12 col-lg-6 text-center text-lg-left">
        <div class="tag-cloud margin-20px-bottom">
            <a href="blog-grid.html">Advertisement</a>
            <a href="blog-grid.html">Artistry</a>
            <a href="blog-grid.html">Blog</a>
            <a href="blog-grid.html">Conceptual</a>
        </div>
    </div>
    <div class="col-12 col-lg-6 text-center text-lg-right">
        <div class="social-icon-style-6">
            <ul class="extra-small-icon">
                <li><a class="likes-count" href="#" target="_blank"><i class="fas fa-heart text-deep-pink"></i><span class="text-small">300</span></a></li>
                <li><a class="facebook" href="http://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a class="twitter" href="http://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li><a class="google" href="http://google.com" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a class="pinterest" href="http://dribbble.com" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();

?>

<?php get_header(); ?>
<!-- start page title section -->
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url('http://placehold.it/1920x450');">
    <div class="opacity-medium bg-extra-dark-gray"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 d-flex flex-column text-center justify-content-center page-title-large padding-30px-tb">
                <!-- start sub title -->
                <span class="d-block text-white-2 opacity6 alt-font margin-5px-bottom">We are awesome designer</span>
                <!-- end sub title -->
                <!-- start page title -->
                <?php the_title( '<h1 class="alt-font text-white-2 font-weight-600 mb-0">', '</h1>' ); ?>
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
                    <?php get_sidebar(); ?>
                </aside>
                <?php
            } elseif ('left-sidebar' === $template) {
                ?>
                <main class="col-12 col-lg-9 left-sidebar md-margin-60px-bottom sm-margin-40px-bottom pr-0 md-no-padding-left">
                    <?php echo $content; ?>
                </main>

                <aside class="col-12 col-lg-3">
                    <?php get_sidebar(); ?>
                </aside>
                <?php
            } elseif ('fullwidth' === $template) {
                ?>

                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
