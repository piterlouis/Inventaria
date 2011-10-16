  function addPasswd() {
      if (($("#newpasswd").val() == "") || ($("#newpasswd").val() != $("#repasswd").val())) {
          $("#dialog-addpasswd").dialog("close");
          $("#status-msg").html("Las passwords introducidas no son correctas.");
          $("#status-msg").show("pulsate").delay(1000).fadeOut();
      }
      else {
          hash = hex_md5($("#newpasswd").val());
          $.post("main/addpasswd", 
                 { departid: $("#department").val(), 
                   newpasswd: hash },  
                 function(data, textStatus, XMLHttpRequest){
                    $("#dialog-addpasswd").dialog("close");
                    if (data == "OK") {
                        document.location = "materials";
                    }
                    else if (data == "ERROR") {
                        $("#status-msg").html("Ha ocurrido un error.");
                        $("#status-msg").show("pulsate").delay(1000).fadeOut();
                    }
                 });
      }
  }
  
  function login() {
          hash = hex_md5($("#passwd").val());
          $.post("main/login", 
                 { departid: $("#department").val(), 
                   passwd: hash },  
                 function(data, textStatus, XMLHttpRequest){
                    $("#dialog-passwd").dialog("close");
                    $("#dialog-addpasswd").dialog("close");
                    if (data == "OK") {
                        document.location = "materials";
                    }
                    else if (data == "ERROR") {
                        $("#status-msg").html("La clave no es correcta.");
                        $("#status-msg").show("pulsate").delay(1000).fadeOut();
                    }
                 });      
  }
  
  $(function(){
      $("input:button").button();
      $("#btnLogin").button("disable");
      $("select").addClass("ui-widget");
      $("#status-msg").hide();
      $("#icon-wait-login").hide();
      $("#icon-wait-passwd").hide();
      $("#icon-wait-addpasswd").hide();
      $("#dialog-passwd").dialog({
          autoOpen: false,
          modal: true,
          width: 400,
          buttons: {
              "Login": function() {
                  $("#icon-wait-passwd").fadeIn();
                  login();
              }              
          },
          close: function(evetn, ui) {
              $("#passwd").val("");
              $("#icon-wait-passwd").hide();
          }
      });
      $("#dialog-addpasswd").dialog({
          autoOpen: false,
          width:400, 
          modal: true,
          buttons: {
              "Guardar": function() {
                  $("#icon-wait-addpasswd").fadeIn();
                  addPasswd();
              },
              "Seguir": function() {
                  $("#icon-wait-addpasswd").fadeIn();
                  login();
              }
          },
          close: function(evetn, ui) {
              $("#newpasswd").val("");
              $("#repasswd").val("");
              $("#icon-wait-addpasswd").hide();
          }

      });
      $("#department").change(function(){
          if ($("#department").val() != 0) {
              $("#btnLogin").button("enable");
          }
          else {
              $("#btnLogin").button("disable");
          }
      });
      $("#btnLogin").click(function(){
          $("#btnLogin").button("disable");
          $("#icon-wait-login").fadeIn();
          $.post("main/prelogin", 
                 { department: $("#department").val() },  
                 function(data, textStatus, XMLHttpRequest){
                    $("#btnLogin").button("enable");
                    $("#icon-wait-login").fadeOut();
                    if (data == "PASSWD") {
                        $("#dialog-passwd").dialog("open");
                    }
                    else if (data == "NOPASSWD") {
                        $("#dialog-addpasswd").dialog("open");
                    }
                    else {
                        $("#status-msg").html("Se ha producido un error");
                        $("#status-msg").show("pulsate").delay(1000).fadeOut();
                    }  
                 });
          $(this).blur();
      });
  });
