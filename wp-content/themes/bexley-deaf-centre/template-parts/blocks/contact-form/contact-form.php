<?php 
    $title = get_field('title');
    $form_title = get_field('form_title');
    $text = get_field('text');
    $image = get_field('image');
    $form_id = get_field('forminator_form_id'); // The selected form ID
    $phone = get_field('phone_number', 'options');
    $email = get_field('email_address', 'options');
    $address = get_field('address', 'options');
    $background_type = get_field('background_type');
    $remove_padding = get_field('remove_top_padding');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/contact-form/_preview.png' ); ?>'>

<?php else: ?>

    <section class='contact-form padded-mid <?php echo esc_html($background_type);?> <?php echo $remove_padding ? 'no-pad-top' : ''; ?>'>
        <?php if (!empty($image)) : ?>
            <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
        <?php endif; ?>
        <div class='container'>
            <div class='contact-form__inner' data-aos="fade-up">
                <div class="contact-form__left">
                    <?php if ($form_id) {
                        echo do_shortcode("[forminator_form id='{$form_id}']");
                    } ?>                
                </div>
                <div class="contact-form__right">
                    <?php if(!empty($title)): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($text)): ?>
                        <p><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                    <?php if(!empty($phone)): ?>
                    <div class="contact-container">
                        <a href="tel:<?php echo esc_html($phone); ?>" target="_blank"><?php echo esc_html($phone); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($email)): ?>
                        <div class="contact-container email">
                            <a href="mailto:<?php echo esc_html($email); ?>" target="_blank"><?php echo esc_html($email); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($address)): ?>
                        <div class="contact-container address">
                            <?php echo wp_kses_post($address); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>