<?php

declare(strict_types=1);

final class WP_Post {}

final class WP_Term {}

final class WP_Taxonomy {}

abstract class WP_REST_Controller {}

class WP_REST_Request {}

class WP_Http_Cookie {}

class Walker {}

function __return_false() : bool {
	return false;
}

/**
 * @return mixed[]
 */
function _n_noop( string $singular, string $plural, string $domain = null ) : array {
	return array();
}
