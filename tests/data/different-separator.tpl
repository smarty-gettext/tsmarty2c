{*

https://github.com/smarty-gettext/smarty-gettext/issues/20

I use [% and %] as my delimiters.

I like to write my translations as following:
[% t %]Now with 20% discount![% /t %]

I changed the used regular expression to work around this issue:

Before: "/{$ldq}\s*({$cmd})\s*([^{$rdq}]*){$rdq}+([^{$ldq}]*){$ldq}\/\\1{$rdq}/"
After : "/{$ldq}\s*({$cmd})\s*(.*?)\s*{$rdq}(.+?){$ldq}\s*\/\\1\s*{$rdq}/"

(It actually resolves the multi-char delimiter, and it also adds support for an ending "ldq whitespace cmd whitespace rdq")

Patch: tsmarty2c.php.patch.txt

This issue is kinda related to #1 and #15

*}

[% t %]Now with 20% discount![% /t %]

{* EOF *}
