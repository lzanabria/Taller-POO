addEventListener("DOMContentLoaded", (e) => {
    let form = document.querySelector("#myform");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        let peticion = await fetch(form.action);
        let respuesta = await peticion.json();
    
        if (e.submitter.id == "calc") {
            respuesta.forEach((element, id) => {
                if(id==20){
                    document.querySelector("#res").value += "\n"+element.total;
                }else{
                    document.querySelector("#res").value += element.mensaje+"\n";
                }
            });
        }
        else if (e.submitter.id == "reiniciar") {
            form.reset();
        }
    });
});