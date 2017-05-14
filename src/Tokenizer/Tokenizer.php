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

namespace SmartyGettext\Tokenizer;

use Smarty;
use Smarty_Internal_SmartyTemplateCompiler;
use Smarty_Internal_Template;

class Tokenizer {
	/** @var Smarty */
	private $smarty;

	/**
	 * Compiler constructor.
	 *
	 * @param Smarty $smarty
	 */
	public function __construct(Smarty $smarty) {
		$this->smarty = $smarty;
	}

	/**
	 * @param string $templateFile
	 * @return array
	 */
	public function getTokens($templateFile) {
		/** @var Smarty_Internal_Template $template */
		$template = $this->smarty->createTemplate($templateFile, $this->smarty);
		$template->source->compiler_class = __NAMESPACE__ . '\\TokenCollector';

		/** @var Smarty_Internal_SmartyTemplateCompiler $compiler */
		$compiler = $template->compiler;
		$compiler->compileTemplate($template);

		return TokenCollector::getTokens();
	}
}