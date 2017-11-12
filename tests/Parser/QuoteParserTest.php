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

class QuoteParserTest extends TestCase
{
    public function testTranslationBeginsWithQuote()
    {
        $p = $this->parseTemplate('quotes_in_translation.tpl');
        $this->assertNotNull($p);

        $entries = $p->getPoFile()->getEntries();
        $this->assertCount(3, $entries);

        $this->assertArrayHasKey('Note', $entries);
        $this->assertArrayHasKey("'Note Discussion' is required.", $entries);
        $this->assertArrayHasKey('\"Email Discussion\" is required.', $entries);
    }
}