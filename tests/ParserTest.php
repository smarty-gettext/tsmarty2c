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

use SmartyGettext\PotFile;
use Symfony\Component\Finder\SplFileInfo;

class ParserTest extends TestCase {

	public function testParseUnknownModifier() {
		$res = $this->parseTemplate(__DIR__ . '/data/modifier.tpl');
		$this->assertNotNull($res);
	}

	private function parseTemplate($filename) {
		$file = new SplFileInfo($filename, $filename, $filename);
		$p = new PotFile();
		$p->loadTemplate($file);

		return $p->getOutput();
	}
}