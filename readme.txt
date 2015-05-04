=== Plugin Name ===
Contributors: tox82
Donate link: http://cookie-bar.eu
Tags: cookie, law, cookielaw, cookiebar
Requires at least: 3.0.1
Tested up to: 4.2.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


With EU cookie law, site owners need to make the use of cookies very obvious to visitors. cookieBAR does just that.


== Description ==

There is a lot of mystery and fuss surrounding the EU cookie legislation, but it's essentially really simple. Site owners need to make the use of cookies very obvious to visitors. cookieBAR makes it simple and clear to visitors that cookies are in use and tells them how to adjust browser settings if they are concerned.

cookieBAR is a drop-in and forget, pure vanilla javascript code, no jQuery or any other dependency needed. It shows up when needed and stay silent when not: If a website has some cookies or localStorage data set then the bar is shown, otherwhise nothing happens.

Once the user clicks 'Allow Cookies', cookieBAR will set a cookie for that domain with a name 'cookiebar' that will expire in 30 days. What this means is that the plugin will only show up once per domain (per month).

If a user decides to click "Disallow Cookies", cookieBAR will remove all the cookies and localStorage data (but it will show up again the first time a cookie is detected).

== Installation ==

1. Upload `cookiebar-wp.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the configuration panel to set your desired configurations

== Frequently Asked Questions ==

.

== Upgrade Notice ==

.

== Screenshots ==

1. The cookieBAR
2. Details panel

== Changelog ==

= 1.1 =
* Set your own privacy page, or use the default popup

= 1.0 =
* First working version
