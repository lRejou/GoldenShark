var menuOpen = true;


$( "#MenuOpenClose" ).click(function() {
    
    if(menuOpen === true){
        $("main").css({ "margin" : "80px 0px 0px 100px"});
        $(".MenuTextButton").css({"display" : "none"});
        $(".menuSimpleLink").css({"width" : "80px", "text-align" : "center", "padding-left" : "0px" });
        $(".containerLinkMenu").css({"width" : "80px"});
        $("#MenuApp").css({"width" : "80px", "transition" : "0.3s"});
        $("#MenuOpenClose").css({"transition": "0.2s","transform" : "rotate(180deg)"});
        menuOpen = false;
    }
    else{
        $("main").css({ "margin" : "80px 0px 0px 300px"});
        $(".menuSimpleLink").css({"width" : "250px", "text-align" : "left", "padding-left" : "10px" });
        $(".containerLinkMenu").css({"width" : "250px"});
        $("#MenuApp").css({"width" : "250px", "transition" : "0.3s"});
        $("#MenuOpenClose").css({"transition": "0.2s","transform" : "rotate(0deg)"});
        setTimeout(function(){
            $(".MenuTextButton").css({"display" : "inline"});
        }, 200)
        menuOpen = true;
    }



});