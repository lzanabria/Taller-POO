addEventListener("DOMContentLoaded", (e) => {
    let form = document.querySelector("#myform");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        let datos = Object.fromEntries(new FormData(e.target));
        let config = {
            method: form.method,
            body: JSON.stringify(datos)
        };
        let peticion = await fetch(form.action, config);
        let respuesta = await peticion.json();
        if(e.submitter.id == "calc") {
            document.querySelector("#res").value = respuesta.signo_user;
        }
        else {
            form.reset();
        }
    });
});