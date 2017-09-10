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

use Geekwright\Po\PoEntry;
use Geekwright\Po\PoTokens;
use SmartyGettext\PotFile;
use Symfony\Component\Finder\SplFileInfo;

class ParserTest extends TestCase {

	public function testParseUnknownModifier() {
		$res = $this->parseTemplate(__DIR__ . '/data/modifier.tpl');
		$this->assertNotNull($res);
	}

	public function testParseUnknownBlock() {
		$res = $this->parseTemplate(__DIR__ . '/data/custom_block_single_tag.tpl');
		$this->assertNotNull($res);
	}

	public function testParsePlural() {
		$p = $this->parseTemplate(__DIR__ . '/data/plural.tpl');
		$this->assertNotNull($p);

		$entries = $p->getPoFile()->getEntries();
		$this->assertCount(1, $entries);

		/** @var PoEntry $e */
		$e = current($entries);
		$this->assertNotNull($e->get(PoTokens::PLURAL), "has plural");
	}

	private function parseTemplate($filename) {
		$file = new SplFileInfo($filename, $filename, $filename);
		$p = new PotFile();
		$p->loadTemplate($file);

		return $p;
	}
}