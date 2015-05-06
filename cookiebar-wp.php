<?php
/*
Plugin Name: cookieBAR
Description: A fast and easy way to use a fast and easy cookie bar plugin
Version: 1.1.2
Author: Emanuele "ToX" Toscano
Author URI: http://emanuele.itoscano.com
Plugin URI: http://cookie-bar.eu
*/
defined('ABSPATH') or die('No script kiddies please!');

/*
* FRONTEND ACTIONS
*/
add_action('wp_enqueue_scripts', 'script_caller');
function script_caller()
{
    $params = "?1";
    $options = get_option('cookiebar_settings');


    if ($options['top']) {
        $params .= '&top=1';
    }
    if ($options['blocking']) {
        $params .= '&blocking=1';
    }
    if ($options['show_no_consent']) {
        $params .= '&showNoConsent=1';
    }
    if ($options['force_lang']) {
        $params .= '&forceLang=' . $options['force_lang'];
    }
    if ($options['privacy_page']) {
        $params .= '&privacyPage=' . $options['privacy_page'];
    }

    wp_enqueue_script(
        'cookieBAR',
        plugins_url('cookiebar-latest.js', __FILE__) . $params,
        array(),
        '1.0',
        false
    );
}

/*
* BACKEND ACTIONS
*/
add_action('admin_menu', 'cookiebar_add_admin_menu');
add_action('admin_init', 'cookiebar_settings_init');


function cookiebar_add_admin_menu()
{
    add_theme_page('cookieBAR', 'cookieBAR', 'manage_options', 'cookiebar', 'cookiebar_options_page');
}


function cookiebar_settings_init()
{
    register_setting('pluginPage', 'cookiebar_settings');

    add_settings_section(
        'cookiebar_pluginPage_section',
        __('cookieBAR configurations', 'wordpress'),
        'cookiebar_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'show_no_consent',
        __('Show "deny consent" button', 'wordpress'),
        'show_no_consent_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );

    add_settings_field(
        'blocking',
        __('Block page', 'wordpress'),
        'blocking_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );

    add_settings_field(
        'top',
        __('Show bar on top', 'wordpress'),
        'top_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );

    add_settings_field(
        'force_lang',
        __('Force a specific language', 'wordpress'),
        'force_lang_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );

    add_settings_field(
        'privacy_page',
        __('If you have a custom Privacy Page, type its address here', 'wordpress'),
        'privacy_page_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );
}


function show_no_consent_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <input type='checkbox' name='cookiebar_settings[show_no_consent]' <?php checked($options['show_no_consent'], 1); ?> value='1'>
    <?php
}


function blocking_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <input type='checkbox' name='cookiebar_settings[blocking]' <?php checked($options['blocking'], 1); ?> value='1'>
    <?php
}


function top_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <input type='checkbox' name='cookiebar_settings[top]' <?php checked($options['top'], 1); ?> value='1'>
    <?php
}


function force_lang_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <select name='cookiebar_settings[force_lang]'>
        <option value='' <?php selected($options['force_lang'], ""); ?>>Auto detect</option>
        <option value='en' <?php selected($options['force_lang'], "en"); ?>>English</option>
        <option value='it' <?php selected($options['force_lang'], "it"); ?>>Italian</option>
        <option value='fr' <?php selected($options['force_lang'], "fr"); ?>>French</option>
    </select>
    <?php
}


function privacy_page_render()
{
    $options = get_option('cookiebar_settings');
    echo "<input type='text' name='cookiebar_settings[privacy_page]' value='". $options['privacy_page'] ."'>";
}


function cookiebar_settings_section_callback()
{
    // Nothing to do here
}


function cookiebar_options_page()
{
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button();
        ?>
    </form>
    <?php
}
