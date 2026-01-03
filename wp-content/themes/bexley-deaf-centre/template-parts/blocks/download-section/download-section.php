<?php 
    $title = get_field('title');
    $text = get_field('text');
    $bg_color = get_field('background_color');
    $file = get_field('download_file');
    $download_text = get_field('download_button_text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img style='max-width:100%;height:auto;' src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/download-section/_preview.png' ); ?>'>

<?php else: ?>

    <section class='download-section padded-mid bg-<?php echo esc_html($bg_color)?>'>
        <div class='container'>
            <div class='download-section__inner'>
                <?php if(!empty($title)): ?>
                    <h3><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                <?php if(!empty($file)): ?>
                <a class='btn' href='<?php echo esc_url( $file ); ?>' target='_blank'>
                    <?php if(!empty($download_text)): ?>
                        <?php echo esc_html($download_text); ?>
                    <?php else: ?>
                        Download
                    <?php endif; ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>