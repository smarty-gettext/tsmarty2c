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

namespace SmartyGettext\Tokenizer;

use Smarty_Internal_SmartyTemplateCompiler;

/**
 * Wrapper to grab tokens from Smarty Template Compiler as they get parsed from template.
 */
class TokenCollector extends Smarty_Internal_SmartyTemplateCompiler {
	/** @var array */
	private static $tokens = array();

	/**
	 * @return array
	 */
	public static function getTokens() {
		return self::$tokens;
	}

	/**
	 * {@inheritdoc}
	 */
	public function compileTag($tag, $args, $parameter = array()) {
		$line = $this->parser->lex->line;

		self::$tokens[] = new Token\Tag($line, $tag, $args, $parameter);

		return parent::compileTag($tag, $args, $parameter);
	}

	/**
	 * {@inheritdoc}
	 */
	public function processText($text) {
		$line = $this->parser->lex->line;

		self::$tokens[] = new Token\Text($line, $text);

		return parent::processText($text);
	}
}
