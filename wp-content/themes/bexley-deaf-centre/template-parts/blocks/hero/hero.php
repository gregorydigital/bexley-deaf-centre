<?php 
   $image = get_field('image');
   $title = get_field('title');
   $text = get_field('intro');
   $link = get_field('link');
   $course_hero = get_field('course_hero');
   $duration = get_field('duration');
   $location = get_field('location');
   $delivery = get_field('delivery');
   $certification = get_field('certification');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/hero/_preview.png' ); ?>">

<?php else: ?> 

   <section class="hero">
      <?php if (!empty($image)) : ?>
          <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
      <?php endif; ?>
      <div class="container">
         <div class="hero__inner">
            <div class="hero__content" data-aos="fade-up">
               <?php if(!empty($title)): ?>
                  <h1><span></span><?php echo esc_html($title); ?></h1>
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
            <?php if($course_hero) : ?>
            <div class="hero__course">
               <?php if(!empty($location)): ?>
                  <p><strong>Location:</strong> <?php echo esc_html($location); ?></p>
               <?php endif; ?>
               <?php if(!empty($duration)): ?>
                  <p><strong>Duration:</strong> <?php echo esc_html($duration); ?></p>
               <?php endif; ?>
               <?php if(!empty($delivery)): ?>
                  <p><strong>Delivery:</strong> <?php echo esc_html($delivery); ?></p>
               <?php endif; ?>
               <?php if(!empty($certification)): ?>
                  <p><strong>Certification:</strong> <?php echo esc_html($certification); ?></p>
               <?php endif; ?>
            </div>
            <?php endif; ?>
         </div>
      </div>
      <div class="hero__wave">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,64 C360,0 1080,128 1440,64 L1440,100 L0,100 Z" fill="#FFFFFF" />
         </svg>
      </div>
   </section>

<?php endif; ?>