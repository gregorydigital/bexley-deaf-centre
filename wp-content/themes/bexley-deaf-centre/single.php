<?php 
    get_header();
?>

<main id="primary" class="site-main">

<?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="blog-post-hero">
            <div class="container">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <p>Published on: <?php the_date(); ?></p>
            </div>
        </div>
        <div class="container">
            <div class="blog-post-content">
                <?php if (function_exists('display_custom_breadcrumbs')) display_custom_breadcrumbs(); ?>
                <?php the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'base-starter-theme' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    )
                ); ?>
            </div>
        </div>
    </article>

<?php endwhile; // End of the loop. ?>

<?php
$current_id = get_the_ID();

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 4, // change to how many you want
    'post__not_in'   => [$current_id], // exclude current post
    'orderby'        => 'date',
    'order'          => 'DESC',
];

$posts = get_posts($args);

?>

<?php if($posts): ?>
<section class="related-posts">
    <div class="container">
        <h2 class="indented">Other News</h2>
        <div class="related-posts__inner">
        <?php foreach ($posts as $post_obj) : ?>
            <a class="related-title" href="<?php echo esc_url(get_permalink($post_obj)); ?>">
                <div class="featured-post">
                    <?php if (has_post_thumbnail($post_obj)) : ?>
                        <div class="featured-post-image">
                        <?php echo get_the_post_thumbnail($post_obj, 'large', ['class' => 'related-post-grid__image']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="featured-post-content">
                        <h3 class="featured-post-title"><?php echo esc_html(get_the_title($post_obj)); ?></h3>
                        <div><span>Read More</span></div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


</main><!-- #main -->
<?php get_footer(); ?>
