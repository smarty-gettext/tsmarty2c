{if $issue_id}
    {t escape=no 1=$issue_id}View Note Details (Associated with Issue <a href="{$core.rel_url}view.php?id=%1">#%1</a>){/t}
{else}
    {t}View Note Details{/t}
{/if}

{*
this doesn't parse well, use this instead:

{t escape=no 1=$issue_id 2="{$core.rel_url}view.php?id=$issue_id"}View Note Details (Associated with Issue <a href="%2">#%1</a>){/t}
*}