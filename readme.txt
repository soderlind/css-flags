=== CSS Flags library ===
Contributors: PerS
Donate link: http://soderlind.no/donate/
Tags: header, link
Requires at least: 4.0
Tested up to: 4.7
Stable tag: 0.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

More than 250 vector based flags for WordPress

== Description ==

The CSS Flags plugin / library for WordPress loads a dynamicaly created CSS with responsive flags.

**Note:** CSS Flags is not a standalone plugin/library, To display the flags you will have to [add code to your theme](https://github.com/soderlind/css-flags/#example-1) using your own plugin or theme functions.php

You can [view the flags at my site](https://soderlind.no/css-flags-plugin-for-wordpress/)

Sample CSS:
`
.css-flag.sami {
	background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIHZlcnNpb249IjEuMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjAyMCIgaGVpZ2h0PSIxNTAwIj48cmVjdCB3aWR0aD0iNjQ1IiBoZWlnaHQ9IjE1MDAiIGZpbGw9IiNkODFlMDUiLz48cmVjdCB4PSI2NDUiIHdpZHRoPSIxNDAiIGhlaWdodD0iMTUwMCIgZmlsbD0iIzAwN2EzZCIvPjxyZWN0IHg9Ijc4NSIgd2lkdGg9IjE0MCIgaGVpZ2h0PSIxNTAwIiBmaWxsPSIjZmNkMTE2Ii8+PHJlY3QgeD0iOTI1IiB3aWR0aD0iMTA5NSIgaGVpZ2h0PSIxNTAwIiBmaWxsPSIjMDAzOGE4Ii8+PHBhdGggZD0iTSA3ODUsMzEwIGEgNDQwIDQ0MCAwIDAgMCAwLDg4MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDAzOGE4IiBzdHJva2Utd2lkdGg9IjgwIi8+PHBhdGggZD0iTSA3ODUsMzEwIGEgNDQwIDQ0MCAwIDAgMSAwLDg4MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZDgxZTA1IiBzdHJva2Utd2lkdGg9IjgwIi8+PC9zdmc+');
	height: 100%;
	width: 134.666666667%;
	background-size: 100% 100%;
}
.css-flag.sami-landscape {
	height: 100%;
	width: 134.666666667%;
}
.css-flag.sami-portrait {
	height: 74.2574257426%;
	width: 100%;
}

`

= Usage =

The total CSS file size is 4 MB, and you don't want to send all that data back to the users, so you **must** use one of the following filters in your plugin or theme.


**css_flags_countries**: Load flags for one or more countries
`
add_filter('css_flags_countries', function() {
	return array('no'); // Array with ISO_3166-1_alpha-2 country codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
});
`

**css_flags_regions**: Load the flags for one or more regions. You can choose between europe, oceania, africa, asia, northamerica, southamerica and middleeast.
`
add_filter('css_flags_regions', function() {
	return array('europe'); //europe, oceania, africa, asia, northamerica, southamerica, middleeast
});
`

**css_flags_exclude**: Exclude some countries from the list. This filter must be used in combination with the `css_flags_countries` or `css_flags_regions` filters
`
add_filter('css_flags_exclude', function() {
	return array('eu');
});
`

**css_flags_cachetime**: Change the cache time, default it's 7200 (60x60x2 = 2 hours)
`
add_filter('css_flags_cachetime', function() {
	return 172800; // 2 days
});
`

If you must (but you shouldn't), you can load all the  CSS flags using the following:
`
add_filter('css_flags_countries', function() {
	return array('all'); // load all country flags (don't it's 4MB)
});
`

More information at [GitHub](https://github.com/soderlind/css-flags/)


= Credits =

The original CSS file is from http://www.phoca.cz/cssflags/. If you only need the CSS file, grab it there.


== Installation ==

= Plugin =

1. Download the latest stable release
1. Add and activate it. This will load the CSS (4 MB) and cache it using the [WordPress Transients API](https://codex.wordpress.org/Transients_API). The default cache time is 7200. The cache time can be changed using the  `css_flags_cachetime` filter.
1. Add one of the filters, see **Usage** above, to your plugin or (child) themes functions.php


= Theme =

1. Extract the plugin in your (child) theme folder:
1. Add the following to your (child) theme functions.php

	`require_once(dirname(__FILE__) . '/css-flags/css-flags.php');`

1. Add one of the filters, see **Usage** above, to your  (child) themes functions.php


To get you started, here'a a [sample theme functions.php](https://github.com/soderlind/css-flags/blob/master/sample-theme-functions.php)


== Changelog ==
= 0.3.0 =
* **NOTE** You need to update your code, all filters have changed (changed dash to underscrore): `css_flags_countries`, `css_flags_regions`, `css_flags_exclude` and `css_flags_cachetime`.
= 0.2.2 =
* Tested & found compatible with WP 4.7.

= 0.2.1 =
* Tested & found compatible with WP 4.6.

= 0.2.0 =
* Update plugin to WordPress Coding Standards.

= 0.1.8 =
* Added uninstall.php, which removes transients and options when you uninstall the plugin

= 0.1.4 =
* Added the [Rainbow (LGBT)](https://soderlind.no/css-flags-plugin-for-wordpress/#rainbow) flag

= 0.1.3 =
* Rewrote the plugin

= 0.1.2 =
* Added the [Sami](https://soderlind.no/css-flags-plugin-for-wordpress/#sami) flag

= 0.1.1 =
* Added CSS prefix .css-flag

= 0.1.0 =
* Initial release
