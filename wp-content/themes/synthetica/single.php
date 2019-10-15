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

<div class="col-12 margin-30px-top">
    <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start width-100 border border-color-extra-light-gray padding-50px-all md-padding-30px-all sm-padding-20px-all">
        <div class="width-150px text-center sm-margin-15px-bottom sm-width-100">
            <img src="http://placehold.it/149x149" class="rounded-circle width-100px" alt="" />
        </div>
        <div class="width-100 padding-40px-left last-paragraph-no-margin sm-no-padding-left text-center text-md-left">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="text-extra-dark-gray text-uppercase alt-font font-weight-600 margin-10px-bottom d-inline-block text-small">
                <?php echo get_the_author() ?>
            </a>

            <br>

            <?php echo wpautop(get_the_author_meta( 'description' )); ?>

            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="btn btn-very-small btn-black margin-20px-top">
                <?php echo __('All author posts', 'synthetica'); ?>
            </a>
        </div>
    </div>
</div>
<div class="col-12 d-flex flex-wrap p-0">
    <div class="col-12 mx-auto text-center margin-80px-tb md-margin-50px-tb sm-margin-30px-tb">
        <div class="position-relative overflow-hidden width-100">
            <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">Related Posts</span>
        </div>
    </div>
    <!-- start post item -->
    <div class="col-12 col-lg-4 col-md-6 last-paragraph-no-margin md-margin-50px-bottom sm-margin-30px-bottom wow fadeIn">
        <div class="blog-post blog-post-style1 text-center text-md-left">
            <div class="blog-post-images overflow-hidden margin-25px-bottom md-margin-20px-bottom">
                <a href="blog-post-layout-01.html">
                    <img src="http://placehold.it/700x500" alt="">
                </a>
            </div>
            <div class="post-details">
                <span class="post-author text-extra-small text-medium-gray text-uppercase d-block margin-10px-bottom sm-margin-5px-bottom">17 july 2017 | by <a href="blog-masonry.html" class="text-medium-gray">Jay Benjamin</a></span>
                <a href="blog-post-layout-01.html" class="post-title text-medium text-extra-dark-gray width-90 d-block md-width-100">I try to look at design from a more conceptual standpoint.</a>
                <div class="separator-line-horrizontal-full bg-medium-light-gray margin-20px-tb md-margin-15px-tb"></div>
                <p class="width-90 sm-width-100">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum text...</p>
            </div>
        </div>
    </div>
    <!-- end post item -->
    <!-- start post item -->
    <div class="col-12 col-lg-4 col-md-6 last-paragraph-no-margin md-margin-50px-bottom sm-margin-30px-bottom wow fadeIn" data-wow-delay="0.2s">
        <div class="blog-post blog-post-style1 text-center text-md-left">
            <div class="blog-post-images overflow-hidden margin-25px-bottom md-margin-20px-bottom">
                <a href="blog-post-layout-02.html">
                    <img src="http://placehold.it/700x500" alt="">
                </a>
            </div>
            <div class="post-details">
                <span class="post-author text-extra-small text-medium-gray text-uppercase d-block margin-10px-bottom sm-margin-5px-bottom">03 July 2017 | by <a href="blog-masonry.html" class="text-medium-gray">Herman Miller</a></span>
                <a href="blog-post-layout-02.html" class="post-title text-medium text-extra-dark-gray width-90 d-block md-width-100">Good design accelerates the adoption of new ideas.</a>
                <div class="separator-line-horrizontal-full bg-medium-light-gray margin-20px-tb md-margin-15px-tb"></div>
                <p class="width-90 sm-width-100">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum text...</p>
            </div>
        </div>
    </div>
    <!-- end post item -->
    <!-- start post item -->
    <div class="col-12 col-lg-4 col-md-6 last-paragraph-no-margin sm-margin-30px-bottom wow fadeIn" data-wow-delay="0.4s">
        <div class="blog-post blog-post-style1 text-center text-md-left">
            <div class="blog-post-images overflow-hidden margin-25px-bottom md-margin-20px-bottom">
                <a href="blog-post-layout-03.html">
                    <img src="http://placehold.it/700x500" alt="">
                </a>
            </div>
            <div class="post-details">
                <span class="post-author text-extra-small text-medium-gray text-uppercase d-block margin-10px-bottom sm-margin-5px-bottom">22 June 2017 | by <a href="blog-masonry.html" class="text-medium-gray">Hugh Macleod</a></span>
                <a href="blog-post-layout-03.html" class="post-title text-medium text-extra-dark-gray width-90 d-block md-width-100">Design is inherently optimistic. That is its power.</a>
                <div class="separator-line-horrizontal-full bg-medium-light-gray margin-20px-tb md-margin-15px-tb"></div>
                <p class="width-90 sm-width-100">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum text...</p>
            </div>
        </div>
    </div>
    <!-- end post item -->
</div>

<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) {
    ?>
    <div class="col-12 margin-eight-top">
        <div class="divider-full bg-medium-light-gray"></div>
    </div>
    <?php
    comments_template();
}

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
            } elseif ('fullwidth' === $template) {
                ?>

                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer('dark'); ?>
