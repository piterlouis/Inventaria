    $(function() {
        $(".row-detailed .cell-material").click(function(){ $(this).find("div").toggle("blind"); });
        
        $(".link-mod").click(function(){
                               cell = $(this).closest("tr").find("td.cell-material");
                               myName = cell.find("span.material-name").text();
                               myObs = cell.find("div.detail").text();
                               action = $(this).attr("href");
                               
                               $("#name").val( myName );
                               $("#observations").val( myObs );
                               $("#dialog-material").dialog("option", "buttons", { "Modificar": function(){ modMaterial(action); } });
                               $("#dialog-material").dialog("open"); 
                               return false; 
                             });
        $(".link-del").click(function(){
                               action = $(this).attr("href");
                               $("#dialog-del-msg").text( $(this).closest("tr").find("td.cell-material").find("span.material-name").text() );
                               $("#dialog-del").dialog("option", "buttons", { "Eliminar": function(){ delMaterial(action); } }); 
                               $("#dialog-del").dialog("open"); 
                               return false; 
                             });
                             
        $("#icon-wait").hide();
        $("#btnReload").button("enable");
        $("#addMaterial").button("enable");
        $("#ltype").buttonset("enable");
        $("#orden").buttonset("enable");

    });
