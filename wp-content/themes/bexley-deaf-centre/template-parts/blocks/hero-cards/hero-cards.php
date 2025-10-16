<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img style='max-width:100%;height:auto;' src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/hero-cards/_preview.png' ); ?>'>

<?php else: ?>

    <section class='hero-cards padded-mid'>
        <div class='container'>
            <div class='hero-cards__inner' data-aos="fade-up">
                <?php if(have_rows('hero_cards')): ?>
                    <?php while(have_rows('hero_cards')): the_row();?>
                        <?php
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                            $link = get_sub_field('link');
                            $image = get_sub_field('image');
                        ?>
                        <div class="hero-cards__card <?php echo $image ? 'bg-image' : '';?>">
                            <?php if (!empty($image)) : ?>
                                <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                            <?php endif; ?>
                            <div class="hero-cards__content">
                                <?php if(!empty($title)): ?>
                                    <h3><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($text)): ?>
                                    <p><?php echo esc_html($text); ?></p>
                                <?php endif; ?>
                                <?php if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                    <a class='btn btn--white' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>