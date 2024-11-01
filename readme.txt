=== UndaSecure ===
Tags: secure, optimization, htaccess protection, uploads folder protection, undasecure, undanet
Requires at least: 4.0
Tested up to: 4.9.5
Stable tag: 1.2.16
License: GPLv3 or later

Adds secure optimizations to .htaccess file

== Description ==

This plugins adds markers in /.htaccess and /wp-content/uploads/.htaccess to secure against attacks and optimize Apache configurations for SEO propouses.

Sets protection in ROOT/.htaccess for wp-config.php, .htaccess, xmlrpc.php, wp-cron.php.
Sets block author scans in ROOT/.htaccess.

Sets GZIP/DEFLATE in ROOT/.htaccess.
Sets Header add Access-Control-Allow-Origin in ROOT/.htaccess.
Sets ExpiresActive in ROOT/.htaccess.
Sets Header unset Etag in ROOT/.htaccess.

Create or add to /wp-content/uploads/.htaccess protection for files only.

Removes files on each WP update to prevent exposing WP version number (readme.html, wp-config-sample.php, license.txt).

== Changelog ==

= 1.2.15 =
added new banned extensions in uploaded files

= 1.2.14 =
Added mp3 to secure uploaded files

= 1.2.13 =
Added protection for wp-cron.php. Added "remove_query_arg" to JS and CSS files

= 1.2.12 =
Removes 'wp-config-sample.php' and 'license.txt' on each WP update.

= 1.2.11 =
Removes 'readme.html' on each WP update.

= 1.2.10 =
Improved Update Hook

= 1.2.9 =
Added Update Hook

= 1.2.8 =
Define global vars to locate include files

= 1.2.7 =
Deny PHP file execution on wp-content/uploads

= 1.2.6 =
Files renamed and deleted

= 1.2.5 =
Include files moved to subfolders.