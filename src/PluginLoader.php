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

namespace SmartyGettext;

use Smarty;

/**
 * Provide dummy plugins for Smarty modifiers and blocks
 *
 * @see https://www.smarty.net/docs/en/api.register.default.plugin.handler.tpl
 */
class PluginLoader
{
    /**
     * List of plugin types to wrap with dummy handler.
     *
     * @var array
     */
    private $providers = array(
        Smarty::PLUGIN_MODIFIER => true,
        Smarty::PLUGIN_BLOCK => true,
        Smarty::PLUGIN_FUNCTION => true,
    );

    public function __invoke($name, $type, $template, &$callback)
    {
        if (!isset($this->providers[$type])) {
            return false;
        }

        // need to use static invocation
        // because Smarty can't deal with dynamic calls.
        $callback = array(__CLASS__, 'noop');

        return true;
    }

    public static function noop()
    {
    }
}
