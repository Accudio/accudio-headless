# Accudio Headless

[![GitHub](https://img.shields.io/badge/GitHub-Accudio-0366d6.svg)](https://github.com/Accudio) [![Twitter](https://img.shields.io/badge/Twitter-@accudio-1DA1F2.svg)](https://twitter.com/accudio) [![Website](https://img.shields.io/badge/Website-alistairshepherd.uk-4B86AF.svg)](https://alistairshepherd.uk) [![Donate](https://img.shields.io/badge/Donate-Paypal-009cde.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=alistair.shepherd@hotmail.co.uk&item_name=Supporting+open+source+projects+by+Alistair+Shepherd&currency_code=GBP)

[WordPress][wordpressurl] plugin including common tweaks useful for a Headless WordPress install. Works well with Accudio Headless WP Menus and Accudio Headless WP Theme. Includes WP API Yoast Meta plugin in it's original form.

## Features
- Registers nav menus
- Adds ACF Options page
- Returns null if ACF value is returned as empty, fixes issues with GraphQL frontend.
- Changes excerpt to '...'
- Hides a page entirely from wp-admin when user does not have manage_options capability. (useful when using ACF and a GraphQL-based frontend, allowing you to more easily request fields even when empty)
- Adds additional API endpoint for common options and for ACF options

## Requirements

A working installation of [Wordpress][wordpressurl], v1.0.0 of the plugin has been tested with Version 5.2.4 but should work on many versions. Built for use with PHP 7.0 onwards, 5.6 although untested should work.

## Installation

1. Download the latest release zip file or clone repository;
2. Place in /wp-content/plugins/ directory;
3. Log in to Wordpress administration page:
  1. Go to 'Plugins';
  2. Enable plugin 'Accudio Headless';

## Version History

- v1.0.0 - Plugin completed and moved from testing

## License

Copyright &copy; 2019 [Alistair Shepherd][accudiourl]. Licensed under the [GPL-3.0 License][licenseurl].

[wordpressurl]:https://wordpress.org
[accudiourl]:https://accudio.com
[licenseurl]:http://www.gnu.org/licenses/gpl-3.0.txt