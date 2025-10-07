<?php 
    $title = get_field('title');
    $text = get_field('text');
    $image = get_field('image');
    $bg_color = get_field('background_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img style='max-width:100%;height:auto;' src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/course-units/_preview.png' ); ?>'>

<?php else: ?>

    <section class='course-units padded-mid bg-<?php echo esc_html($bg_color)?>'>
        <div class='container'>
            <div class='course-units__inner'>
                <div class="course-units__left">
                    <?php if (!empty($image)) : ?>
                        <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                    <?php endif; ?>
                </div>
                <div class="course-units__right">
                    <?php if(!empty($title)): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($text)): ?>
                        <p><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                    <?php if(have_rows('course_units')): ?>
                        <div class="unit-container">
                        <?php while(have_rows('course_units')): the_row();?>
                            <?php
                                $unit_title = get_sub_field('unit_title');
                                $unit_subtitle = get_sub_field('unit_subtitle');
                                $assessed = get_sub_field('unit_taught');
                            ?>
                            <div class="course-units__unit">
                                <div class="course-unit-left">
                                    <?php if(!empty($unit_title)): ?>
                                        <h3><?php echo esc_html($unit_title); ?></h3>
                                    <?php endif; ?>
                                    <?php if(!empty($unit_subtitle)): ?>
                                        <p><?php echo esc_html($unit_subtitle); ?></p>
                                    <?php endif; ?>
                                    <?php if(!empty($assessed)): ?>
                                        <p class="assessed"><?php echo esc_html($assessed); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if(have_rows('unit_list')): ?>
                                    <div class="course-unit-right">
                                        <ul>
                                        <?php while(have_rows('unit_list')): the_row();?>
                                            <?php
                                                $item = get_sub_field('item');
                                            ?>
                                            <li><?php echo esc_html($item) ?></li>
                                        <?php endwhile; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>