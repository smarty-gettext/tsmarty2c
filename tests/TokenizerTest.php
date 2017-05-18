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

namespace SmartyGettext\Test;

use Smarty;
use SmartyGettext\Tokenizer\Tokenizer;

class TokenizerTest extends TestCase {

	public function test1() {
		$tokens = $this->getTokens(__DIR__ . '/data/1.html');
		$this->assertCount(9, $tokens);

		// {t name="sagi"}
		$this->assertEquals('t', $tokens[1]->name);
		$this->assertEquals('"sagi"', $tokens[1]->arguments[0]['name']);
		$this->assertEquals(2, $tokens[1]->line);

		// text content
		$this->assertEquals('my name is %1', $tokens[2]->text);
		$this->assertEquals(2, $tokens[2]->line);

		// {/t}
		$this->assertEquals('tclose', $tokens[3]->name);
		$this->assertEquals(2, $tokens[3]->line);
	}

	/**
	 * @param string $template
	 * @return array
	 */
	private function getTokens($template) {
		$smarty = new Smarty();
		$tokenizer = new Tokenizer($smarty);

		return $tokenizer->getTokens($template);
	}
}
