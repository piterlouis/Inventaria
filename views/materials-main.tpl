
<script type="text/javascript" src="js/materials-main.js"></script>

{if isset($data['regs'])}
<table class="materials-table">
    {section name=index loop=$data['regs']}
    <tr class="{if $data['regs'][index].observations != ''}row-detailed{else}row{/if} {cycle values='row-1,row-2'} {if $data['regs'][index].outDate != ''}row-deleted{/if}">
        <td class="cell-date">{if $data['regs'][index].outDate != ''}<span class="date-deleted">{$data['regs'][index].outDate|date_format:'%d.%m.%Y'}</span>{/if} {$data['regs'][index].signDate|date_format:'%d.%m.%Y'}</td>
        <td class="cell-material"><span class="material-name">{$data['regs'][index].name}</span><div class="detail">{$data['regs'][index].observations}</div></td>
        <td class="cell-info">{if $data['regs'][index].observations != ''}<span class="ui-icon ui-icon-info"></span>{/if}</td>
        <td class="cell-icons">
        {if $data['regs'][index].outDate == ''}
            <a class="link-mod" href="{$data['regs'][index].modlink}"><span class="ui-icon ui-icon-pencil"></span></a>
            <a class="link-del" href="{$data['regs'][index].dellink}"><span class="ui-icon ui-icon-trash"></span></a>
        {/if}
        </td>
    </tr>
    {/section}
</table>
{else}
    <div class="no-materials"><h2>No hay materiales disponibles.</h2></div>
{/if}
