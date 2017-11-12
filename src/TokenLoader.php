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

class TokenLoader extends PoInitSmarty
{
    /**
     * Inspect the supplied source, capture gettext references as a PoFile object.
     *
     * @param TranslateTag[] $tags
     * @param string $refName source identification used for PO reference comments
     * @return PoFile
     * @throws InvalidArgumentException
     */
    public function loadTags($tags, $refName)
    {
        if (!($this->poFile instanceof PoFile)) {
            $this->poFile = new PoFile;
        }

        foreach ($tags as $tag) {
            $entry = $this->createEntry($tag, $refName);
            $this->checkPhpFormatFlag($entry);
            $this->poFile->mergeEntry($entry);
        }

        return $this->poFile;
    }

    /**
     * @param TranslateTag $tag
     * @param string $refName
     * @return PoEntry
     * @throws InvalidArgumentException
     */
    private function createEntry($tag, $refName)
    {
        $message = $tag->getMessage();
        if (!$message) {
            throw new InvalidArgumentException('Empty message');
        }

        $entry = new PoEntry;
        $entry->add(PoTokens::REFERENCE, $refName . ':' . $tag->getLine());
        $entry->set(PoTokens::MESSAGE, $this->escapeForPo($message));

        if ($context = $tag->getContext()) {
            $entry->set(PoTokens::CONTEXT, $this->escapeForPo($context));
        }

        if ($plural = $tag->getPlural()) {
            $entry->set(PoTokens::PLURAL, $this->escapeForPo($plural));
        }

        return $entry;
    }

    /**
     * Replaces method because parent stripped quote.
     *
     * @inheritdoc
     */
    public function escapeForPo($string)
    {
        // FIXME: is such strip needed anyway?
        if ($string[0] === '"' || $string[0] === "'") {
            $len = strlen($string);
            if ($string[0] === $string[$len - 1]) {
                $string = substr($string, 1, -1);
            }
        }

        $string = str_replace("\r\n", "\n", $string);
        $string = stripcslashes($string);

        return addcslashes($string, "\0..\37\"");
    }
}
