{*
there's nested {t} inside {reply_button}

how it's supposed to work?
old pattern parser was able to find this one!

how does smarty really handle this?
*}

{function name="reply_button" class="" title="" data=""}
    {strip}
        <a title="{$title}">
            <i class="fa fa-reply {$class}" {$data} aria-hidden="true"></i>
        </a>
    {/strip}
{/function}

{reply_button title="{t}reply as email{/t}" class="reply_as_email"}
