<?php
/*
Plugin Name: cookieBAR
Description: A fast and easy way to use a fast and easy cookie bar plugin
Version: 1.5.3
Author: Emanuele "ToX" Toscano
Author URI: http://emanuele.itoscano.com
Plugin URI: http://cookie-bar.eu
*/
defined('ABSPATH') or die('No script kiddies please!');
$plugin = plugin_basename(__FILE__);

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
    if ($options['thirdparty']) {
        $params .= '&thirdparty=1';
    }
    if ($options['tracking']) {
        $params .= '&tracking=1';
    }
    if ($options['force_lang']) {
        $params .= '&forceLang=' . $options['force_lang'];
    }
    if ($options['privacy_page']) {
        $params .= '&privacyPage=' . $options['privacy_page'];
    }
    if ($options['theme']) {
        $params .= '&theme=' . $options['theme'];
    }
    if ($options['remember']) {
        $params .= '&remember=' . $options['remember'];
    }

    wp_enqueue_script(
        'cookieBAR',
        plugins_url('cookiebar-latest.min.js', __FILE__) . $params,
        array(),
        '1.5.3',
        false
    );
}

/*
* BACKEND ACTIONS
*/
add_action('admin_menu', 'cookiebar_add_admin_menu');
add_action('admin_init', 'cookiebar_settings_init');
add_filter("plugin_action_links_$plugin", 'plugin_settings_link');

function plugin_settings_link($links)
{
    $settings_link = '<a href="themes.php?page=cookiebar">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}


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
        'theme',
        __('Theme', 'wordpress'),
        'theme_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );

    add_settings_field(
        'remember',
        __('Remember choice cookie duration (days) - default 30', 'wordpress'),
        'remember_render',
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

    add_settings_field(
        'tracking',
        __('This website makes use of tracking cookies', 'wordpress'),
        'tracking_render',
        'pluginPage',
        'cookiebar_pluginPage_section'
    );

    add_settings_field(
        'thirdparty',
        __('This website makes use of third party cookies', 'wordpress'),
        'thirdparty_render',
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


function theme_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <select name='cookiebar_settings[theme]'>
        <option value='' <?php selected($options['theme'], ""); ?>>Black (default)</option>
        <option value='grey' <?php selected($options['theme'], "grey"); ?>>Plain grey</option>
        <option value='white' <?php selected($options['theme'], "white"); ?>>Thick white</option>
    </select>
    <?php
}


function remember_render()
{
    $options = get_option('cookiebar_settings');
    echo "<input type='text' name='cookiebar_settings[remember]' value='". $options['remember'] ."'>";
}


function privacy_page_render()
{
    $options = get_option('cookiebar_settings');
    echo "<input type='text' name='cookiebar_settings[privacy_page]' value='". $options['privacy_page'] ."'>";
}


function thirdparty_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <input type='checkbox' name='cookiebar_settings[thirdparty]' <?php checked($options['thirdparty'], 1); ?> value='1'>
    <?php
}


function tracking_render()
{
    $options = get_option('cookiebar_settings');
    ?>
    <input type='checkbox' name='cookiebar_settings[tracking]' <?php checked($options['tracking'], 1); ?> value='1'>
    <?php
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

    <br><br>

    I hope that you will try and enjoy cookieBAR as much as I did writing it.<br>
    If cookieBAR has been useful to you, please consider to make a small donation as a token of your appreciation and to help me to keep this up :)
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
    ">
    <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
    <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
    </form>

    If you prefere Bitcoins, you can make a donation to: <strong>3JmwvrV2mQk13TZ3NDigqMJCUu14bnxNF4</strong>

    <?php
}
