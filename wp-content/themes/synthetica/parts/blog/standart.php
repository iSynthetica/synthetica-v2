<?php
$categories_list = get_the_category_list( ', ' );
?>

<!-- start post item -->
<article id="post-<?php the_ID(); ?>"  class="col-12 blog-post-content margin-60px-bottom sm-margin-30px-bottom text-center text-md-left">
    <div class="blog-image"><a href="blog-standard-post.html"><img src="http://placehold.it/1200x752" alt=""/></a></div>

    <div class="blog-text border-all d-inline-block width-100">
        <div class="content padding-50px-all sm-padding-20px-all">
            <div class="text-medium-gray text-extra-small margin-5px-bottom text-uppercase alt-font">
                <span><i class="far fa-calendar-alt"></i> Posted on <?php echo get_the_date(); ?></span>
                <?php
                if ($categories_list) {
                    ?>
                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <span><i class="far fa-folder-open"></i> <?php echo $categories_list; ?></span>
                    <?php
                }
                ?>
            </div>
            <h2 class="entry-title">
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="text-extra-dark-gray text-uppercase alt-font text-large font-weight-600 margin-15px-bottom d-block">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="entry-content last-paragraph-no-margin">
                <?php the_excerpt(); ?>
            </div>
        </div>

        <div class="row m-0 author border-top border-color-extra-light-gray text-center">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center name padding-15px-all">
                <div>
                    <img src="http://placehold.it/149x149" alt="" class="rounded-circle width-30px">
                    <span class="text-medium-gray text-uppercase text-extra-small alt-font padding-10px-left">by
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="text-medium-gray">
                            <?php echo get_the_author(); ?>
                        </a>
                    </span>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center name border-lr padding-15px-all border-color-extra-light-gray sm-no-border">
                <div>
                    <a href="#" class="text-extra-small alt-font text-medium-gray text-uppercase"><i class="far fa-heart margin-5px-right text-small"></i>5 like(s)</a>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center name padding-15px-all">
                <div>
                    <a href="#" class="text-extra-small alt-font text-medium-gray text-uppercase"><i class="far fa-comment margin-5px-right text-small"></i>3 Comment(s)</a>
                </div>
            </div>
        </div>
    </div>
</article>
<!-- end post item -->