</main>

<?php 
    $footer_logo = get_field('footer_logo', 'options');
    $company = get_field('company_name', 'options');
    $charity_no = get_field('charity_no', 'options');
    $phone = get_field('phone_number', 'options');
    $email = get_field('email_address', 'options');
    $address = get_field('address', 'options');
    $footer_1_title = get_field('footer_menu_title', 'options');
    $footer_2_title = get_field('footer_menu_2_title', 'options');
    $footer_3_title = get_field('footer_menu_3_title', 'options');
?>

<footer class="footer padded-mid">
	<div class="container">
        <div class="footer__inner">
            <div class="footer-contact">
                <?php if (!empty($footer_logo)) : ?>
                    <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt'] ?? ''); ?>" />
                <?php endif; ?>
                <?php if(!empty($phone)): ?>
                    <a href="tel:<?php echo esc_html($phone) ?>" target="_blank">
                        <p><?php echo esc_html($phone); ?></p>
                    </a>
                <?php endif; ?>
                <?php if(!empty($email)): ?>
                    <a href="mailto:<?php echo esc_html($email); ?>" target="_blank">
                        <p><?php echo esc_html($email); ?></p>
                    </a>
                <?php endif; ?>
                <?php if(!empty($address)): ?>
                    <?php echo wp_kses_post($address); ?>
                <?php endif; ?>
                <?php if(!empty($charity_no)): ?>
                    <p class="charity-number"><?php echo wp_kses_post($charity_no); ?></p>
                <?php endif; ?>
            </div>
            <div class="footer-menu">
                <?php if(!empty($footer_1_title)): ?>
                    <h4><?php echo esc_html($footer_1_title); ?></h4>
                <?php endif; ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                    'container'      => false,
                    'menu_class'     => 'footer-nav',
                    ) ); 
                ?> 
            </div>
            <div class="footer-menu-2">
                <?php if(!empty($footer_2_title)): ?>
                    <h4><?php echo esc_html($footer_2_title); ?></h4>
                <?php endif; ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer_menu_2',
                    'container'      => false,
                    'menu_class'     => 'fo0ter-nav',
                    ) ); 
                ?> 
            </div>
            <div class="footer-legal">
                <?php if(!empty($footer_3_title)): ?>
                    <h4><?php echo esc_html($footer_3_title); ?></h4>
                <?php endif; ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'legal_menu',
                    'container'      => false,
                    'menu_class'     => 'legal-nav',
                    ) ); 
                ?> 
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-inner">
                <div class="websie-copyright">
                    <p>Copyright © <?php echo date("Y"); ?> <?php echo esc_html($company) ?></p>
                </div>
                <div>
                    <p>Website by <a href="https://gregorydigital.co.uk" target="_blank">Gregory Digital</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="pg-lightbox" id="pgLightbox" aria-hidden="true" role="dialog" aria-modal="true">
    <button class="pg-lightbox__close" aria-label="Close">&times;</button>
    <button class="pg-lightbox__nav pg-lightbox__prev" aria-label="Previous">&#10094;</button>
    <figure class="pg-lightbox__figure">
        <img id="pgLightboxImg" src="" alt="" />
        <figcaption id="pgLightboxCaption"></figcaption>
    </figure>
    <button class="pg-lightbox__nav pg-lightbox__next" aria-label="Next">&#10095;</button>
    <div class="pg-lightbox__backdrop"></div>
</div>
<?php wp_footer(); ?>    
</body>
</html>