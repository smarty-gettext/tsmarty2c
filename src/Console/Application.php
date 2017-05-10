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

namespace SmartyGettext\Console;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication {
	protected function getDefaultCommands() {
		$commands = parent::getDefaultCommands();

		$commands[] = new Command\Extract();

		return $commands;
	}
}
