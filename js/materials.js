    function reloadMaterials() {
        $("#btnReload").button("disable");
        $("#addMaterial").button("disable");
        $("#ltype").buttonset("disable");
        $("#orden").buttonset("disable");
        
        $("#icon-wait").fadeIn();
        $("#list-main").load("materials/listall",
                             { ltype: $("input[name=ltype]:checked").val(),
                               orden: $("input[name=orden]:checked").val() });
        $("input[name=ltype]:checked").blur();
        $("input[name=orden]:checked").blur();
    }

    function addMaterial() {
        $("#dialog-msg").html("Agregando material al inventario...");
        $("#dialog-msg").show("pulsate");
        $.post("materials/add", 
               { name: $("#name").val(), 
                 observations: $("#observations").val() },  
               function(data, textStatus, XMLHttpRequest){
                  $("#dialog-material").dialog("close");
                  if (data == "OK") {
                      $("#status-msg").html("El material se ha agregado correctamente al inventario.");
                      $("#status-msg").fadeIn().delay(2000).fadeOut();
                      reloadMaterials();
                  }
                  else if (data == "ERROR") {
                      $("#status-msg").html("Ha ocurrido un error al agregar el material.");
                      $("#status-msg").show("pulsate");
                  }
               });
    }

    function modMaterial(action) {
        $("#dialog-msg").html("Modificando material en el inventario...");
        $("#dialog-msg").show("pulsate");
        $.post(action, 
               { name: $("#name").val(), 
                 observations: $("#observations").val() },  
               function(data, textStatus, XMLHttpRequest){
                  $("#dialog-material").dialog("close");
                  if (data == "OK") {
                      $("#status-msg").html("El material se ha modificado correctamente.");
                      $("#status-msg").fadeIn().delay(2000).fadeOut();
                      reloadMaterials();
                  }
                  else if (data == "ERROR") {
                      $("#status-msg").html("Ha ocurrido un error al modificar el material.");
                      $("#status-msg").show("pulsate");
                  }
               });
    }

    function delMaterial(action) {
        $("#dialog-del").dialog("close");
        $("#status-msg").html("Eliminando material en el inventario...");
        $("#status-msg").show("pulsate");
        $.post(action, 
               { },  
               function(data, textStatus, XMLHttpRequest){          
                  if (data == "OK") {
                      $("#status-msg").html("El material se ha eliminado correctamente.");
                      $("#status-msg").fadeIn().delay(2000).fadeOut();
                      reloadMaterials();
                  }
                  else if (data == "ERROR") {
                      $("#status-msg").html("Ha ocurrido un error al eliminar el material.");
                      $("#status-msg").show("pulsate");
                  }
               });
    }
    
    function openPrint() {
        var url = "materials/listplain/" 
                  + $("input[name=ltype]:checked").val() + "/" 
                  + $("input[name=orden]:checked").val();
        window.open(url, 'Listado para impresi&oacute;n'); 
    }
    
    $(function() {
        $("#dialog-material").dialog({
            autoOpen: false,
            modal: true,
            width: 500,
            buttons: {
                "Agregar": function() {
                    addMaterial();
                }              
            },
            close: function(event, ui) {
                $("#name").val("");
                $("#observations").val("");
                $("#dialog-msg").hide();         
            }
        });
        
        $("#dialog-del").dialog({
            autoOpen: false,
            modal: true,
            width: 400,
            buttons: {
                "Eliminar": function() {
                    delMaterial();
                }              
            },
            close: function(event, ui) {
            }
        });    
    

        $("#btnLogout").button({
            icons: { secondary: "ui-icon-power" }
        })
        .click(function() {
            $("#icon-wait-login").fadeIn();
            document.location = "main/logout";
        });
        
        $("#btnReload").button({
            icons: { secondary: "ui-icon-arrowreturnthick-1-s" }
        })
        .click(function() {
            reloadMaterials();
            $(this).blur();
        });

        $("#addMaterial").button({
            icons: { secondary: "ui-icon-plus" }
        })
        .click(function(){
            $("#dialog-material").dialog("option", "buttons", { "Agregar": function(){ addMaterial(); } });
            $("#dialog-material").dialog("open");
            $(this).blur();
        });
        
        $("#dialog-msg").hide();
        $("#status-msg").hide();
        
        $("#ltype").buttonset().change(function(){ reloadMaterials(); });
        $("#orden").buttonset().change(function(){ reloadMaterials(); });
        
        $("#icn-open").click(function(){
            $(".row-detailed .detail").show("blind");
        });
        $("#icn-close").click(function(){
            $(".row-detailed .detail").hide("blind");
        });
        $("#icn-print").click(function(){
            openPrint();
        });
        
        $("#icon-wait-login").hide();
        
        reloadMaterials();
    });
