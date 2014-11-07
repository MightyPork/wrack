/protected
==========

This folder holds application code and data.

It is not directly accessible from the web.

All articles live in the `articles` folder.

Howto
-----

To update `/vendor`, simply run `composer install` or `composer update`.

To migrate, use `./phinx migrate -e production` (or development for testing database).
