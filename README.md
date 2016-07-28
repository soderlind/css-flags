[![Build Status](https://travis-ci.org/soderlind/css-flags.svg?branch=master)](https://travis-ci.org/soderlind/css-flags) [![Code Climate](https://codeclimate.com/github/soderlind/css-flags/badges/gpa.svg)](https://codeclimate.com/github/soderlind/css-flags)
# CSS Flags library for WordPress


The CSS Flags [plugin](#plugin) / [library](#theme) for WordPress loads a [dynamicly created CSS](https://github.com/soderlind/css-flags/blob/master/css-flags.php#L21-L39). It has responsive [SVG](http://en.wikipedia.org/wiki/Scalable_Vector_Graphics) flags for the following countries (country code in parentheses):

> Aaland (ax), Afghanistan (af), Albania (al), Algeria (dz), American Samoa (as), Andorra (ad), Angola (ao), Anguilla (ai), Antigua And Barbuda (ag), Argentina (ar), Armenia (am), Aruba (aw), Australia (au), Austria (at), Azerbaijan (az), Bahamas (bs), Bahrain (bh), Bangladesh (bd), Barbados (bb), Basque (basque), Belarus (by), Belgium (be), Belize (bz), Benin (bj), Bermuda (bm), Bhutan (bt), Bolivia (bo), Bosnia And Herzegovina (ba), Botswana (bw), Bouvet Island (bv), Brazil (br), British Indian Ocean Territory (io), British Virgin Islands (vg), Brunei (bn), Bulgaria (bg), Burkina Faso (bf), Burundi (bi), Cambodia (kh), Cameroon (cm), Canada (ca), Cape Verde (cv), Catalonia (catalonia), Cayman Islands (ky), Central African Republic (cf), Chad (td), Chile (cl), China (cn), Christmas Island (cx), Cocos Islands (cc), Colombia (co), Comoros (km), Congo (cg), Cook Islands (ck), Costa Rica (cr), Cote D\'ivoire (ci), Croatia (hr), Cuba (cu), Cyprus (cy), Czech Republic (cz), Democratic Republic Of Congo (cd), Denmark (dk), Djibouti (dj), Dominica (dm), Dominican Republic (do), East Timor (tm), Ecuador (ec), Egypt (eg), El Salvador (sv), England (england), Equatorial Guinea (gq), Eritrea (er), Estonia (ee), Ethiopia (et), Europe (eu), Falkland Islands (fk), Faroe Islands (fo), Federated States Of Micronesia (fm), Fiji (fj), Finland (fi), France (fr), French Guiana (gf), French Polynesia (pf), French Southern And Antarctic Lands (tf), Gabon (ga), Galicia (galicia), Gambia (gm), Georgia (ge), Germany (de), Ghana (gh), Gibraltar (gi), Greece (gr), Greenland (gl), Grenada (gd), Guadeloupe (gp), Guam (gu), Guatemala (gt), Guernsey (gg), Guinea (gn), Guinea-bissau (gw), Guyana (gy), Haiti (ht), Heard Island And Mcdonald Slands (hm), Honduras (hn), Hong Kong (hk), Hungary (hu), Iceland (is), India (in), Indonesia (id), Iran (ir), Iraq (iq), Ireland (ie), Isle Of Man (im), Israel (il), Italy (it), Jamaica (jm), Japan (jp), Jersey (je), Jordan (jo), Kazakhstan (kz), Kenya (ke), Kiribati (ki), Kuwait (kw), Kyrgyzstan (kg), Laos (la), Latvia (lv), Lebanon (lb), Lesotho (ls), Liberia (lr), Libya (ly), Liechtenstein (li), Lithuania (lt), Luxembourg (lu), Macau (mo), Macedonia (mk), Madagascar (mg), Malawi (mw), Malaysia (my), Maldives (mv), Mali (ml), Malta (mt), Marshall Islands (mh), Martinique (mq), Mauritania (mr), Mauritius (mu), Mayotte (yt), Mexico (mx), Moldova (md), Monaco (mc), Mongolia (mn), Montenegro (me), Montserrat (ms), Morocco (ma), Mozambique (mz), Myanmar (mm), Namibia (na), Nauru (nr), Nepal (np), Netherlands (nl), Netherlands Antilles (an), New Caledonia (nc), New Zealand (nz), Nicaragua (ni), Niger (ne), Nigeria (ng), Niue (nu), Norfolk Island (nf), North Korea (kp), Northern Mariana Islands (mp), Norway (no), Oman (om), Pakistan (pk), Palau (pw), Palestine (ps), Panama (pa), Papua New Guinea (pg), Paraguay (py), Peru (pe), Philippines (ph), Pitcairn Islands (pn), Poland (pl), Portugal (pt), Puerto Rico (pr), Qatar (qa), Republic Of China Taiwan (tw), Rainbow -  LGBT (rainbow), Reunion (re), Romania (ro), Russia (ru), Rwanda (rw), Saint Helena (sh), Saint Kitts And Nevis (kn), Saint Lucia (lc), Saint Martin (mf), Saint Vincent And Grenadines (vc), Saint-pierre And Miquelon (pm), Sami (sami), Samoa (ws), San Marino (sm), Sao Tome And Principe (st), Saudi Arabia (sa), Scotland (scotland), Senegal (sn), Serbia (rs), Serbia And Montenegro (cs), Seychelles (sc), Sierra Leone (sl), Singapore (sg), Slovakia (sk), Slovenia (si), Solomon Islands (sb), Somalia (so), South Africa (za), South Georgia And South Sandwich Islands (gs), South Korea (kr), Spain (es), Sri Lanka (lk), Sudan (sd), Suriname (sr), Svalbard And Jan Mayen (sj), Swaziland (sz), Sweden (se), Switzerland (ch), Syria (sy), Tajikistan (tj), Tanzania (tz), Thailand (th), Togo (tg), Tokelau (tk), Tonga (to), Trinidad And Tobago (tt), Tunisia (tn), Turkey (tr), Turkmenistan (tm), Turks And Caicos Islands (tc), Tuvalu (tv), Uganda (ug), Ukraine (ua), United Arab Emirates (ae), United Kingdom (gb), United States (us), United States Minor Outlying Islands (um), United States Virgin Islands (vi), Uruguay (uy), Uzbekistan (uz), Vanuatu (vu), Vatican City (va), Venezuela (ve), Vietnam (vn), Wales (wales), Wallis And Futuna (wf), Western Sahara (eh), Yemen (ye), Zambia (zm), Zimbabwe (zw)


You can view the flags [at my site](https://soderlind.no/css-flags-plugin-for-wordpress/)

## Usage

The total CSS file size is 4 MB, and you don't want to send all that data back to the users, so you **must** use one of the following filters in your plugin or theme.


**css-flags-countries**: Load flags for one or more countries
```php
add_filter('css-flags-countries', function() {
	return array('no'); // Array with ISO_3166-1_alpha-2 country codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
});
```

**css-flags-regions**: Load the flags for one or more regions. You can choose between europe, oceania, africa, asia, northamerica, southamerica and middleeast.
```php
add_filter('css-flags-regions', function() {
	return array('europe'); //europe, oceania, africa, asia, northamerica, southamerica, middleeast
});
```

**css-flags-exclude**: Exclude some countries from the list. This filter must be used in combination with the `css-flags-countries` or `css-flags-regions` filters
```php
add_filter('css-flags-exclude', function() {
	return array('eu');
});
```

**css-flags-cachetime**: Change the cache time, default it's 7200 (60x60x2 = 2 hours)
```php
add_filter('css-flags-cachetime', function() {
	return 172800; // 2 days
});
```

If you must (but you shouldn't), you can load all the  CSS flags using the following:
```php
add_filter('css-flags-countries', function() {
	return array('all'); // load all country flags (don't it's 4MB)
});
```

### Example 1


Using this filter in your (child) theme functions.php
```php
add_action( 'init', function() {
	add_filter('css-flags-countries', function() {
		return array('no');
	});
});
```
CSS Flags will add the following CSS (note the `.css-flag` prefix):
```css
/* CSS generated in 0.002 seconds. */
.css-flag.no {
	background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMTAwIDgwMCI+DQo8cGF0aCBmaWxsPSIjZWYyYjJkIiBkPSJtMCwwaDExMDB2ODAwaC0xMTAweiIvPg0KPGcgZmlsbD0iI2ZmZiI+DQo8cGF0aCBkPSJtMzAwLDBoMjAwdjgwMGgtMjAweiIvPg0KPHBhdGggZD0ibTAsMzAwaDExMDB2MjAwaC0xMTAweiIvPg0KPC9nPg0KPGcgZmlsbD0iIzAwMjg2OCI+DQo8cGF0aCBkPSJtMzUwLDBoMTAwdjgwMGgtMTAweiIvPg0KPHBhdGggZD0ibTAsMzUwaDExMDB2MTAwaC0xMTAweiIvPg0KPC9nPg0KPC9zdmc+DQo=');
	height: 100%;
	width: 137.5%;
	background-size: 100% 100%;
}
.css-flag.no-landscape {
	height: 100%;
	width: 137.5%;
}
.css-flag.no-portrait {
	height: 72.727272727273%;
	width: 100%;
}
```

I bet you can CSS and HTML better than me, but you could display the flag using this in your (child) theme:

```html

<style type="text/css">
	.box {
		width: 32%;
		/*float: left;*/
	}
	.flagbox {
		width: 120px;
		height: 120px;
		display: inline-block;
		vertical-align: middle;
	}
	.flag {
	    margin: auto;
		display: inline-block;
		vertical-align: middle;

		border: 1px solid #e5e5e5;
		box-shadow: inset 0px 0px 0px 2px #fff;

	}
</style>

<div class="box">
	<div class="flagbox"><span class="flag no no-portrait"></span></div>
</div>

```

### Example 2

Load the CSS Flags for the five Nordic countries and  their autonomous regions: Norway (no), Sweden (se), Denmark (dk), Findland (fi), Iceland (is), the Faroe Islands (fo), Greenland (gl) and Aaland (ax)
```php
add_action( 'init', function() {
	add_filter('css-flags-countries', function() {
		return array('no','se','dk','fi','is', 'fo', 'gl','ax'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
	});
});
```

Only load the Scandinavian flags ('no','se','dk') by removing flags from the loaded list
```php
add_action( 'init', function() {
	add_filter('css-flags-exclude', function() {
		return array('fi','is', 'fo', 'gl','ax'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
	});
});
```


## Installation

### Plugin

1. Download the latest stable release, [0.2.0](https://github.com/soderlind/css-flags/releases/tag/0.2.0)
1. Add and activate it. This will load the CSS (4 MB) and cache it using the [WordPress Transients API](https://codex.wordpress.org/Transients_API). The default cache time is 7200. The cache time can be changed using the  `css-flags-cachetime` filter.
1. Add one of the filters, [above](#usage), to your plugin or (child) themes functions.php


### Theme

1. In your (child) theme folder, clone the repo:

 	`git clone https://github.com/soderlind/css-flags.git`

1. Add the following to your (child) theme functions.php

	```php
	//load the CSS Flags library
	require_once(dirname(__FILE__) . '/css-flags/css-flags.php');
	```

1. Add one of the filters, [above](#usage), to your  (child) themes functions.php, eg:

	```php
	add_action( 'init', function() {
		add_filter('css-flags-countries', function() {
			return array('no','se','dk'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
		});
		// add_filter('css-flags-countries', function() {
		// 	return array('all'); // ISO_3166-1_alpha-2 codes: http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements
		// });
		// add_filter('css-flags-regions', function() {
		// 	return array('europe'); //europe, oceania, africa, asia, northamerica, southamerica, middleeast
		// });
		// add_filter('css-flags-exclude', function() {
		// 	return array('gb','se');
		// });
	});
	```

To get you started, here'a a [sample theme functions.php](sample-theme-functions.php)

## Changelog

See the [CHANGELOG.md](CHANGELOG.md)

## Credits

The original CSS file is from http://www.phoca.cz/cssflags/. If you only need the CSS file, grab it there.

##Copyright and License

CSS Flags plugin for WordPress is copyright 2015 Per Soderlind

CSS Flags plugin for WordPress is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

CSS Flags plugin for WordPress is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the [GNU General Public License](LICENSE.md) for more details.

You should have received a copy of the GNU Lesser General Public License along with the Extension. If not, see http://www.gnu.org/licenses/.
