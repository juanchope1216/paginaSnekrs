window.addEventListener("load", function () {
    console.log("Tienes acceso a todos los recursos.");

    
    const nodeLogin = document.querySelector("a[href='login.php']");
    const nodeButtonLogin = document.querySelector("form[name='login'] input[type='button']");
    const nodeWrapperLogin = document.querySelector(".wrapperlogin");
    const nodeLogout = document.querySelector("a[href='logout.php']");



  
    if (nodeLogin !== null) {
        nodeLogin.addEventListener("click", showFormLogin);
    }
    if (nodeLogout !== null) {
        nodeLogout.addEventListener("click", logout);
    }
    nodeButtonLogin.addEventListener("click", login);
    nodeWrapperLogin.addEventListener("click", exitOverlayWrapperLogin);
});

function exitOverlayWrapperLogin(event) {
    if (event.target === this) {
        this.classList.add("hiddenD");
    }
}

function showFormLogin(event) {

    event.preventDefault();
    const nodeWrapperLogin = document.querySelector(".wrapperlogin");

    nodeWrapperLogin.classList.remove("hiddenD");
}

function isValidLogin() {
    // Validar los campo de email y contraseña.
    let returnLogin = true;

    const nodeEmail = document.querySelector("form[name='login'] input[name='email']");

    if (nodeEmail.value.trim() === "") {
        returnLogin = false;
    }

    return returnLogin;
}

function login(event) {
    if (isValidLogin()) {
        const nodeEmail = document.querySelector("form[name='login'] input[name='email']");
        const nodePassword = document.querySelector("form[name='login'] input[name='password']");

        const dataRequest = {
            action: "login",
            email: nodeEmail.value,
            password: nodePassword.value
        };

        console.log(dataRequest);
        fetch(location.origin + ROUTEAPP + "/app/ajax/request_Fetch.php", {
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

                if (dataReturn.result) { // Logeo correcto.
                    const nodeWrapperLogin = document.querySelector(".wrapperlogin");
                    const nodeWrapperWelcomeLogin = document.querySelector(".wrapperwelcomelogin");

                    nodeWrapperLogin.classList.add("hiddenD");
                    nodeEmail.value = "";
                    nodePassword.value = "";

                    layerLogin = `<p>Hola ${dataReturn.name}</p>`;
                    layerLogin += "<p><a href='logout.php'>Cerrar Sesion</a></p>";

                    nodeWrapperWelcomeLogin.innerHTML = layerLogin;
                    const nodeLogout = document.querySelector("a[href='logout.php']");
                    console.log(nodeLogout);
                    nodeLogout.addEventListener("click", logout);

                } else { // Mal email y password.
                    const nodeMessageError = document.querySelector(".formlogin__messageerror");
                    nodeMessageError.classList.remove("hiddenV");
                    nodeEmail.value = "";
                    nodePassword.value = "";
                }

            })
            .catch((error) => {
                console.log("La información recibida es la siguiente:");
                console.error(error);
            });
    }
}

function logout(event) {
    event.preventDefault();

    const dataRequest = {
        action: "logout"
    };

    console.log(dataRequest);
    fetch(location.origin + ROUTEAPP + "/app/ajax/request_Fetch.php", {
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
            const nodeWrapperWelcomeLogin = document.querySelector(".wrapperwelcomelogin");

            console.log("typeof dataReturn:", typeof dataReturn);
            console.log("dataReturn:", dataReturn);

            

            nodeWrapperWelcomeLogin.innerHTML = layerLogin;
            const nodeLogin = document.querySelector("a[href='login.php']");

            
            nodeLogin.addEventListener("click", showFormLogin);

        })
        .catch((error) => {
            console.log("La información recibida es la siguiente:");
            console.error(error);
        });
}

