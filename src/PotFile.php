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

use Geekwright\Po\Exceptions\FileNotWritableException;
use Smarty;
use SmartyGettext\Tokenizer\TokenParser;
use Geekwright\Po\Exceptions\FileNotReadableException;
use Geekwright\Po\PoFile;
use Symfony\Component\Finder\SplFileInfo;

class PotFile {

	/** @var TokenParser */
	private $parser;

	/** @var TokenLoader */
	private $loader;

	/** @var PoFile */
	private $file;

	public function __construct() {
		$smarty = new Smarty();
		$smarty->registerDefaultPluginHandler(new PluginLoader());

		$this->file = new PoFile();
		$this->loader = new TokenLoader($smarty, $this->file);
		$this->parser = new TokenParser($smarty);
	}

	/**
	 * Load translation tags from $file
	 *
	 * @param SplFileInfo $file
	 */
	public function loadTemplate(SplFileInfo $file) {
		$tags = $this->parser->getTranslateTags($file->getPathname());

		$this->loader->loadTokens($tags, $file->getRelativePath());
	}

	/**
	 * Set header from existing .pot file
	 *
	 * @param string $potFile
	 * @throws FileNotReadableException
	 */
	public function setHeaderFromFile($potFile) {
		$poFile = new PoFile();
		$poFile->readPoFile($potFile);
		$header = $poFile->getHeaderEntry();

		$this->file->setHeaderEntry($header);
	}

	/**
	 * Write .pot file to $filename
	 *
	 * @param string $filename
	 * @throws FileNotWritableException
	 */
	public function writeFile($filename) {
		$this->file->writePoFile($filename);
	}

	/**
	 * Get string representation of POT
	 *
	 * @return string
	 */
	public function getOutput() {
		return $this->file->dumpString();
	}
}
