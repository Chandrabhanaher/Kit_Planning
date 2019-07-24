
$(document).on("click","#for_pass",function(){
    var lof_from = document.getElementById("loginPage");
    var forgot_from = document.getElementById("forgots");
    
    if (lof_from.style.display === "none") {
        lof_from.style.display = "block";
        forgot_from.style.display = "none";
    } else {
        lof_from.style.display = "none";
        forgot_from.style.display = "block";
    }
});


$(document).on("click","#login_hear",function (){
    var lof_from = document.getElementById("loginPage");
    var forgot_from = document.getElementById("forgots");

    if (forgot_from.style.display === "none") {
        forgot_from.style.display = "block";
        lof_from.style.display = "none";
        
    } else {
        forgot_from.style.display = "none";
        lof_from.style.display = "block";
        
    } 
});


