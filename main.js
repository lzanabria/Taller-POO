addEventListener("DOMContentLoaded", (e) => {
    let form = document.querySelector("#myform");
    form.addEventListener("submit", async(e) => {
        e.preventDefault();
        let data = Object.fromEntries(new FormData(e.target));
        
        if(e.submitter.id == "save") {
            let config = {
                method: form.method,
                body: JSON.stringify(data)
            };
            let peticion = await fetch(form.action, config);
            let respuesta = await peticion.json();
            document.querySelector(`[name="venta"]`).value="0";
        }

        else if (e.submitter.id == "calc") {
            data.venta = 0;
            let config = {
                method: form.method,
                body: JSON.stringify(data)
            };
            let peticion = await fetch(form.action, config);
            let respuesta = await peticion.text();
            console.log(respuesta);
            document.querySelector("#res").value = respuesta;
        }

        else if (e.submitter.id == "reiniciar") {
            form.reset();
        }
    });
    document.querySelector(`[name="venta"]`).addEventListener("click", (e) => {
        e.target.value = "";
    });
});