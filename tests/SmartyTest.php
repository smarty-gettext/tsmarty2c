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
     * Test Smarty behaviour of various templates
     * @dataProvider dataProvider
     */
    public function testSmartyRender($template, $params, $exp)
    {
        $fileName = __DIR__ . '/data/' . $template;
        $p = $this->renderTemplate($fileName, $params);
        $this->assertEquals($exp, $p);
    }

    private function renderTemplate($template, $params = array())
    {
        $smarty = new Smarty();
        $smarty->assign($params);

        return trim($smarty->fetch($template));
    }

    public function dataProvider()
    {
        return array(
            /*
             * test with translation containing if-statements
             */
            'translation_with_condition' => array(
                'translation_with_condition.tpl',
                array('cat' => 'remove'),
                'Thank you, the emails were removed successfully',
            ),

            /*
             * Smarty parses nested blocks ("t" inside "reply_button"):
             * {reply_button title="{t}reply as email{/t}"}
             */
            'translation_in_argument' => array(
                'translation_in_argument.tpl',
                array(),
                '<a title="reply as email"><i class="fa fa-reply reply_as_email"  aria-hidden="true"></i></a>',
            ),

            'translate_in_assign' => array(
                'translate_in_assign.tpl',
                array('direction' => 'up', 'href' => '.'),
                '<a href="." title="move field up"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>',
            ),

            /*
             * variables in block content better used as arguments
             * looks better and parser is able to parse this
             */
            'template_vars' => array(
                'template_vars.tpl',
                array('issue_id' => 1, 'core' => array('rel_url' => '/')),
                'View Note Details (Associated with Issue <a href="/view.php?id=1">#1</a>)',
            ),
        );
    }
}