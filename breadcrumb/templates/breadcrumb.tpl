{if $home === true}
  <span class="item current">{$config.labels.home}</span>
{else}
  <a class="item" href="{$home}">{$config.labels.home}</a>
{/if}
{foreach $branch as $k => $v}
  <span class="divider">/</span>
  {if $v.current}
    <span class="item current">{$v.title}</span>
  {else}
    <a class="item" href="{$k}">{$v.title}</a>
  {/if}
{/foreach}