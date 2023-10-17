window.addEventListener("DOMContentLoaded", function () {
    console.log("Tienes acceso a todos los recursos.");

  

    const nodeCreate = document.querySelector("a[href='create.php']");
    const nodeButtonCreate = document.querySelector("form[name='from_create'] input[type='button']");
    const nodeWrapperCreate = document.querySelector(".wrappercreate");


    const nodeLogout = document.querySelector("a[href='logout.php']");


    if (nodeCreate !== null) {
        nodeCreate.addEventListener("click", showFormCreate);

    }
    if (nodeLogout !== null) {
        nodeLogout.addEventListener("click", logout)

    }
    nodeButtonCreate.addEventListener("click", registry);
    nodeWrapperCreate.addEventListener("click", exitOverlayWrapperCreate);
   

});

function hiddenClass() {
    const nodeWrapperLogin = document.querySelector(".wrapperlogin");
    if (!nodeWrapperLogin.classList.contains("hiddenD")) {
        nodeWrapperLogin.classList.add("hiddenD");
        console.log("hola");

    }

}
function exitOverlayWrapperCreate(event) {
    if (event.target === this) {
        this.classList.add("hiddenD");
    }
}

function showFormCreate(event) {

    event.preventDefault();
    const nodeWrapperCreate = document.querySelector(".wrappercreate");

    nodeWrapperCreate.classList.remove("hiddenD");
}


function isValidCreate() {
   
    let returnCreate = true;


    const nodeEmail = document.querySelector("form[name='from_create'] input[name='email']");

    if (nodeEmail.value.trim() === "") {
        returnCreate = false;
    }

    return returnCreate;
}

function Create() {

    console.log("aaaa", from_create.email.value);
    console.log("bbbb", from_create.password.value);

    const dataRequest = {
        action: "setCreate",
        nomusuario: from_create.nomcliente.value,
        dni: from_create.telefono.value,
        email: from_create.email.value,
        password: from_create.password.value
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
                console.log("Convirtiendo estructura JSON to Javascript.");
                return JSON.parse(body);
            } catch {
                console.error("La información recibida no es una estructura JSON");
                throw Error(body);
            }
        })
        .then((dataReturn) => {
            console.log("dataReturn", dataReturn);
            const nodeMessage = document.querySelector(".message");


            setTimeout(() => {
                nodeMessage.classList.add("hiddenD");
            }, "5000");
            const dataRequestLogin = {
                action: "login",
                email: dataRequest.email,
                password: dataRequest.password
            };
            login(dataRequestLogin);


        })
        .catch((error) => {
            console.log("La información recibida es la siguiente:");
            console.error(error);
        });
}

function registry() {
    
    let nameUser = document.querySelector("form[name='from_create'] input[name='nomcliente']");
    let telefono = document.querySelector("form[name='from_create'] input[name='telefono']");
    let email = document.querySelector("form[name='from_create'] input[name='email']");
    let password = document.querySelector("form[name='from_create'] input[name='password']");

 
    let dataRequest = {
        action: "setCreate",
        nomcliente: nameUser.value,
        telefono: telefono.value,
        email: email.value,
        password: password.value
    };

    console.log(dataRequest);

    fetch(location.origin + "/MVC_P_Colon/v2/app/ajax/request_Fetch.php", {
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
            console.log("dataReturn:", dataReturn);

            if (dataReturn.result) {
                // Mostrar el mensaje "Registro exitoso"
                const registroExitoso = document.getElementById("registroExitoso");
                registroExitoso.classList.remove("hiddenD");

                // También puedes limpiar los campos del formulario o realizar otras acciones aquí

            } else {
                const nodeMessageError = document.querySelector(".formlogin__messageerror");
                nodeMessageError.classList.remove("hiddenV");
                nodeMessageError.textContent = "Usuario o contraseña incorrectos";
                from_create.email.value = "";
                from_create.password.value = "";
            }
        })
        .catch((error) => {
            console.log("La información recibida es la siguiente:");
            console.error(error);
        });
}
