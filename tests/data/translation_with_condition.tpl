{*
a translation, which contains if-statement

this is of course better written as:
  {if $smarty.post.cat == 'remove'}
    {t}Thank you, the emails were removed successfully{/t}
  {else}
    {t}Thank you, the emails were restored successfully{/t}
  {/if}
*}

{t}Thank you, the emails were {if $cat == 'remove'}removed{else}restored{/if} successfully{/t}