WRACK
=====

Wrack is a framework that displays articles stored in folder structure.

Article metadata is stored in YAML files, articles themselves can use MarkDown, HTML or plain text (easy to add more formats).

All articles can have custom stylesheets, scripts, images, downloads etc.

## Info about WRACK

Key               | Value
----------------- | -------------------------------------------------
Author            | [Ondřej Hruška (MightyPork)](//ondrovo.com)
GitHub repository | [MightyPork/wrack](//github.com/MightyPork/wrack)
License           | MIT License


## What you can do with WRACK

Wrack is licensed under the permissive MIT license, so you can pretty much do anything you want with it, including commercial use.

Giving some credit to the author (eg. a note in footer) will be appreciated, but is not compulsory.


### How to customize & how it works

You most likely want to design your website yourself, and just use the article system. That's fairly easy, actually.

All logic is in the `/protected/app` folder. he views (Blade templates) can be found in `/protected/views`.

The source SCSS files for generating CSS are in `/dev/sass`, but you can of course just delete the `/dev` folder and make your own styles straight in `/public/css`.

If you decide to keep the original layout, fine. You can find some great header images here: [freewebheaders.com](//freewebheaders.com).

### How to install

1. In `/protected`, run `composer install`. If you don't have somposer installed, you can try `php composer.phar install`.
2. To seed the database, use `./phinx migrate` or `php phinx migrate`.

That's pretty much it.

The `/public` should be the public webroot, root folder accessible to the public, You **absolutely should not** expose the other folders - it will not only be insecure, but you'll also mess up the rewrite rules used in `/public/.htaccess`.


### File permissions

The system needs write access to some folders - namely:

- `/tmp` - used for caching and working with temporary files
- `/protected/db` (including any possible database in it) - used for storing metadata about articles.
  The database is used internally and automatically,. you don't need to worry about it. It holds info such as view counts, and helps with redirecting and linking (using the canonical names).


### File serving

Any files in the article are addressable from the article by relative paths. This include subfolders etc.

If you add `?dl=1` to the file name, you'll force download (useful for downloading eg. pdf documents).

Also, any files in the `/public` folder are directly available, unless you restrict them in the htaccess.

Note: *php scripts in articles section are NOT executed!*

The navigation system uses the folder structure in `/protected/articles` directly, so any changes should have immediate effect. You can experiment with nested groups, setting custom icons and headers, and so on. It's all easy YAML configuration.

See the example articles for reference.

If you have questions, feel free to contact me via email or twitter.
