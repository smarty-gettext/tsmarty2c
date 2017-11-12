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

class SmartyTest extends TestCase
{
    /**
     * test with translation containing if-statements
     */
    public function testTranslationWithCondition()
    {
        $params = array('cat' => 'remove');
        $p = $this->renderTemplate(__DIR__ . '/data/translation_with_condition.tpl', $params);
        $exp = 'Thank you, the emails were removed successfully';
        $this->assertEquals($exp, $p);
    }

    private function renderTemplate($template, $params = array())
    {
        $smarty = new Smarty();
        $smarty->assign($params);

        return trim($smarty->fetch($template));
    }
}