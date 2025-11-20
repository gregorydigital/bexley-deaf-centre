<?php get_header(); ?>

<main id="primary" class="site-main blog-page">

    <?php 
        $title = get_field('blog_page_title', 'options');
        $text = get_field('blog_page_text', 'options');
    ?>

    <div class="blog-post-hero">
        <div class="container">
            <?php if(!empty($title)): ?>
                <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            <?php if(!empty($text)): ?>
                <p><?php echo esc_html($text); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container blog-container">

        <!-- Breadcrumbs -->
        <nav class="breadcrumbs">
            <a href="<?php echo home_url(); ?>">Home</a> ›
            <span>News</span>
        </nav>

        <header class="archive-header">
            <h2>All News</h2>
        </header>

        <!-- Posts Grid -->
        <div class="posts-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="post-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="img-container">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        </a>
                    <?php endif; ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="post-card-bottom">
                        <a href="<?php the_permalink(); ?>">
                            <span>Read more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 5.29 32 21.41"><path d="m31.71 15.29-10-10-1.42 1.42 8.3 8.29H0v2h28.59l-8.29 8.29 1.41 1.41 10-10a1 1 0 0 0 0-1.41z" data-name="3-Arrow Right"></path></svg>                            
                        </a>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <?php
            the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ]);
            ?>
        </div>

    </div>

</main>

<?php get_footer(); ?>