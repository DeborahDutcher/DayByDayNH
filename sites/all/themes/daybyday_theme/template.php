<?php

/* REMOVE BEFORE PRODUCTION */
// Rebuild .info data.
system_rebuild_theme_data();
// Rebuild theme registry.
drupal_theme_rebuild();
/* END */

function daybyday_theme_preprocess_html(&$variables, $hook) {
    $month_names = array('January','February','March','April','May','June','July','August','September','October','November','December');
    $month_search = array_map('strtolower', $month_names);
    $month_path = '';
    $path_array = explode('/', $_SERVER['REQUEST_URI']);
    $month_path = strtolower($path_array[1]);

    if( in_array($month_path, $month_search) ) {
        $css_name = 'custom-'. $month_path. '.css';
    } else {
        date_default_timezone_set('America/New_York');
        $current_month = strtolower(date('F'));

        $css_name = 'custom-'. $current_month. '.css';
    }

    $variables['css_name'] = $css_name;
}
