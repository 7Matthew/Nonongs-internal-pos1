$(document).ready(function(){
    for (let counter = 0; counter < 100; counter++) {
        $("#"+counter).click(function(){
            $("#hide"+counter).toggle(300);
        });
        $("#remove"+counter).click(function(){
            $("#hide"+counter).hide();
        });
       
    }  
});
