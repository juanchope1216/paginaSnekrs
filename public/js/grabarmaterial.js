window.addEventListener("load", function () {
    console.log("Tienes acceso a todos los recursos.");

    
    const grabarButton = document.querySelector("form[name='form_Materiales'] input[type='button']");
    grabarButton.addEventListener("click", grabarMateriales);

    
});

function grabarMateriales() {
   
    const materialesInput = document.querySelector("form[name='form_Materiales'] input[name='Materiales']");
    const modeloInput = document.querySelector("form[name='form_Materiales'] input[name='modelo']");
    const nodeMessage = document.querySelector(".message");

    const nommaterial = materialesInput.value;
    const idmaterial = modeloInput.value;

    const dataRequest = {
        action: "setMateriales",
        nommaterial: nommaterial,
        idmaterial: idmaterial
    };

    console.log(dataRequest);

    fetch("/MVC_P_Colon/v2/app/ajax/request_Fetch.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(dataRequest)
    })
        .then(function (response) {
            if (response.ok) {
                console.log("Comunicación con el servidor ok.");
                return response.text();
            } else {
                console.log("Parece que no hay comunicación con el servidor.");
                throw Error(response.status);
            }
        })
        .then(function (body) {
            try {
                console.log("Convirtiendo estructura JSON a Javascript.");
                return JSON.parse(body);
            } catch (error) {
                console.error("La información recibida no es una estructura JSON");
                throw error;
            }
        })
        .then(function (dataReturn) {
            console.log("dataReturn", dataReturn);

            nodeMessage.classList.remove("hiddenD");
            materialesInput.value = "";
            modeloInput.value = "0";  // O el valor por defecto que necesites
            setTimeout(function () {
                nodeMessage.classList.add("hiddenD");
            }, 5000);
        })
        .catch(function (error) {
            console.log("La información recibida es la siguiente:");
            console.error(error);
            setTimeout(function () {
                nodeMessage.classList.add("hiddenD");
            }, 5000);

        });
}
