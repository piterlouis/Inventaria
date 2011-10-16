{include file='views/header.tpl'}

<script type="text/javascript" src="js/materials.js"></script>


<div id="dialog-material" title="Nuevo material">
    <label>material</label><br/>
    <input type="text" id="name" name="name" value="{$name|default:''}" /><br />
    <br />
    <label>observaciones</label><br/>
    <textarea rows="7" id="observations" name="observations" value="{$observations|default:''}"></textarea><br />
    <br />
    <div id="dialog-msg" class="ui-state-highlight">Mensaje informativo</div>
</div>


<div id="dialog-del" title="Eliminar material">
    Confirme que desea eliminar el material:<div id="dialog-del-msg"></div>
</div>


<div class="top-toolbar">
    <div id="dpto-title">Dpto. de {$data.departname}</div>
    <img id="icon-wait-login" class="icon-wait" src="img/waiting.gif" />
    <button id="btnLogout">Logout</button>
</div>

<div>

<div class="header">
    <b>Listado de materiales</b>
    <span id="icn-print" class="ui-icon ui-icon-print mini-icon"></span>
    <span id="icn-close" class="ui-icon ui-icon-folder-collapsed mini-icon"></span>
    <span id="icn-open" class="ui-icon ui-icon-folder-open mini-icon"></span>
</div>
<hr />

<div class="list-toolbar">
    <div id="ltype">
		    <input type="radio" id="radio1" name="ltype" checked="checked" value="active" /><label for="radio1">Activo</label>
		    <input type="radio" id="radio2" name="ltype" value="history" /><label for="radio2">Historia</label>
		    <input type="radio" id="radio3" name="ltype" value="mixed" /><label for="radio3">Ambos</label>
	  </div>
	  
	  <div id="orden">
		    <input type="radio" id="radio4" name="orden" checked="checked" value="materials" /><label for="radio4">Material</label>
		    <input type="radio" id="radio5" name="orden" value="dates" /><label for="radio5">Fecha</label>
	  </div>
	  
	  <div id="btnOptions">
        <img id="icon-wait" class="icon-wait" src="img/waiting.gif" />    
        <button id="btnReload">Reload</button>
        <button id="addMaterial">Nuevo</button>
    </div>
</div>

<div id="status-msg" class="ui-state-highlight">Mensaje informativo</div>

<div id="list-main"></div>
    
</div>

{include file='views/footer.tpl'}