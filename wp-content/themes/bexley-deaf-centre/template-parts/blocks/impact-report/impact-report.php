<?php
  $intro_text = get_field('intro_paragraph');
?>

<section class="impact-report">

  <!-- HERO -->
  <section class="impact-report__hero padded-mid">
    <div class="container">

      <div class="impact-report__hero-stat" data-count="10180">
        <strong>0</strong>
        <span>times our services were accessed</span>
        <em class="stat-delta">+4% vs last year</em>
      </div>

      <?php if(!empty($intro_text)): ?>
        <div class="intro-paragraph">
          <?php echo wp_kses_post($intro_text); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- STATS -->
  <section class="impact-report__stats padded-mid">
    <div class="container">
      <h2>Our Year in a snapshot</h2>
      <div class="impact-report__stats-grid" data-aos="fade-up">
        <?php if(have_rows('stats_repeater')): ?>
          <?php while(have_rows('stats_repeater')): the_row();?>
            <?php
              $stat = get_sub_field('stat');
              $text = get_sub_field('text');
              $subtitle = get_sub_field('subtitle');
              $icon = get_sub_field('icon');
            ?>
             <div class="impact-report__stat" data-count="<?php echo esc_attr($stat); ?>">
              <?php if (!empty($icon)) : ?>
                  <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" />
              <?php endif; ?>
              <span class="stat-ring"></span>
              <strong>0</strong>
              <?php if(!empty($subtitle)): ?>
                <h4><?php echo esc_html($subtitle); ?></h4>
              <?php endif; ?>
              <p><?php echo esc_html($text); ?></p>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="impact-report__services">
    <?php if(have_rows('service_repeater')): ?>
      <?php while(have_rows('service_repeater')): the_row();?>
        <?php
          $title = get_sub_field('title');
          $text = get_sub_field('text');
          $service_image = get_sub_field('service_image');
        ?>
        <div class="impact-report__service-group padded-mid">
          <div class="container">
            <div class="impact-report__service-group-inner">
              <div class="impact-report__service-group-left" data-aos="fade-up">
              <?php if(!empty($title)): ?>
                <h2><?php echo esc_html($title); ?></h2>
              <?php endif; ?>
              <?php if(!empty($text)): ?>
                <p><?php echo esc_html($text); ?></p>
              <?php endif; ?>
              <?php if(have_rows('service_details')): ?>
                <div class="impact-report__service-items">
                  <?php while(have_rows('service_details')): the_row();?>
                    <?php
                      $detail_title = get_sub_field('detail_title');
                      $detail_text = get_sub_field('detail_text');
                    ?>
                    <div class="impact-report__service">
                      <?php if(!empty($detail_title)): ?>
                        <h3><?php echo esc_html($detail_title); ?></h3>
                      <?php endif; ?>
                      <?php if(!empty($detail_text)): ?>
                        <p><?php echo esc_html($detail_text); ?></p>
                      <?php endif; ?>
                    </div>
                  <?php endwhile; ?>
                </div>
              <?php endif; ?>
              </div>
              <div class="impact-report__service-group-right" data-aos="fade-up" data-aos-delay="300">
                  <?php if (!empty($service_image)) : ?>
                      <img class='img-object-fit' src="<?php echo esc_url($service_image['url']); ?>" alt="<?php echo esc_attr($service_image['alt'] ?? ''); ?>" />
                  <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
  const counters = document.querySelectorAll('[data-count]');

  const animate = (el) => {
    const target = +el.dataset.count;
    const number = el.querySelector('strong');
    let current = 0;
    const increment = Math.ceil(target / 60);

    const tick = () => {
      current += increment;
      if (current >= target) {
        number.textContent = target.toLocaleString();
      } else {
        number.textContent = current.toLocaleString();
        requestAnimationFrame(tick);
      }
    };

    tick();
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animate(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.4 });

  counters.forEach(counter => observer.observe(counter));
});
</script>