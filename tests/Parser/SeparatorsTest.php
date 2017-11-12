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

use Geekwright\Po\PoEntry;
use Geekwright\Po\PoTokens;
use SmartyGettext\PotFile;
use SmartyGettext\Test\TestCase;

class SeparatorsTest extends TestCase
{
    /**
     * @see https://github.com/smarty-gettext/smarty-gettext/issues/20
     */
    public function testDifferentSeparators()
    {
        $p = $this->parseTemplate('different-separator.tpl', function (PotFile $p) {
            $p->setDelimiters('[% ', ' %]');
        });
        $this->assertNotNull($p);

        $entries = $p->getPoFile()->getEntries();
        $this->assertCount(1, $entries);

        /** @var PoEntry $e */
        $e = current($entries);
        $this->assertNotNull($e->get(PoTokens::MESSAGE), "Now with 20% discount!");
    }
}