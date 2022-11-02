addEventListener("DOMContentLoaded", (e) => {
    let form = document.querySelector("#myform");
    let cont_a = 0, cont_b = 0, cont_c=0;
    let sum_a=0, sum_b=0, sum_c=0, prom_a=0, prom_b=0, prom_c=0;
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        let datos = Object.fromEntries(new FormData(e.target));
        let config = {
            method: form.method,
            body: JSON.stringify(datos)
        };
        let peticion = await fetch(form.action, config);
        let respuesta = await peticion.text();
        
        if (e.submitter.id == "save") {
            let edades = Number(datos.edad);
            if (datos.sex == "masculino") {
                if (datos.carrera == "a") {
                    cont_a++;
                    sum_a += edades;
                    prom_a = sum_a/cont_a;
                    console.log(prom_a);
                }
                if (datos.carrera == "b") {
                    cont_b++;
                    sum_b += edades;
                    prom_b = sum_b / cont_b;
                    console.log(prom_b);
                }
                if (datos.carrera == "c") {
                    cont_c++;
                    sum_c += edades;
                    prom_c = sum_c / cont_c;
                    console.log(prom_c);
                }
            }
        }
        else if (e.submitter.id == "calc") {
            let menor="", res="";
            if(prom_a!=0 && prom_b!=0 && prom_c!=0) {
                menor= Math.min(prom_a, prom_b, prom_c)
                res="Carrera A";
            }
            else if(prom_a==0 && prom_b!=0 && prom_c!=0) {
                menor= Math.min(prom_b, prom_c)
                res=menor;
            }
            else if(prom_b==0 && prom_a!=0 && prom_c!=0) {
                menor= Math.min(prom_a, prom_c)
                res="Carrera B";
            }
            else if(prom_c==0 && prom_a!=0 && prom_b!=0) {
                menor= Math.min(prom_a, prom_b)
                res="Carrera C";
            }
            document.querySelector("#res").value="Carrera con menor promedio de edad: "+res;
            document.querySelector("#prom").value="Promedio de edad: "+menor;
        }
        else if (e.submitter.id == "reiniciar") {
            form.reset();
        }
    });
});