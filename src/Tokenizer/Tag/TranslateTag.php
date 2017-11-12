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

namespace SmartyGettext\Tokenizer\Tag;

class TranslateTag
{
    const CONTEXT = 'context';

    const PLURAL = 'plural';

    /** @var string */
    public $message;

    /** @var array */
    public $arguments;

    /** @var int */
    public $line;

    /**
     * @param string $text
     * @param array $arguments
     * @param int $line
     */
    public function __construct($text, $arguments, $line)
    {
        $this->message = $text;
        $this->line = $line;
        $this->arguments = $this->parseArguments($arguments);
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        if (isset($this->message)) {
            return $this->message;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getContext()
    {
        if (isset($this->arguments[self::CONTEXT])) {
            return $this->arguments[self::CONTEXT];
        }

        return null;
    }

    /**
     * @return string[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return string|null
     */
    public function getPlural()
    {
        if (isset($this->arguments[self::PLURAL])) {
            return $this->arguments[self::PLURAL];
        }

        return null;
    }

    /**
     * Get arguments in sane way
     *
     * @return array
     */
    private function parseArguments($rawArguments)
    {
        $args = array();
        foreach ($rawArguments as $arg) {
            foreach ($arg as $key => $value) {
                $args[$key] = $this->unquote($value);
            }
        }

        return $args;
    }

    private function unquote($string)
    {
        if ($string[0] === '"' || $string[0] === "'") {
            $len = strlen($string);
            if ($string[0] === $string[$len - 1]) {
                $string = substr($string, 1, -1);
            }
        }

        return $string;
    }

    public function __toString()
    {
        $args = array();
        foreach ($this->arguments as $key => $value) {
            $args[] = sprintf('%s=%s', $key, var_export($value, 1));
        }

        return sprintf("{t %s}%s{/t}\n", implode(' ', $args), $this->message);
    }
}