
// llamar a la función generar captcha
generarCaptcha()


// ZONA DE ENVÍO DE FORMULARIO MEDIANTE AJAX

// 1) Recogemos los elementos HTML necesarios
const formulario = document.querySelector("#idForAjax") //recogemos sólo el elemento que tenga el id requerido
const botonEnviarAjax = formulario.querySelector("#botonEnviarAjax")
const inputs = formulario.querySelectorAll("input, textarea") //recogemos en un array todos los input y textarea de formulario

const errorForm02 = document.getElementById("errorForm02")
const loader = document.getElementById("moduleLoader01")

// relativo al modal de envío ok
const modalEnvio = document.querySelector("#modal_envio")
const h3ModalEnvio = document.querySelector("#h3_modal_envio")
const pModalEnvio = document.querySelector("#p_modal_envio")
const botonModalEnvio = document.querySelector('#boton_modal_envio')


botonModalEnvio?.addEventListener("click", function(){
    modalEnvio.style.display="none"
    formulario.style.display="flex"
    formulario.style.filter="initial"  //difumino el form
    botonEnviarAjax.style.pointerEvents="initial" //evito que sea interactuable el botón

    // Iteramos el array "inputs" donde dentro están todos los input y textarea del elemento formulario.
    // en cada iteración el elemento "el" representa el item en cuestión. en cada vuelta el será un input o textarea diferente
    // en cada vuelta pasamos a disable cada input o textarea
    // deshabilito los input y textarea del form
    inputs.forEach(el => {
        el.disabled=false
        if(el.type!="submit" && el.type!="checkbox"){
            el.value=""
        }
        if(el.type=="checkbox"){
            el.checked=false
        }
    });
    generarCaptcha()
})


// Evento de escucha de que se haga submit del form
formulario?.addEventListener("submit", function(e){

    // prevenir la acción por defecto del submit del form
    e.preventDefault()
    // recoger todas las claves/valor del form (inputs)
    const camposFormulario = new FormData(document.forms.namedItem("idForAjax"))


    // OPCIÓN A XMLHTTPREQUEST (AJAX)----------------------
    
    // construimos el objeto de clase xmlHttpRequest
    const xmlhttp = new XMLHttpRequest()
    xmlhttp.onload= function(){
        // esperamos y recibimos respuesta
        if(xmlhttp.status==200){

            // CÓDIGO QUE SE EJECUTA CUANDO HAY RESPUESTA DEL AJAX (SE EJECUTA 2º)
            // ###################################################################
            // cuando recibo código 200, ed sque recibo la respuesta            
            console.log(xmlhttp.responseText)
            let jsonRecibido = xmlhttp.responseText;
            let ArrayJson = JSON.parse(jsonRecibido);
            let mensaje = ArrayJson.mensaje;
            let fallo = ArrayJson.fallo;
            let param3 = ArrayJson.param3; //recibo o el campo donde está el fallo o el nombre del user

            // quito el loader        
            loader.style.display="none" //Quitamos loader

            // si hay fallo en algún campo del form, volvemos al form
            if(fallo == true){

                errorForm02.innerText=mensaje //mostramos error 
                // habilitamos el formulario de nuevo
                botonEnviarAjax.style.pointerEvents="initial"
                formulario.style.filter="initial"
                inputs.forEach(el => {
                    el.disabled=false
                });
                
            // Si no hay ningún fallo, damos por bueno el envío, quitamos el form y damos gracias
            }else{
                // CUANDO NO HAY FALLO Y TODO ES OK
                // Quitamos form y mostramos mensaje de gracias
                formulario.style.display="none"
                modalEnvio.style.display="flex"
                h3ModalEnvio.innerText=mensaje
                pModalEnvio.innerText=`Hemos recibido tu consulta, ${param3}, no te preocupes que en breve te contestaremos. Si estás interesado/a en volver a contactarnos, pulsa el botón para mostrar el formulario.`              
                

                // aquí es donde debemos mostrar el modal con la info relativa y el botón
                
            }

        }
    }
    xmlhttp.open("POST", "App/artForm02.php", true)
    xmlhttp.send(camposFormulario)


    // CÓDIGO QUE SE EJECUTA MIENTRAS ENVÍA Y RECIBE EL AJAX (SE EJECUTA 1º)
    // ####################################################################
    // aquí podría ejecutar código simultáneo al envío
    // muestro loader
    loader.style.display="initial"
    formulario.style.filter="blur(2px)"  //difumino el form
    botonEnviarAjax.style.pointerEvents="none" //evito que sea interactuable el botón

    // Iteramos el array "inputs" donde dentro están todos los input y textarea del elemento formulario.
    // en cada iteración el elemento "el" representa el item en cuestión. en cada vuelta el será un input o textarea diferente
    // en cada vuelta pasamos a disable cada input o textarea
    // deshabilito los input y textarea del form
    inputs.forEach(el => {
        el.disabled=true
    });

    
    

    
    


    // // OPCIÓN B FETCH---------------------- 

    // fetch("App/artForm02.php", { method: "POST", body: camposFormulario })
    // .then(async (res) => {
    //     if (!res.ok) throw new Error(`HTTP ${res.status}`)

    //     const texto = await res.text()
    //     console.log(texto)              // equivalente a xmlhttp.responseText

    //     return JSON.parse(texto)        // equivalente a JSON.parse(xmlhttp.responseText)
    // })
    // .then(({ mensaje, fallo, campo }) => {

    //     // quitaría el loader

    //     // lógica una vez se recibe con éxito la respuesta y los valores
    //     if (fallo === true) {
    //         errorForm02.innerText = mensaje
    //     } else {
    //         formulario.style.display = "none"
    //         h3Form02.innerText = mensaje
    //     }
    // })
    // .catch((err) => {

    //     // quitaría el loader

    //     console.error(err)
    //     errorForm02.innerText = "Ha ocurrido un error al enviar el formulario."
    // })

    // // loader


})


