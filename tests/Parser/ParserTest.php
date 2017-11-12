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

class ParserTest extends TestCase
{
    public function testParseUnknownModifier()
    {
        $res = $this->parseTemplate('modifier.tpl');
        $this->assertNotNull($res);
    }

    public function testParseUnknownBlock()
    {
        $res = $this->parseTemplate('custom_block_single_tag.tpl');
        $this->assertNotNull($res);
    }

    public function testTranslationWithCondition() {
        $p = $this->parseTemplate('translation_with_condition.tpl');
        $this->assertNotNull($p);

        $entries = $p->getPoFile()->getEntries();
        $this->assertCount(1, $entries);
    }
}
