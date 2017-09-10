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
	private $pofile;

	public function __construct($outputFile) {
		$smarty = new Smarty();

		$this->pofile = $this->getPoFile($outputFile);
		$this->loader = new TokenLoader($smarty, $this->pofile);
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
	 * Write .pot file to $filename
	 *
	 * @param string $filename
	 * @throws FileNotWritableException
	 */
	public function writeFile($filename) {
		$this->pofile->writePoFile($filename);
	}

	/**
	 * Get string representation of POT
	 *
	 * @return string
	 */
	public function getOutput() {
		return $this->pofile->dumpString();
	}

	/**
	 * Create empty PoFile.
	 * Initializes header from $potFile if such file exists.
	 *
	 * @param string $potFile default .pot where to initialize header
	 * @return PoFile
	 * @throws FileNotReadableException
	 */
	private function getPoFile($potFile) {
		// load header from previous .pot
		if (file_exists($potFile)) {
			$poFile = new PoFile();
			$poFile->readPoFile($potFile);
			$header = $poFile->getHeaderEntry();
		} else {
			$header = null;
		}

		$poFile = new PoFile();
		if ($header) {
			$poFile->setHeaderEntry($header);
		}

		return $poFile;
	}
}
