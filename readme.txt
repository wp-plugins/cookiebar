=== Plugin Name ===
Contributors: tox82
Donate link: http://cookie-bar.eu
Tags: cookie, law, cookielaw, cookiebar
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 1.5.3
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

= 1.5.3 =
* New: Added minified CSS and JS
* Bugfix: cookieLawStates should include GB not UK
* Bugfix: When hiding the cookieBar, margins are not correctly reset

= 1.5.2 =
* New: Added Hungarian translation
* New: Add support for German
* Bugfix: Fix prompt for no consent
* Bugfix: Minor fixes and improvements

= 1.5.1 =
* New: Geolocation - show the bar only in countries affected by the cookie law
* New: Specify which kind of cookies are in use (technical, third party, tracking cookies)
* New: The link to the complete privacy page should be in the main banner
* Bugfix: cookieBAR's cookie is now set at domain level

= 1.4.0 =
* Some new configuration options: always show and remember choice duration

= 1.3.0 =
* Added themes functionality and two more bundled themes

= 1.2 =
* Fixed a css bug that made the bar unreadable in some websites, some minor fixes

= 1.1.2 =
* Fixed a bug with Internet Explorer and custom privacy page

= 1.1 =
* Set your own privacy page, or use the default popup

= 1.0 =
* First working version
