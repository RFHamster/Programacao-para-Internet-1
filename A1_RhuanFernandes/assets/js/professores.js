window.onload = function(){
    let i = 1;
    $("tr").each(function (){
        if(i % 2 != 0){
            $(this).css("background-color", "white");
        }else{
            $(this).css("background-color", "gray");
        }
        i++;
    });

    i = 1;
    $("li").each(function (){
        if(i % 2 != 0){
            $(this).css("color", "black");
        }else{
            $(this).css("color", "gray");
        }
        i++;
    });

}