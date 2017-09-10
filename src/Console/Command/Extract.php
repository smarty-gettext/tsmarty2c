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

namespace SmartyGettext\Console\Command;

use InvalidArgumentException;
use SmartyGettext\PotFile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Extract extends Command {
	protected function configure() {
		$this
			->setName('extract')
			->setDescription('Extract POT strings')
			->addArgument('arguments', InputArgument::REQUIRED | InputArgument::IS_ARRAY, 'Files/Directories to scan')
			->addOption('--output', '-o', InputOption::VALUE_REQUIRED, 'Output filename')
			->setHelp(
				<<<EOT
<info>%command.full_name% -o template.pot <filename or directory> <file2> <..></info>

If a parameter is a directory, the template files within will be parsed.

The script rips gettext strings from Smarty file,
and prints them to stdout in already gettext encoded format, which you can
later manipulate with standard gettext tools.

EOT
			);
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return void
	 * @throws InvalidArgumentException
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		$args = $input->getArgument('arguments');
		$templateFiles = $this->findFiles($args);

		$outputFile = $input->getOption('output');
		$potFile = new PotFile($outputFile);

		foreach ($templateFiles as $file) {
			$output->writeln("Process <info>{$file->getPathname()}</info>");
			$potFile->loadTemplate($file);
		}

		if ($outputFile) {
			$potFile->writeFile($outputFile);

		} else {
			$output->writeln($potFile->getOutput());
		}

		$output->writeln('<info>Done</info>');
	}

	/**
	 * Find files from given paths.
	 *
	 * @param string[] $paths files or dirs to find
	 * @return Finder
	 * @throws InvalidArgumentException
	 */
	private function findFiles($paths) {
		$files = array();

		$finder = new Finder();
		$finder
			->files()
			->name('*.tpl');

		foreach ($paths as $arg) {
			if (is_dir($arg)) {
				$finder->in($arg);
			} elseif (is_file($arg)) {
				$relativePath = $arg;
				$relativePathName = $arg;
				$files[] = new SplFileInfo($arg, $relativePath, $relativePathName);
			} else {
				throw new InvalidArgumentException("Not file or dir: $arg");
			}
		}

		if ($files) {
			$finder->append($files);
		}

		return $finder;
	}
}
