# BEA - Find Media

If you want to see which media is used, or not, and where ? This plugin is for you.
By installing this plugin you will index where your media are used and display further informations.

== BANNIERE ==

# How ?

# Requirements

- [WordPress](https://wordpress.org/) 4.7+
- Tested up to 4.9.1.
- **PHP 7.0** is required !!

# Installation

At plugin activation, a single cron will be added in order to index your contents. It generally takes 10-15 min to begin.

At plugin deactivation, all blog's data are **deleted** to ensure to not weighing the DB and clean reindexation if reactivated.

## WordPress

- Download and install using the built-in WordPress plugin installer.
- Site Activate in the "Plugins" area of the admin.
- Optionally drop the entire `bea-find-media` directory into mu-plugins.
- Nothing more, this plugin is ready to use !

## Composer

- Add repository source : `{ "type": "vcs", "url": "https://github.com/BeAPI/bea-find-media" }`.
- Include `"bea/bea-find-media": "dev-master" in your composer file for last master's commits or a tag released.
- Nothing more, this plugin is ready to use !

# What ?

## Features 

For now the supported contents for indexation are post types by focusing on :

- Post content ( gallery, image, links )
- Post thumbnail
- [Advanced Custom Fields](https://fr.wordpress.org/plugins/advanced-custom-fields/)

### 1 - Single media view

Display where it's used or redirect to the corresponding view

### 2 - Site view

Display all occurences of media use for ACF, post_thumbnail, post_content.

### 3 - [CSF] Emmiter view

Display all blog's where synced media are used

### 4 - Prompt on delete

## More features to come

As you can see, some [issues](https://github.com/BeAPI/bea-find-media/issues?q=is%3Aissue+is%3Aopen+label%3Aquestion) are feature requests :
- More fields support (excerpt, post meta, etc)
- More type of support (widget, etc)
- More support (polylang, -wpml-, etc)
- Media expiration
- Find unused media
- Media replacement

## Issues and features request

If you identify any errors or have an idea for improving the plugin, feel free to open an [issue](https://github.com/BeAPI/bea-find-media/issues/new).

## Languages

This plugin is translated into the following languages :
- English
- French
- More to come

# For developers

## WP-Cli

### Force indexation

[WP-CLi](http://wp-cli.org) has been implemented to execute, only on the given site, an indexation of all retrieved from all contents supported.

`wp bea_find_media index_site` and optionally on a multisite `wp bea_find_media index_site --url={url}`.

## REST Api

The [REST Api](https://developer.wordpress.org/rest-api/) has been used to display the number of usage for an attachment. The route `exemple.com/wp-json/wp/v2/media/{id}/` will return a custom field called `bea_find_media_counter` which represents how many times it has been used into supported contents.

## JSON API

WordPress is working a lot with the JSON API, that's why why the `bea_find_media_counter` attribute has been added into attachment's JSON responses.

# Who ?

Created by [Be API](https://beapi.fr/), the French WordPress leader Agency. Based in Paris, we are more than 30 people and always [hiring](https://beapi.workable.com/) some fun and talented guys. So we will be pleased to work with you.

Maintained by [Maxime CULEA](https://maximeculea.fr).

## License

BEA - Find Media is licensed under the [GPLv3 or later](https://github.com/BeAPI/bea-find-media/blob/master/LICENSE.md).

# Changelog ##

## 1.0.0 - 7 Dec 2017
* First version of the plugin.
* Add screenshots.
* Add usages to REST Api and WP Json.
* Add wp-cli.
* Add plugin's .pot.
* Add French translation (po/mo).
* Add composer.json !
* Display usages to media archive / single.
* Prompt warnings for media delete.
* Create plugin with table and indexation.
* Init plugin.
