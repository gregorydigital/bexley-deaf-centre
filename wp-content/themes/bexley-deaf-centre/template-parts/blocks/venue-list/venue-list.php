<?php 
    $title = get_field('title');
    $text = get_field('text');
    $image = get_field('image');
    $bg_color = get_field('background_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img style='max-width:100%;height:auto;' src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/course-units/_preview.png' ); ?>'>

<?php else: ?>

    <section class='course-units venue-list padded-mid bg-<?php echo esc_html($bg_color)?>'>
        <div class='container'>
            <div class='course-units__inner'>
                <div class="course-units__left">
                    <?php if(!empty($title)): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($text)): ?>
                        <p><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                    <div class="course-units__image">
                        <?php if (!empty($image)) : ?>
                            <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="course-units__right">
                    <?php if(have_rows('venue_list')): ?>
                        <div class="unit-container">
                        <?php while(have_rows('venue_list')): the_row();?>
                            <?php
                                $venue = get_sub_field('venue');
                                $location = get_sub_field('location');
                                $description = get_sub_field('description');
                                $time = get_sub_field('time');
                            ?>
                            <div class="course-units__unit">
                                <div class="course-unit-left">
                                    <div class="course-title">
                                        <?php if(!empty($venue)): ?>
                                            <h3><?php echo esc_html($venue); ?></h3>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($location)): ?>
                                        <p class="assessed"><?php echo esc_html($location); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="course-unit-right">
                                    <?php if(!empty($time)) :?>
                                        <ul>
                                            <li><?php echo esc_html($time) ?></li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>