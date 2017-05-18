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

class Text {
	/** @var int */
	public $line;

	/** @var string */
	public $text;

	public function __construct($line, $text) {
		$this->line = $line;
		$this->text = $text;
	}
}