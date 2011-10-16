{include file='views/header.tpl'}

{if isset($data['regs'])}
<table class="materials-table-plain">
    <tr>
        <th><b>Alta</b></th>
        <th><b>Baja</b></th>
        <th><b>Material</b></th>
    </tr>
    {section name=index loop=$data['regs']}
    <tr>
        <td>{$data['regs'][index].signDate|date_format:'%d.%m.%Y'}</td>
        <td>{if $data['regs'][index].outDate != ''}{$data['regs'][index].outDate|date_format:'%d.%m.%Y'}{/if}</td>
        <td class="cell-max-plain">{$data['regs'][index].name}</td>
    </tr>
    {/section}
</table>
{else}
    <div class="no-materials"><h2>No hay materiales disponibles.</h2></div>
{/if}

{include file='views/footer.tpl'}