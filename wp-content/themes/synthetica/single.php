<?php
/**
 *
 */

$template = 'right-sidebar';
$categories_list = get_the_category_list( ', ' );
ob_start();

while ( have_posts() ) {
    the_post();

    $tags_list = get_the_tag_list( ' ' );
    ?>
    <div class="col-12 text-medium-gray text-extra-small margin-20px-bottom text-uppercase alt-font">
        <span><i class="far fa-calendar-alt"></i> Posted on <?php echo get_the_date(); ?></span>
        <?php
        if ($categories_list) {
            ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <span><i class="far fa-folder-open"></i> <?php echo $categories_list; ?></span>
            <?php
        }
        ?>
    </div>

    <div class="col-12 blog-details-text last-paragraph-no-margin">
        <?php the_content(); ?>
    </div>

    <div class="col-12 margin-seven-bottom margin-eight-top">
        <div class="divider-full bg-medium-light-gray"></div>
    </div>

    <div class="row mx-0">
        <div class="col-12 col-lg-6 text-center text-lg-left">
            <div class="tag-cloud margin-20px-bottom">
                <?php echo $tags_list; ?>
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
    <?php
}
?>

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
$page_title_template = 'left-alignment';
?>

<?php get_header(); ?>

<?php
snth_show_template('page-titles/'.$page_title_template.'.php', array(
    'title' => get_the_title(),
    'is_dark' => true,
));
?>

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
