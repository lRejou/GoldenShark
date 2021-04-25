const newModal = {
    initModal : function(buttonModal , modal){

        // Récupération du titre et du Text
        let selecteurModal = "#" + modal;
        let selecteurTitre =  selecteurModal + " .titreModal";
        var titreModal = $(selecteurTitre).html();
        let selecteurText = selecteurModal + " .contentModal";
        var textModal = $(selecteurText).html();

        //Mise en plase du HTML
        $(selecteurModal).html(`
        <div class="modalContainer">
            <div class="buttonCloseModal"><i class="fas fa-times"></i></div>
            <div class="containerTitreModal">${titreModal}</div>
            <div class="containerTextModal">${textModal}</div>
        </div>
        `);

        console.log("ça passe");

        //====================Définition du CSS=====================
        //background noir du modal
        $(selecteurModal).css({
            "display" : "none",
            "position" : "fixed",
            "top" : "0",
            "left" : "0",
            "z-index" : "100",
            "height" : "100%",
            "width" : "100%",
            "background-color" : "rgba(0,0,0,0.8)"
        });

        //Container du modal
        $(selecteurModal + " .modalContainer" ).css({
            "display" : "block",
            "position" : "fixed",
            "top" : "50%",
            "left" : "50%",
            "transform" : "translate(-50%, -50%)",
            "z-index" : "101",
            "height" : "auto",
            "width" : "350px",
            "background-color" : "white",
            "font-family" : "Montserrat"
        });

        // Button close du modal
        $(selecteurModal + " .buttonCloseModal" ).css({
            "display" : "block",
            "position" : "absolute",
            "top" : "3px",
            "right" : "5px",
            "color" : "black",
            "font-size" : "30px",
            "cursor" : "pointer"
        });

        $(selecteurModal + " .containerTitreModal" ).css({
            "color" : "#2874A6",
            "font-size" : "20px",
            "text-align" : "center",
            "margin" : "30px",
            "font-weight" : "500"
        });

        $(selecteurModal + " .containerTextModal" ).css({
            "color" : "#494949",
            "font-size" : "16px",
            "margin" : "20px"
        });


        //Button Open Modal
        $("#" + buttonModal).click(function(){
            $(selecteurModal).css({
                "display" : "block"
            });
        });

        //Button close Modal
        $(selecteurModal + " .buttonCloseModal").click(function(){
            $(selecteurModal).css({
                "display" : "none"
            });
        });

        console.log(titreModal);
        console.log(textModal);



    }
}