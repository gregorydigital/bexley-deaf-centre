<?php 
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('link');
    $bg_color = get_field('background_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img style='max-width:100%;height:auto;' src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/ /_preview.png' ); ?>'>

<?php else: ?>

    <section class='course-list padded-mid bg-<?php echo esc_html($bg_color)?>'>
        <div class='container'>
            <div class="course-list__content">
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
            </div>
            <div class='course-list__inner'>
            <?php 
            
            $selected_level = get_field('course_level_filter'); // e.g. "BSL Level 1" or "All"

            // Get today's date in Ymd format for comparison
            $today = date('Ymd');

            // Get courses repeater from ACF Options page
            if (have_rows('bsl_courses', 'option')):

                $courses = [];

                while (have_rows('bsl_courses', 'option')): the_row();

                    $course_level = get_sub_field('course_level');
                    $location     = get_sub_field('location');
                    $price        = get_sub_field('price');
                    $start_date   = get_sub_field('start_date');
                    $duration     = get_sub_field('duration');

                    // Format dates for comparison
                    $course_date_raw = DateTime::createFromFormat('d/m/Y', $start_date);
                    $course_date     = $course_date_raw ? $course_date_raw->format('Ymd') : '';

                    // Only include future courses
                    if ($course_date >= $today) {
                        // Filter by selected level (or allow all)
                        if ($selected_level === 'All' || $selected_level === $course_level) {
                            $courses[] = [
                                'level'     => $course_level,
                                'location'  => $location,
                                'price'     => $price,
                                'date'      => $course_date_raw,
                                'duration'  => $duration
                            ];
                        }
                    }

                endwhile;

                // Sort by start date ascending
                usort($courses, function($a, $b) {
                    return $a['date'] <=> $b['date'];
                });

                if ($courses):
                    foreach ($courses as $course): ?>

                        <?php
                        // Map level text to correct ACF field name
                        $image_field = '';
                        switch ( strtolower($course['level']) ) {
                            case 'bsl level 1':
                                $image_field = 'bsl_level_1_image';
                                break;
                            case 'bsl level 2':
                                $image_field = 'bsl_level_2_image';
                                break;
                            case 'bsl level 3':
                                $image_field = 'bsl_level_3_image';
                                break;
                        }
                    
                        // Get image from Options page
                        $image = $image_field ? get_field($image_field, 'option') : null;
                        ?>
                    
                        <div class="course-list__card">
                            <?php if (!empty($image)) : ?>
                                <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                            <?php endif; ?>
                    
                            <div class="course-info">
                                <div class="course-date">
                                    <span class="day"><?php echo $course['date']->format('j'); ?></span>
                                    <span class="month"><?php echo $course['date']->format('M'); ?></span>
                                </div>
                                <div class="course-details">
                                    <div class="course-details-top">
                                        <h3><?php echo esc_html($course['level']); ?></h3>
                                        <p><?php echo esc_html($course['duration']); ?></p>
                                    </div>
                                    <div class="course-details-bottom">
                                        <div class="location">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" viewBox="0 0 512 512"><path fill="var(--ci-primary-color, #000000)" d="M253.924 127.592a64 64 0 1 0 64 64 64.073 64.073 0 0 0-64-64Zm0 96a32 32 0 1 1 32-32 32.037 32.037 0 0 1-32 32Z" class="ci-primary"/><path fill="var(--ci-primary-color, #000000)" d="M376.906 68.515A173.922 173.922 0 0 0 108.2 286.426l120.907 185.613a29.619 29.619 0 0 0 49.635 0l120.911-185.613a173.921 173.921 0 0 0-22.747-217.911Zm-4.065 200.444-118.916 182.55-118.917-182.55c-36.4-55.879-28.593-130.659 18.563-177.817a141.92 141.92 0 0 1 200.708 0c47.156 47.158 54.962 121.938 18.562 177.817Z" class="ci-primary"/></svg>
                                            <p><?php echo esc_html($course['location']); ?></p>
                                        </div>
                                        <p class="price"><?php echo esc_html($course['price']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <?php endforeach;
                endif;
            endif; ?>
            </div>
            <div class="course_list__link">
                <?php if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class='btn' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>