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

use Geekwright\Po\PoEntry;
use Geekwright\Po\PoFile;
use Geekwright\Po\PoInitSmarty;
use Geekwright\Po\PoTokens;
use InvalidArgumentException;
use SmartyGettext\Tokenizer\Tag\TranslateTag;

class TokenLoader extends PoInitSmarty {
	/**
	 * Inspect the supplied source, capture gettext references as a PoFile object.
	 *
	 * @param TranslateTag[] $tokens
	 * @param string $refname source identification used for PO reference comments
	 * @return PoFile
	 * @throws InvalidArgumentException
	 */
	public function loadTokens($tokens, $refname) {
		if (!($this->poFile instanceof PoFile)) {
			$this->poFile = new PoFile;
		}

		foreach ($tokens as $t) {
			$entry = $this->createEntry($t, $refname);
			$this->checkPhpFormatFlag($entry);
			$this->poFile->mergeEntry($entry);
		}

		return $this->poFile;
	}

	/**
	 * @param TranslateTag $t
	 * @param string $refname
	 * @return PoEntry
	 * @throws InvalidArgumentException
	 */
	private function createEntry($t, $refname) {
		$message = $t->getMessage();
		if (!$message) {
			throw new InvalidArgumentException('Empty message');
		}

		$entry = new PoEntry;
		$entry->add(PoTokens::REFERENCE, $refname . ':' . $t->getLine());
		$entry->set(PoTokens::MESSAGE, $this->escapeForPo($message));

		if ($context = $t->getContext()) {
			$entry->set(PoTokens::CONTEXT, $this->escapeForPo($context));
		}

		if ($plural = $t->getPlural()) {
			$entry->set(PoTokens::PLURAL, $this->escapeForPo($plural));
		}

		return $entry;
	}
}
