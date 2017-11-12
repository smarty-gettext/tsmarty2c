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

namespace SmartyGettext\Test\Parser;

use SmartyGettext\Test\TestCase;

class LineNumbersTest extends TestCase
{
    public function testLineNumbers()
    {
        $fileName = 'linenumbers.tpl';
        $p = $this->parseTemplate($fileName);
        $this->assertNotNull($p);

        $e = $this->getEntries($p);
        $this->assertCount(3, $e);

        $expected = array(
            array(
                "$fileName:6",
            ),
            array(
                "$fileName:8",
            ),
            array(
                "$fileName:11",
            ),
        );
        $this->assertReferences($expected, $e);
    }
}