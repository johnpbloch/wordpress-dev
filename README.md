# WordPress Dev

A library containing my standard development resources

### Requirements

```
PHP 5.4 or higher
WordPress 4.0.1
```

The required PHP version will always be the oldest major release that has not
received its end-of-life announcement.

The required WordPress version will always be the most recent point release of
the previous major release branch.

For both PHP and WordPress requirements, although this library may work with a
version below the required versions, they will not be supported and any
compatibility is entirely coincidental.

### Installation

To install this library, use Composer:

```
composer require johnpbloch/wordpress-dev:*
```

I don't recommend bundling this library for distribution with a plugin or theme,
but it's MIT code, so you can certainly do that if you wish. If you *really*
want to do that, I still suggest you install it in the plugin or theme using
Composer and just commit the relevant files from the `vendor` directory, and
then take advantage of the autoloading that Composer affords you. This will at
least mitigate the risk of name collisions should two modules be using this
library (although it won't prevent the inevitable bugs that come from two
codebases potentially trying to use different versions of the same library...).

### Usage

Take a look around the `examples` directory and browse the source code in `src`
for some examples of how to use these classes.

### License

This code is distributed under the MIT license. See [LICENSE.md](LICENSE.md)
for more details.
