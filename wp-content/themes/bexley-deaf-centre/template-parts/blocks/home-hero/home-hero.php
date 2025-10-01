<?php 
   $title = get_field('title');
   $text = get_field('text');
   $image = get_field('image');
   $bg_image = get_field('background_image');
   $cta_1 = get_field('cta_1');
   $cta_1_color = get_field('cta_1_color');
   $cta_2 = get_field('cta_2');
   $cta_2_color = get_field('cta_2_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/home-hero/_preview.png' ); ?>">

<?php else: ?> 

   <section class="home-hero">
      <?php if (!empty($bg_image)) : ?>
          <img class="img-object-fit" src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php echo esc_attr($bg_image['alt'] ?? ''); ?>" />
      <?php endif; ?>
      <div class="container">
         <div class="home-hero__inner">
            <div class="home-hero__left" data-aos="fade-up">
               <?php if(!empty($title)): ?>
                  <h1><?php echo esc_html($title); ?>HMMMMMMM</h1>
               <?php endif; ?>
               <?php if(!empty($text)): ?>
                  <p><?php echo esc_html($text); ?></p>
               <?php endif; ?>
               <div class="home-hero__buttons">
                  <?php if( $cta_1 ):
                     $cta_1_url = $cta_1['url'];
                     $cta_1_title = $cta_1['title'];
                     $cta_1_target = $cta_1['target'] ? $cta_1['target'] : '_self';
                  ?>
                     <a class='btn btn--<?php echo $cta_1_color ? esc_html($cta_1_color) : '' ;?>' href='<?php echo esc_url( $cta_1_url ); ?>' target='<?php echo esc_attr( $cta_1_target ); ?>'><?php echo esc_html( $cta_1_title ); ?></a>
                  <?php endif; ?>
                  <?php if( $cta_2 ):
                     $cta_2_url = $cta_2['url'];
                     $cta_2_title = $cta_2['title'];
                     $cta_2_target = $cta_2['target'] ? $cta_2['target'] : '_self';
                  ?>
                     <a class='btn btn--<?php echo $cta_2_color ? esc_html($cta_2_color) : '' ;?>' href='<?php echo esc_url( $cta_2_url ); ?>' target='<?php echo esc_attr( $cta_2_target ); ?>'><?php echo esc_html( $cta_2_title ); ?></a>
                  <?php endif; ?>
               </div>
            </div>
            <div class="home-hero__right">
               <?php if (!empty($image)) : ?>
                   <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
               <?php endif; ?>
            </div>
         </div>
      </div>
   </section>

<?php endif; ?>