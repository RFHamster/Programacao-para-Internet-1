window.onload = function () {
    $("figure").each(function() {   
        $(this).hide();
    });

    var miliseconds = 1500;
    $("figure").each(function() {   
        $(this).fadeIn(miliseconds);
        miliseconds +=1500;
    });
}