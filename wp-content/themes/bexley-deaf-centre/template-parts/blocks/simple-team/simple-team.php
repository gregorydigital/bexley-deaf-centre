<?php 
    $title = get_field('title');
    $text = get_field('text');
    $bg_color = get_field('background_color');
    $three_columns = get_field('three_columns');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/ /_preview.png' ); ?>'>

<?php else: ?>

    <section class='simple-team padded-mid bg-<?php echo esc_html($bg_color)?> <?php echo $three_columns ? 'three-column' : ''; ?>'>
        <div class='container'>
            <div class="simple-team__content">
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <div class='simple-team__inner'>
                <?php if(have_rows('team_cards')): ?>
                    <?php while(have_rows('team_cards')): the_row();?>
                        <?php
                            $image = get_sub_field('image');
                            $card_title = get_sub_field('card_title');
                            $card_text = get_sub_field('card_text');
                        ?>
                        <div class="simple-team__card">
                            <div class="simple-team__card-image">
                                <?php if (!empty($image)) : ?>
                                    <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="simple-team__card-content">
                                <?php if(!empty($card_title)): ?>
                                    <h3><?php echo esc_html($card_title); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($card_text)): ?>
                                    <p><?php echo esc_html($card_text); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>