# tsmarty2c.php - the command line utility

`tsmarty2c.php` - A command line utility that rips gettext strings from smarty source files and converts them to `.pot` (PO-Template).

This utility will scan templates for `{t}...{/t}` placeholders for translation strings
and output a `.pot` file (`.po` template).

Usage:

    ./vendor/bin/tsmarty2c.php -o template.pot <filename or directory> <file2> <...>

If a parameter is a directory, the template files within will
be parsed, recursively.

In output special PO tags are added that inform about location of extracted translation. Most of the PO edit tools can respect that information.

If you wish to scan also `.php` or `.phtml` files for native gettext calls, you may wish to combine result of `tsmarty2c` and `xgettext` calls:

```
./vendor/bin/tsmarty2c.php -o smarty.pot ...
xgettext --add-comments=TRANSLATORS: --keyword=gettext --keyword=_  --output=code.pot ...
msgcat -o template.pot code.pot smarty.pot
rm -f code.pot smarty.pot
```

By default `tsmarty2c` scans for `.tpl` files, if you wish to use other files, you can use `xargs` in unix:

```
find templates -name '*.tpl.html' -o -name '*.tpl.text' -o -name '*.tpl.js' -o -name '*.tpl.xml' | xargs tsmarty2c.php -o smarty.pot
```

See how it's done in [Eventum](https://github.com/eventum/eventum/blob/master/localization/Makefile) project.

## Installing

1. as package depdencency:

       composer require --dev smarty-gettext/tsmarty2c
       ./vendor/bin/tsmarty2c.php

2. directly from this repository

       git clone https://github.com/smarty-gettext/tsmarty2c
       cd tsmarty2c
       composer install --no-dev
       ./bin/tsmarty2c.php

## Developing

1. clone this repository
2. [get composer](https://getcomposer.org/download/)
3. install composer dependencies: `php composer.phar install`
4. start using it: `php bin/tsmarty2c.php`
