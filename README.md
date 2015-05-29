# CSS Flags plugin for WordPress


The CSS Flags [plugin](#plugin) / [library](#theme) for WordPress loads a [dynamicly created CSS](https://github.com/soderlind/css-flags/blob/master/css-flags.php#L21-L39). It has responsive [SVG](http://en.wikipedia.org/wiki/Scalable_Vector_Graphics) flags for the following countries (country code in parentheses):

> Andorra (ad), United Arab Emirates (ae), Afghanistan (af), Antigua And Barbuda (ag), Anguilla (ai), Albania (al), Armenia (am), Netherlands Antilles (an), Angola (ao), Argentina (ar), American Samoa (as), Austria (at), Australia (au), Aruba (aw), Aaland (ax), Azerbaijan (az), Bosnia And Herzegovina (ba), Basque (basque), Barbados (bb), Bangladesh (bd), Belgium (be), Burkina Faso (bf), Bulgaria (bg), Bahrain (bh), Burundi (bi), Benin (bj), Bermuda (bm), Brunei (bn), Bolivia (bo), Brazil (br), Bahamas (bs), Bhutan (bt), Bouvet Island (bv), Botswana (bw), Belarus (by), Belize (bz), Canada (ca), Catalonia (catalonia), Cocos Islands (cc), Democratic Republic Of Congo (cd), Central African Republic (cf), Congo (cg), Switzerland (ch), Cote D\'ivoire (ci), Cook Islands (ck), Chile (cl), Cameroon (cm), China (cn), Colombia (co), Costa Rica (cr), Serbia And Montenegro (cs), Cuba (cu), Cape Verde (cv), Christmas Island (cx), Cyprus (cy), Czech Republic (cz), Germany (de), Djibouti (dj), Denmark (dk), Dominica (dm), Dominican Republic (do), Algeria (dz), Ecuador (ec), Estonia (ee), Egypt (eg), Western Sahara (eh), England (england), Eritrea (er), Spain (es), Ethiopia (et), Europe (eu), Finland (fi), Fiji (fj), Falkland Islands (fk), Federated States Of Micronesia (fm), Faroe Islands (fo), France (fr), Gabon (ga), Galicia (galicia), United Kingdom (gb), Grenada (gd), Georgia (ge), French Guiana (gf), Guernsey (gg), Ghana (gh), Gibraltar (gi), Greenland (gl), Gambia (gm), Guinea (gn), Guadeloupe (gp), Equatorial Guinea (gq), Greece (gr), South Georgia And South Sandwich Islands (gs), Guatemala (gt), Guam (gu), Guinea-bissau (gw), Guyana (gy), Hong Kong (hk), Heard Island And Mcdonald Slands (hm), Honduras (hn), Croatia (hr), Haiti (ht), Hungary (hu), Indonesia (id), Ireland (ie), Israel (il), Isle Of Man (im), India (in), British Indian Ocean Territory (io), Iraq (iq), Iran (ir), Iceland (is), Italy (it), Jersey (je), Jamaica (jm), Jordan (jo), Japan (jp), Kenya (ke), Kyrgyzstan (kg), Cambodia (kh), Kiribati (ki), Comoros (km), Saint Kitts And Nevis (kn), North Korea (kp), South Korea (kr), Kuwait (kw), Cayman Islands (ky), Kazakhstan (kz), Laos (la), Lebanon (lb), Saint Lucia (lc), Liechtenstein (li), Sri Lanka (lk), Liberia (lr), Lesotho (ls), Lithuania (lt), Luxembourg (lu), Latvia (lv), Libya (ly), Morocco (ma), Monaco (mc), Moldova (md), Montenegro (me), Saint Martin (mf), Madagascar (mg), Marshall Islands (mh), Macedonia (mk), Mali (ml), Myanmar (mm), Mongolia (mn), Macau (mo), Northern Mariana Islands (mp), Martinique (mq), Mauritania (mr), Montserrat (ms), Malta (mt), Mauritius (mu), Maldives (mv), Malawi (mw), Mexico (mx), Malaysia (my), Mozambique (mz), Namibia (na), New Caledonia (nc), Niger (ne), Norfolk Island (nf), Nigeria (ng), Nicaragua (ni), Netherlands (nl), Norway (no), Nepal (np), Nauru (nr), Niue (nu), New Zealand (nz), Oman (om), Panama (pa), Peru (pe), French Polynesia (pf), Papua New Guinea (pg), Philippines (ph), Pakistan (pk), Poland (pl), Saint-pierre And Miquelon (pm), Pitcairn Islands (pn), Puerto Rico (pr), Palestine (ps), Portugal (pt), Palau (pw), Paraguay (py), Qatar (qa), Reunion (re), Romania (ro), Serbia (rs), Russia (ru), Rwanda (rw), Saudi Arabia (sa), Sami (sami), Solomon Islands (sb), Seychelles (sc), Scotland (scotland), Sudan (sd), Sweden (se), Singapore (sg), Saint Helena (sh), Slovenia (si), Svalbard And Jan Mayen (sj), Slovakia (sk), Sierra Leone (sl), San Marino (sm), Senegal (sn), Somalia (so), Suriname (sr), Sao Tome And Principe (st), El Salvador (sv), Syria (sy), Swaziland (sz), Turks And Caicos Islands (tc), Chad (td), French Southern And Antarctic Lands (tf), Togo (tg), Thailand (th), Tajikistan (tj), Tokelau (tk), East Timor (tm), Turkmenistan (tm), Tunisia (tn), Tonga (to), Turkey (tr), Trinidad And Tobago (tt), Tuvalu (tv), Republic Of China Taiwan (tw), Tanzania (tz), Ukraine (ua), Uganda (ug), United States Minor Outlying Islands (um), United States (us), Uruguay (uy), Uzbekistan (uz), Vatican City (va), Saint Vincent And Grenadines (vc), Venezuela (ve), British Virgin Islands (vg), United States Virgin Islands (vi), Vietnam (vn), Vanuatu (vu), Wales (wales), Wallis And Futuna (wf), Samoa (ws), Yemen (ye), Mayotte (yt), South Africa (za), Zambia (zm), Zimbabwe (zw)



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
.css-flag .no {
	background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMTAwIDgwMCI+DQo8cGF0aCBmaWxsPSIjZWYyYjJkIiBkPSJtMCwwaDExMDB2ODAwaC0xMTAweiIvPg0KPGcgZmlsbD0iI2ZmZiI+DQo8cGF0aCBkPSJtMzAwLDBoMjAwdjgwMGgtMjAweiIvPg0KPHBhdGggZD0ibTAsMzAwaDExMDB2MjAwaC0xMTAweiIvPg0KPC9nPg0KPGcgZmlsbD0iIzAwMjg2OCI+DQo8cGF0aCBkPSJtMzUwLDBoMTAwdjgwMGgtMTAweiIvPg0KPHBhdGggZD0ibTAsMzUwaDExMDB2MTAwaC0xMTAweiIvPg0KPC9nPg0KPC9zdmc+DQo=');
	height: 100%;
	width: 137.5%;
	background-size: 100% 100%;
}
.css-flag .no-landscape {
	height: 100%;
	width: 137.5%;
}
.css-flag .no-portrait {
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

1. Download the latest stable release, [0.1.2](https://github.com/soderlind/css-flags/releases/tag/0.1.2)
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