function generarCaptcha(){
    // OBJETOS: 
    // CALCULAR DOS NÚMEROS RANDOM DEL 0 AL 10
    // HACER SU SUMA
    // INSERTARLOS COMO TEXTOS DENTRO DE DOS SPAN DEL HTML.
    // EL RESULTADO DE SU SUMA, INSERTARLO COMO VALUE DENTRO DEL INPUT OCULTO


    // RECOJO EN CONSTANTES LOS ELEMENTOS A LOS QUE LES TENDRÉ QUE INSERTAR LOS NÚMEROS RANDOM Y TAMNBIÉN EL INPUT
    const num1ajax = document.getElementById("num1ajax")
    const num2ajax = document.getElementById("num2ajax")
    const operadorajax = document.getElementById("operadorajax")
    const respSystemajax = document.getElementById("respSystemajax")

    // Esta parte establece un número estático cogido del html
    // let valornum1ajax = (Number)(num1ajax.innerText)
    // let valornum2ajax = (Number)(num2ajax.innerText)

    // GENERO DOS NÚMEROS RANDOM DEL 0 AL 10 Y LOS CONVIERTO A NUMBER PARA PODER OPERAR
    let valornum1ajax = (Number)(Math.floor(Math.random()*10))
    let valornum2ajax = (Number)(Math.floor(Math.random()*10))

    // genero un número del 0 al 3 aleatorio para disponerlo en la selección de la operación matemática
    let valorNum3 = (Number)(Math.floor(Math.random()*3))

    let resultado

    switch(valorNum3){
        case 0:
            // HAGO LA OPERACIÓN MATEMÁTICA CON EL +
            resultado = valornum1ajax + valornum2ajax
            operadorajax.innerText="+"
            break
        case 1:
            // HAGO LA OPERACIÓN MATEMÁTICA CON EL -
            resultado = valornum1ajax - valornum2ajax
            operadorajax.innerText="-"
            break
        case 2: 
            // HAGO LA OPERACIÓN MATEMÁTICA CON EL *
            resultado = valornum1ajax * valornum2ajax
            operadorajax.innerText="x"
            break
        default:
            resultado = valornum1ajax + valornum2ajax
            operadorajax.innerText="+"
            break
    }

    // console.log(valornum1ajax + " + " + valornum2ajax + " = " + resultado)

    // AQUÍ TENEMOS QUE ASIGNAR A LOS SPAN LOS NÚMEROS RANDOM
    num1ajax.innerText = valornum1ajax
    num2ajax.innerText = valornum2ajax


    // ASIGNO EL RESULTADO AL VALUE DEL ELEMENTO HTML REPRESENTADO AQUÍ MEDIANTE LA CONSTANTE
    respSystemajax.value = resultado


}









