$(document).ready(function () {
    $("#fold").click( function (){
        if($(this).hasClass("helperClass")){
         $(this).find("p").text("Expand it");
    
        }else{
          $(this).find("p").text("Fold it");
        }
        $(this).toggleClass("helperClass");
      });
});