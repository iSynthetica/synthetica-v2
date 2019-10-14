<?php

function snth_settings_sidebars($sidebars) {
    return array(
        array(
            'id' => 'footer1',
            'name' => __('Footer 1', 'snthwp'),
            'description' => __('The first footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600">',
            'after_title' => '</div>',
        ),
        array(
            'id' => 'footer2',
            'name' => __('Footer 2', 'snthwp'),
            'description' => __('The second footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600">',
            'after_title' => '</div>',
        ),
        array(
            'id' => 'footer3',
            'name' => __('Footer 3', 'snthwp'),
            'description' => __('The third footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600">',
            'after_title' => '</div>',
        ),
        array(
            'id' => 'footer4',
            'name' => __('Footer 4', 'snthwp'),
            'description' => __('The fourth footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600">',
            'after_title' => '</div>',
        ),
        array(
            'id' => 'blog-sidebar',
            'name' => __('Blog Sidebar', 'snthwp'),
            'description' => __('Blog sidebar.', 'snthwp'),
            'before_widget' => '<hr><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        )
    );
}
add_filter( 'snth_sidebars', 'snth_settings_sidebars', 999 );

function snth_settings_shortcodes($shortcodes) {
    return array(
        array(
            'id' => 'snth_widget_additional_links',
            'callback' => 'snth_widget_additional_links',
        ),
        array(
            'id' => 'snth_widget_contact_info',
            'callback' => 'snth_widget_contact_info',
        ),
        array(
            'id' => 'snth_widget_instagram',
            'callback' => 'snth_widget_instagram',
        ),
    );
}
add_filter('snth_shortcodes', 'snth_settings_shortcodes', 999);
