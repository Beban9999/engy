$(document).ready(function(){

    $("#login").click(function(){
        let korIme = $("#form2Example11").val();
        let pass = $("#form2Example22").val();
        
        console.log(korIme, pass);
        if(korIme == "" || pass == ""){
            $("#odgPrijava").html("Morate uneti sve podatke!");
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
    
})