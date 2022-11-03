addEventListener("DOMContentLoaded", (e) => {
    let form = document.querySelector("#myform");
    form.addEventListener("submit", async(e) => {
        e.preventDefault();
        let data = Object.fromEntries(new FormData(e.target));
        let config = {
            method: form.method,
            body: JSON.stringify(data)
        };
        let peticion = await fetch(form.action, config);
        let respuesta = await peticion.json();

        if (e.submitter.id == "calc") {
            document.querySelector("#res").value = "La masa de aire de la rueda es: "+respuesta;
        }

        else if (e.submitter.id == "reiniciar") {
            form.reset();
        }
    });
});