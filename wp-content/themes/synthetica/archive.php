<?php
/**
 *
 */

$template = 'right-sidebar';

$title = snth_the_archive_title();

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
$page_title_template = 'big-typography';
$placeholder = SNTH_IMAGES_URL . '/placeholder.png';
?>

<?php get_header('transparent'); ?>

<?php
snth_show_template('page-titles/'.$page_title_template.'.php', array(
    'title' => $title,
    'image' => $placeholder,
    'parallax' => true,
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
            } else {
                ?>

                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer('dark'); ?>
