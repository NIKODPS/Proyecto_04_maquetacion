

// OBJETOS: 
// CALCULAR DOS NÚMEROS RANDOM DEL 0 AL 10
// HACER SU SUMA
// INSERTARLOS COMO TEXTOS DENTRO DE DOS SPAN DEL HTML.
// EL RESULTADO DE SU SUMA, INSERTARLO COMO VALUE DENTRO DEL INPUT OCULTO


// RECOJO EN CONSTANTES LOS ELEMENTOS A LOS QUE LES TENDRÉ QUE INSERTAR LOS NÚMEROS RANDOM Y TAMNBIÉN EL INPUT
const num1 = document.getElementById("num1")
const num2 = document.getElementById("num2")
const operador = document.getElementById("operador")
const respSystem = document.getElementById("respSystem")

// Esta parte establece un número estático cogido del html
// let valorNum1 = (Number)(num1.innerText)
// let valorNum2 = (Number)(num2.innerText)

// GENERO DOS NÚMEROS RANDOM DEL 0 AL 10 Y LOS CONVIERTO A NUMBER PARA PODER OPERAR
let valorNum1 = (Number)(Math.floor(Math.random()*10))
let valorNum2 = (Number)(Math.floor(Math.random()*10))

// genero un número del 0 al 3 aleatorio para disponerlo en la selección de la operación matemática
let valorNum3 = (Number)(Math.floor(Math.random()*3))

let resultado

switch(valorNum3){
    case 0:
        // HAGO LA OPERACIÓN MATEMÁTICA CON EL +
        resultado = valorNum1 + valorNum2
        operador.innerText="+"
        break
    case 1:
        // HAGO LA OPERACIÓN MATEMÁTICA CON EL -
        resultado = valorNum1 - valorNum2
        operador.innerText="-"
        break
    case 2: 
        // HAGO LA OPERACIÓN MATEMÁTICA CON EL *
        resultado = valorNum1 * valorNum2
        operador.innerText="x"
        break
    default:
        resultado = valorNum1 + valorNum2
        operador.innerText="+"
        break
}

// console.log(valorNum1 + " + " + valorNum2 + " = " + resultado)

// AQUÍ TENEMOS QUE ASIGNAR A LOS SPAN LOS NÚMEROS RANDOM
num1.innerText = valorNum1
num2.innerText = valorNum2


// ASIGNO EL RESULTADO AL VALUE DEL ELEMENTO HTML REPRESENTADO AQUÍ MEDIANTE LA CONSTANTE
respSystem.value = resultado



