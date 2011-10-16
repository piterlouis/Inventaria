{include file='views/header.tpl'}

<script type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/login.js"></script>


<div id="dialog-passwd" title="Accediendo al departamento">
	<p class="validateTips">La cuenta del departamento est&aacute; protegida por contrase&ntilde;a.</p>
		<label for="passwd">Password</label>
		<input type="password" name="passwd" id="passwd" class="text ui-widget-content ui-corner-all" />
		<img id="icon-wait-passwd" class="icon-wait" src="img/waiting.gif" />
</div>


<div id="dialog-addpasswd" title="Accediendo al departamento">
	<p class="validateTips">La cuenta del departamento no est&aacute; protegida por contrase&ntilde;a.
  Puede generar una nueva o dejarlo para m&aacute;s tarde.</p>
		<label for="passwd" class="fixed-width">Password</label>
		<input type="password" name="newpasswd" id="newpasswd" class="text ui-widget-content ui-corner-all" />
		<br />
		<label for="passwd" class="fixed-width">Repetir</label>
		<input type="password" name="repasswd" id="repasswd" class="text ui-widget-content ui-corner-all" />
		<img id="icon-wait-addpasswd" class="icon-wait" src="img/waiting.gif" />
</div>

<div class="login-form ui-corner-all">
  <div><h1>Gesti&oacute;n de Inventariado de Departamentos</h1><h2>I.E.S. Zaframag&oacute;n</h2></div>
  <div id="login-content">
  <div id="status-msg" class="ui-state-highlight">Mensaje informativo</div>
  <select name="department" id="department">
    <option value="0">Selecciona un Departamento</option>
    {section name=index loop=$data['regs']}
    <option value="{$data['regs'][index].id}">{$data['regs'][index].name}</option>
    {/section}
  </select>
  </div>
  <div id="login-toolbar">
      <img id="icon-wait-login" class="icon-wait" src="img/waiting.gif" /><input id="btnLogin" type="button" value="Acceder" />
  </div>
</div>

{include file='views/footer.tpl'}
