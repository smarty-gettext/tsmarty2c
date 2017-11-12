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
    private function renderTemplate($template, $params = array())
    {
        $smarty = new Smarty();
        $smarty->assign($params);

        return trim($smarty->fetch($template));
    }
}