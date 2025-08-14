<?php

add_action('wp_enqueue_scripts', 'assets_enqueue');

function assets_enqueue()
{

    wp_deregister_script('jQuery');
    wp_register_script('jQuery', mix('js/jquery.js'), false, null, true);
    wp_enqueue_script('jQuery');

    wp_enqueue_style('app', mix('css/app.css'));


    wp_enqueue_script('app-js', mix('js/app.js'), array('jQuery'), null, true);

}

