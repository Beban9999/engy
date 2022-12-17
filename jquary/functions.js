$(document).ready(function(){
    if(document.getElementById("table_body")){
        fillDataTable();
    }
    $("#login").click(function(){
        let korIme = $("#form2Example11").val();
        let pass = $("#form2Example22").val();
        
        console.log(korIme, pass);
        if(korIme == "" || pass == ""){
            $("#odgPrijava").html('<div class="alert alert-danger" role="alert">You need to enter username and password</div>');
            return false;
        }
        $.post("ajax.php?f=prijava",{korIme:korIme, pass:pass}, function(response){
            console.log(response)
            if(response.startsWith("prijavljen.php")){
                window.location.assign("prijavljen.php");
                
            }
            else{
                $("#odgPrijava").html(response); 
            }
        })

    });
    
    $("#insertRow").click(function(){
        let ins_customer       = $("#ins_customer").html();
        let ins_prod           = $("#ins_prod").html();
        let ins_traff          = $("#ins_traff").html();
        let ins_maincomp       = $("#ins_maincomp").html();
        let ins_dest           = $("#ins_dest").html();
        let ins_looking        = $("#ins_looking").html();
        let ins_pot            = $("#ins_pot").html();
        let ins_act            = $("#ins_act").html();
        let ins_next           = $("#ins_next").html();
        let ins_result         = $("#ins_result").html();
        let ins_datecomm       = $("#ins_datecomm").html();
        

        console.log(ins_customer,
                    ins_prod    ,
                    ins_traff   ,
                    ins_maincomp,
                    ins_dest    ,
                    ins_looking ,
                    ins_pot     ,
                    ins_act     ,
                    ins_next    ,
                    ins_result  ,
                    ins_datecomm);
                    

            $.post("ajax.php?f=insertRow", 
            {
                ins_customer:ins_customer,
                ins_prod    :ins_prod    ,
                ins_traff   :ins_traff   ,
                ins_maincomp:ins_maincomp,
                ins_dest    :ins_dest    ,
                ins_looking :ins_looking ,
                ins_pot     :ins_pot     ,
                ins_act     :ins_act     ,
                ins_next    :ins_next    ,
                ins_result  :ins_result  ,
                ins_datecomm:ins_datecomm
            }, 
            
            function(response){
                fillDataTable();
                $("#insertResp").html(response);
            })
            
            
            //RESET FIELDS
            $("#ins_customer").html("");
            $("#ins_prod").html("");
            $("#ins_traff").html("");
            $("#ins_maincomp").html("");
            $("#ins_dest").html("");
            $("#ins_looking").html("");
            $("#ins_pot").html("");
            $("#ins_act").html("");
            $("#ins_next").html("");
            $("#ins_result").html("");
            $("#ins_datecomm").html("");

    });
    
})

function fillDataTable(){
    $.post("ajax.php?f=fillDataTable", function(response){
        $("#table_body").html(response);
    })
}

function deleteRecord(id){
    $.post("ajax.php?f=deleteRecord",{id:id}, function(response){
        $("#insertResp").html(response);
        fillDataTable();
    })
}