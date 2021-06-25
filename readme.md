[![](https://img.shields.io/github/workflow/status/johnbillion/args/PHP%20Standards/trunk?style=flat-square)](https://github.com/johnbillion/args/actions)

# Args

Many functions and methods in WordPress accept arguments as an associative array. Your IDE or text editor cannot provide autocompletion and type hinting for each element in the array like it does for individual function parameters.

```php
$query = new WP_Query( [
	'post_type' => 'post',
	'category_something' => 'does this accept an integer or a string?',
	'number_of_...errr'
] );
```

This library provides well-documented classes which represent some of the associative array parameters that are used in WordPress. Using these classes at the point where you populate the arguments means you get familiar autocompletion and intellisense in your code editor, and strict typing thanks to the behaviour of typed properties in PHP 7.4. PHPstan typings are provided for even more comprehensive checks, if you use it.

![](assets/screenshot.png)

This library does _not_ operate like [the `OptionsResolver` class in Symfony](https://symfony.com/doc/current/components/options_resolver.html) because I don't know of any array parameters in WordPress that have required elements.

---

## Current Status

Alpha. The general shape of the args are stable but it's likely I'll restructure the complex arguments such as `meta_query` and `term_query` work before version 1.0.

## Usage

```php
$args = new \Args\WP_Query;

$args->tag = 'amazing';
$args->posts_per_page = 100;

$query = new \WP_Query( $args->toArray() );
```

```php
$args = new \Args\register_post_type;

$args->show_in_rest = true;
$args->taxonomies = [ 'genre', 'audience' ];

$story = register_post_type( 'story', $args->toArray() );
```

## What's Provided

### Posts

* `\Args\WP_Query`
* `\Args\register_post_type`
* `\Args\wp_insert_post`
* `\Args\wp_update_post`
* `\Args\get_posts`
* `\Args\register_post_meta`
* `\Args\register_post_status`

### Taxonomies and Terms

* `\Args\WP_Term_Query`
* `\Args\register_taxonomy`
* `\Args\wp_insert_term`
* `\Args\wp_update_term`
* `\Args\get_terms`
* `\Args\get_categories`
* `\Args\get_tags`
* `\Args\register_term_meta`
* `\Args\wp_count_terms`
* `\Args\wp_get_object_terms`

### Users

* `\Args\WP_User_Query`
* `\Args\wp_insert_user`
* `\Args\wp_update_user`
* `\Args\get_users`

### Comments

* `\Args\WP_Comment_Query`
* `\Args\get_comments`

### HTTP API

* `\Args\wp_remote_get`
* `\Args\wp_remote_post`
* `\Args\wp_remote_head`
* `\Args\wp_remote_request`

### Everything Else

* `\Args\register_block_type`
* `\Args\register_meta`
* `\Args\register_rest_field`
* `\Args\wp_get_nav_menus`
* `\Args\wp_die`

## Type Checking

PHP 7.4 introduced typed class properties, and these are implemented in this library where possible. If you pass a value of the wrong type to an argument that is typed, you'll get a fatal error as long as you're using strict types:

```php
declare( strict_types=1 );
```

No more mystery bugs due to incorrect types.

Note that several parameters in WordPress accept multiple types, for example the `$ignore_sticky_posts` for `\WP_Query` can be a boolean or an integer. Other parameters accept either a numerical string or an integer. In some of these cases I've opted to type the parameter with the most appropriate type even though it can technically accept other types.

## Static Analysis

PHPStan-specific `@phpstan-var` tags are used for properties that have a fixed set of values or other constraints. This allows for even greater type and value checking via static analysis with PHPStan.

Note that this isn't completely reliable due to [this bug in PHPStan](https://github.com/phpstan/phpstan/issues/3555).

## Requirements

* PHP 7.4 or PHP 8.0

## Installation

```
composer require johnbillion/args
```

## Contributing

Check out [CONTRIBUTING.md](CONTRIBUTING.md) for information about generating your own Args definitions or contributing to the Args library.

## But Why?

I have a name for these array-type parameters for passing arguments. I call them *Stockholm Parameters*. We've gotten so used to using them that we forget what a terrible design pattern it is. This library exists to work around the immediate issue without rearchitecting the whole of WordPress.

## Sponsors

Development of this library is sponsored by:

[![Automattic](assets/gh/automattic.png)](https://automattic.com)

Plus all my kind sponsors on GitHub:

[![Sponsors](assets/gh/everyone.png)](https://github.com/sponsors/johnbillion)

[Click here to find out about supporting this library and my other WordPress development tools and plugins](https://github.com/sponsors/johnbillion).

## License: GPLv2

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
