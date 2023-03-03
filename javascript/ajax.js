function ajaxOnLoad(){
    $("#ajaxButton").click(function(){
        $.ajax({
            url: "/ap1/php/ajax/returnBdd.php",
            type: "POST",
            data: {
                employe: $("#employe").val(),
                priorite: $("#priorite").val(),
                etat: $("#etat").val(),
            },
            success: function(data, textStatus, jqXHR)
            {
                $("#resultat").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $("#resultat").html(textStatus);
            }
        });
    });
}
