{*
a translation, which contains if-statement

this is of course better written as:
  {if $smarty.post.cat == 'remove'}
    {t}Thank you, the emails were removed successfully{/t}
  {else}
    {t}Thank you, the emails were restored successfully{/t}
  {/if}

while it appears correctly in output,
sentences should not be split to words according to English language rules.

*}

{t}Thank you, the emails were {if $cat == 'remove'}removed{else}restored{/if} successfully{/t}

{*
The above gets parsed as:

array:11 [
  1 => SmartyGettext\Tokenizer\Token\Tag {#47
    +line: 12
    +name: "t"
    +arguments: []
  }
  2 => SmartyGettext\Tokenizer\Token\Text {#51
    +line: 12
    +text: "Thank you, the emails were "
  }
  3 => SmartyGettext\Tokenizer\Token\Tag {#53
    +line: 12
    +name: "if"
    +arguments: []
  }
  4 => SmartyGettext\Tokenizer\Token\Text {#57
    +line: 12
    +text: "removed"
  }
  5 => SmartyGettext\Tokenizer\Token\Tag {#59
    +line: 12
    +name: "else"
    +arguments: []
  }
  6 => SmartyGettext\Tokenizer\Token\Text {#62
    +line: 12
    +text: "restored"
  }
  7 => SmartyGettext\Tokenizer\Token\Tag {#64
    +line: 12
    +name: "ifclose"
    +arguments: []
  }
  8 => SmartyGettext\Tokenizer\Token\Text {#67
    +line: 12
    +text: " successfully"
  }
  9 => SmartyGettext\Tokenizer\Token\Tag {#69
    +line: 12
    +name: "tclose"
    +arguments: []
  }
]

and smarty cache:

Thank you, the emails were <?php if ($_smarty_tpl->tpl_vars['cat']->value == 'remove') {?>removed<?php } else { ?>restored<?php
 }?> successfully<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);

*}