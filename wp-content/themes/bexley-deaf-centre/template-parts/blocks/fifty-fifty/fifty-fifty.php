<?php 
   $background_color = get_field('background_color');
   $title = get_field('title');
   $subtitle = get_field('preheader');
   $content = get_field('content');
   $show_video = get_field('show_video');
   $image = get_field('image');
   $video = get_field('video');
   $link = get_field('button');
   $flip = get_field('image_left');
   $wide = get_field('wide_text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/fifty-fifty/_preview.png' ); ?>">

<?php else: ?> 

   <section class="fifty-fifty padded-mid bg-<?php echo $background_color; ?> <?php echo $flip ? 'flip' : '' ; ?> <?php echo $wide ? 'wide-fifty' : '';?>" > 
      <div class="container"> 
         <div class="fifty-fifty__inner"> 
            <div class="fifty-fifty__left" data-aos="fade-up" data-aos-offset="200">
               <?php if($subtitle): ?>
                  <span class="fifty-fifty__preheader"><?php echo $subtitle; ?></span>
               <?php endif; ?>
               <?php if($title): ?>
                  <h2><?php echo $title; ?></h2>
               <?php endif; ?>
               <?php if($content): ?>
                  <?php echo $content; ?>
               <?php endif; ?>
               <?php if( $link ):
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
               ?>
                  <a class='btn' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
               <?php endif; ?>
            </div>
            <div class="fifty-fifty__right" data-aos="fade-up" data-aos-offset="200">
               <?php if($background_color === 'primary'): ?>
                  <img class="dots-blue" src="<?php echo esc_url( get_template_directory_uri() . '/images/dots-white.svg' ); ?>">
               <?php else: ?>
                  <img class="dots-blue" src="<?php echo esc_url( get_template_directory_uri() . '/images/dots.svg' ); ?>">
               <?php endif; ?>
               <img class="graphic-blue" src="<?php echo esc_url( get_template_directory_uri() . '/images/blue-drop.svg' ); ?>">
               <div class="fifty-fifty__right-inner">
                  <?php if($show_video === false) : ?>
                     <?php if($image): ?>
                        <img class="img-object-fit" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                     <?php endif; ?>
                  <?php else: ?>
                     <?php if(!empty($video)) :?>
                        <video class="fifty-fifty__video img-object-fit"  <?php if(!is_admin()): ?>autoplay muted loop playsinline<?php endif; ?>>
                           <source src="<?php echo get_field('video'); ?>" type="video/mp4">
                        </video>
                     <?php endif; ?>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </section>

<?php endif; ?>