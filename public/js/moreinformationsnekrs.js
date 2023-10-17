document.addEventListener("DOMContentLoaded", function () {
    const nodeMoreInformation = document.querySelector(".moreinformation");

    if (nodeMoreInformation) {
        nodeMoreInformation.addEventListener("click", clicMoreInformation);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    
    var myElement = document.getElementById("myElement");

   
    if (myElement) {
        myElement.addEventListener("click", function () {
           
        });
    }
});


function clicMoreInformation() {
    const nodeLayerSnekrs = document.querySelector(".modelo");
    let idmodelo;

    idmodelo = nodeLayerSnekrs.getAttribute("data-idmodelo");

    const dataRequest = {
        action: "getMoreInformationSnekrs",
        idmodelo: idmodelo
    };

    console.log(dataRequest);
    console.log(location.origin + "/MVC_P_Colon/v2/ajax/request_Fetch.php");
    fetch(location.origin + "/MVC_P_Colon/v2/ajax/request_Fetch.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataRequest)
    })
        .then((response) => {
            if (response.ok) {
                console.log("Comunicación con el servidor ok.");
                return response.text();
            } else {
                console.log("Parece que no hay comunicación con el servidor.");
                throw Error(response.status);
            }
        })
        .then((body) => {
            try {
                console.log("Convirtiendo estructura JSON to Javascript.");
                return JSON.parse(body);
            } catch {
                console.error("La información recibida no es una estructura JSON");
                throw Error(body);
            }
        })
        .then((dataReturn) => {
            const nodeLayerSnekrs = document.querySelector(".modelo ");
            const nodeMoreInformation = document.querySelector(".moreinformation");

            console.log("dataReturn:", dataReturn);
            let layerMoreInformation;

            layerMoreInformation = "<div class='moredataSnekrs'>";
            layerMoreInformation += `    <p>marca: <span>${dataReturn.nameBrand}</span></p>`;
            layerMoreInformation += `    <p>precio: <span>${dataReturn.price}</span></p>`;
            layerMoreInformation += "</div>";

            nodeMoreInformation.classList.add("hiddenD");
            nodeLayerSnekrs.insertAdjacentHTML("beforeend", layerMoreInformation);

        })
        .catch((error) => {
            console.log("La información recibida es la siguiente:");
            console.error(error);
        });
}