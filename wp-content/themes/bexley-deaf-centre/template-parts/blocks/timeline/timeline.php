<?php 
    $title = get_field('title');
    $text = get_field('text');
    $bg_color = get_field('background_color');
    $link = get_field('link');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img style='max-width:100%;height:auto;' src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/ /_preview.png' ); ?>'>

<?php else: ?>

    <section class='timeline padded-mid bg-<?php echo esc_html($bg_color)?>'>
        <div class='container'>
            <div class='timeline__inner'>
                <div class="timeline__left">
                    <div class="timeline__sticky">
                        <?php if(!empty($title)): ?>
                            <h2><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        <?php if(!empty($text)): ?>
                            <p><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                        <?php if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                            <a class='custom-button' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                        <?php if (!empty($image)) : ?>
                            <div class="timeline__image-container">
                                <img class='img-object-fit' src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="timeline__right">
                    <?php if(have_rows('timeline_repeater')): ?>
                        <?php while(have_rows('timeline_repeater')): the_row();?>
                            <?php
                                $card_date = get_sub_field('date');
                                $card_text = get_sub_field('text');
                                $card_image = get_sub_field('image');
                            ?>
                            <div class="card-container">
                                <div class="timeline__card" data-aos="fade-up"  data-aos-delay="500">
                                    <?php if (!empty($card_image)) : ?>
                                        <div class="icon-bg">
                                            <img src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt'] ?? ''); ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-process-text">
                                        <?php if(!empty($card_date)): ?>
                                            <h3><?php echo esc_html($card_date); ?></h3>
                                        <?php endif; ?>
                                        <?php if(!empty($card_text)): ?>
                                            <?php echo wp_kses_post($card_text); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>