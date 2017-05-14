<?php

/*
 * This file is part of the smarty-gettext/tsmarty2c package.
 *
 * @copyright (c) Elan Ruusamäe
 * @license BSD
 * @see https://github.com/smarty-gettext/tsmarty2c
 *
 * For the full copyright and license information,
 * please see the LICENSE and AUTHORS files
 * that were distributed with this source code.
 */

namespace SmartyGettext\Tokenizer\Token;

class Tag {
	/** @var string */
	public $name;

	/** @var string[] */
	public $arguments;

	public function __construct($name, $arguments) {
		$this->name = $name;
		$this->arguments = $arguments;
	}
}