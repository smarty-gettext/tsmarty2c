# Smarty Gettext Translation String Ripper

When writing entries, refer to [Keep a CHANGELOG](http://keepachangelog.com/) for guidelines.

All notable changes to this project will be documented in this file.

## [0.2.2] - 2021-12-24

- Bump binary version #23

[0.2.2]: https://github.com/smarty-gettext/tsmarty2c/compare/0.2.1...0.2.2

## [0.2.1] - 2020-11-11

- Fix Symfony 5 compatibility #19, #18

[0.2.1]: https://github.com/smarty-gettext/tsmarty2c/compare/0.2.0...0.2.1

## [0.2.0] - 2020-07-09

- Add example about bad translation, #11
- Fix bogus strip if translation started with quote, #12
- Add test and example of variables in block content, #13
- Add specific installation instructions, #14
- Smarty 3.1.35 introduced BC break, so reject it, #16
- Allow Symfony 4 & 5, #15

[0.2.0]: https://github.com/smarty-gettext/tsmarty2c/compare/0.1.2...0.2.0

## [0.1.2] - 2017-11-12

- Add support for overriding delimiters, #9

[0.1.2]: https://github.com/smarty-gettext/tsmarty2c/compare/0.1.1...0.1.2

## [0.1.1] - 2017-09-11

- Define dummy plugin handlers for unknown tags, #6
- Fix plural handling, #7
- Fix line number context to be line of opening tag, #8

[0.1.1]: https://github.com/smarty-gettext/tsmarty2c/compare/0.1.0...0.1.1

## [0.1.0] - 2017-09-10

Initial usable version.

- Use Symfony\Console for CLI application
- Use Symfony\Finder to find files
- Parse template using Smarty engine into tokens, #2
- Process smarty tokens into "Tag" object, #3
- For each "Tag" object, write .pot file, #4

[0.1.0]: https://github.com/smarty-gettext/tsmarty2c/commits/0.1.0
