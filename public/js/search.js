window.addEventListener("DOMContentLoaded", function () {
    console.log("Tienes acceso a todos los recursos.");

    const nodeButtonSearch = document.querySelector("form[name='form_search'] input[type='button']");

    nodeButtonSearch.addEventListener("click", search);
});


const searchResults = [];

function search(event) {
    event.preventDefault();

    const nodeSearch = document.querySelector("form[name='form_search'] input[type='text']");
    const nommodelo = nodeSearch.value;

    const dataRequest = {
        action: "search",
        nommodelo: nommodelo 
    };

    console.log(dataRequest);

    fetch("/MVC_P_Colon/v2/app/ajax/request_Fetch.php", {
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
                console.log("Convirtiendo estructura JSON a JavaScript.");
                return JSON.parse(body);
            } catch {
                console.error("La información recibida no es una estructura JSON");
                throw Error(body);
            }
        })
        .then((dataReturn) => {
            console.log("dataReturn------------", dataReturn);

          
            searchResults.push(...dataReturn);

            const nodeinfosearch = document.querySelector(".wrapper-search");
            nodeinfosearch.innerHTML = "";

           
            searchResults.forEach(data => {
                console.log(data);

                nodeinfosearch.innerHTML +=
                    `<div class="wrapper-search">
                        <div class="result-search">
                            <a class="link-search" href="detailsnekrs.php?idModel=${data["idModel"]}">
                            <div class="resulimagen">
    <img class="result-image" src="/MVC_P_Colon/v2/public/img/${data["nameImage"]}" alt="imagenmodelo${data["nameModel"]}">
</div>


                                <p>${data["nameModel"]}</p>
                                <p>${data["price"]}</p>
                                
                            </a>
                        </div>
                    </div>`;
            });

            nodeSearch.value = "";
        })

        .catch((error) => {
            console.log("La información recibida es la siguiente:");
            console.error(error);
        });
}
