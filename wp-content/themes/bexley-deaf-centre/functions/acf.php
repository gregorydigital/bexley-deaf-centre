<?php

    // Register ACF blocks
    function register_acf_blocks() {
        $blocks_dir = get_template_directory() . "/template-parts/blocks";
        $scan = scandir($blocks_dir);

        foreach ($scan as $file) {
            if (is_dir($blocks_dir . "/" . $file) && strpos($file, ".") === false) {
                register_block_type($blocks_dir . "/" . $file);
            }
        }
    }
    add_action("init", "register_acf_blocks");

    // Customize which blocks and patterns are allowed globally (minimal for patterns?)
    add_filter("allowed_block_types_all", function($allowed_blocks, $editor_context) {
        $customBlocks = [];
        $blocks_dir = get_template_directory() . "/template-parts/blocks";
        $scan = scandir($blocks_dir);

        // Collect all custom ACF blocks
        foreach ($scan as $file) {
            if (is_dir($blocks_dir . "/" . $file) && strpos($file, ".") === false) {
                $customBlocks[] = "acf/" . $file;
            }
        }

        // Array of core blocks to always allow (including reusable blocks)
        $alwaysAllowedCoreBlocks = [
            'core/block', // Reusable Blocks
            'core/heading',
            'core/image',
            'core/list',
            'core/list-item',
            'core/paragraph',
            'core/table',
            'core/video',
            'core/quote',
            'core/separator',
        ];

        // Check the post type
        if ($editor_context->post && ($editor_context->post->post_type === 'blog' || $editor_context->post->post_type === 'insight' || $editor_context->post->post_type === 'customer')) {
            // For 'resource' and 'news' post types, allow only specified core blocks
            $allowed_blocks = $alwaysAllowedCoreBlocks;
        } else {
            // For all other post types, allow only custom blocks and reusable blocks
            $allowed_blocks = array_merge($customBlocks, ['core/block']);
        }

        return $allowed_blocks;
    }, 10, 2);


    // Add custom block category
    add_filter("block_categories_all", function($categories, $editor_context) {
        if (!empty($editor_context->post)) {
            // Add custom block category to the top
            array_unshift($categories, [
                "slug" => "custom-block",
                "title" => __("Custom Blocks", "custom-block"),
                "icon" => null,
            ]);
        }
        return $categories;
    }, 10, 2);

    add_filter('forminator_field_markup', function($html, $field, $form) {
        $target_form_id = 327;         // Your form ID
        $target_elem_id = 'select-1';   // The Forminator select field you're replacing
    
        if ((int)$form->model->id === $target_form_id && $field['element_id'] === $target_elem_id) {
            $today = date('Ymd');
            $options_html = '<option value="">Please select a course…</option>';
    
            if (have_rows('bsl_courses', 'option')) {
                while (have_rows('bsl_courses', 'option')) {
                    the_row();
                    $level    = get_sub_field('course_level');
                    $date_raw = get_sub_field('start_date');
    
                    // Normalise date
                    if (preg_match('/^\d{8}$/', $date_raw)) {
                        $date_obj = DateTime::createFromFormat('Ymd', $date_raw);
                        $date_val = $date_raw;
                    } else {
                        $date_obj = DateTime::createFromFormat('d/m/Y', $date_raw);
                        $date_val = $date_obj ? $date_obj->format('Ymd') : '';
                    }
    
                    // Only future courses
                    if ($date_val && $date_val >= $today) {
                        $label = sprintf('%s - %s', $date_obj->format('j M Y'), $level);
                        $options_html .= sprintf(
                            '<option value="%s">%s</option>',
                            esc_attr($label),
                            esc_html($label)
                        );
                    }
                }
            }
    
            // Render standalone dropdown
            $html .= '<select id="acf-course-select" class="acf-course-select">';
            $html .= $options_html;
            $html .= '</select>';
        }
    
        return $html;
    }, 15, 3);

    add_filter('acf/load_field/name=forminator_form_id', function ($field) {
        if (class_exists('Forminator_API')) {
            $forms = Forminator_API::get_forms();
            if (!empty($forms)) {
                $field['choices'] = [];
                foreach ($forms as $form) {
                    $field['choices'][$form->id] = $form->name . ' (ID: ' . $form->id . ')';
                }
            }
        }
        return $field;
    });