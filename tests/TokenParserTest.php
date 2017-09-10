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
use SmartyGettext\Tokenizer\TokenParser;

class TokenParserTest extends TestCase
{
    /** @var TokenParser */
    private $tokenParser;

    public function setUp()
    {
        $smarty = new Smarty();
        $this->tokenParser = new TokenParser($smarty);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testParse($fileName, $exp)
    {
        $res = $this->getTags($fileName);
        $this->assertEquals($exp, $res);
    }

    public function dataProvider()
    {
        return array(
            array(
                '1.html',
                array(
                    "{t name='sagi'}my name is %1{/t}\n",
                    "{t 1='one' 2='two ' 3='three'}The 1st parameter is %1, the 2nd is %2\nand the 3nd %3.{/t}\n",
                )
            ),
        );
    }

    private function getTags($fileName)
    {
        $templateFile = __DIR__ . '/data/' . $fileName;
        $tags = $this->tokenParser->getTranslateTags($templateFile);

        $res = array();
        foreach ($tags as $t) {
            $res[] = (string)$t;
        }

        return $res;
    }
}