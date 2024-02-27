window.addEventListener("resize",anchoPagina)

const btnIniciarSesion = document.querySelector("#btnIniciarSesion")
btnIniciarSesion.addEventListener("click",iniciarSesion)

const btnRegistrarse = document.querySelector("#btnRegistrarse")
btnRegistrarse.addEventListener("click",registrar)

let conteinerLoginRegistrar = document.querySelector(".container-login-registrar")
let formLogin = document.querySelector(".form-login")
let formRegistrar = document.querySelector(".form-registrar")
let containerLogin = document.querySelector(".container-login")  
let containerRegistrar = document.querySelector(".container-registrar") 

function anchoPagina(){
    if(window.innerWidth > 850){
        containerLogin.style.display="block"
        containerRegistrar.style.display="block"
    }else{
        containerRegistrar.style.display="block"
        containerRegistrar.style.opacity="1"
        containerLogin.style.display="none"
        formLogin.style.display="block"
        formRegistrar.style.display="none"
        conteinerLoginRegistrar.style.left ="0px"
    }
}
anchoPagina()
function iniciarSesion(){
    if(window.innerWidth>850){
        formRegistrar.style.display="none"
        conteinerLoginRegistrar.style.left ="10px"
        formLogin.style.display="block"
        containerRegistrar.style.opacity="1"
        containerLogin.style.opacity="0"
    }else{
        formRegistrar.style.display="none"
        conteinerLoginRegistrar.style.left ="0px"
        formLogin.style.display="block"
        containerRegistrar.style.display="block"
        containerLogin.style.display="none"
    }
} 

function registrar(){
    if(window.innerWidth>850){
        formRegistrar.style.display="block"
        conteinerLoginRegistrar.style.left ="410px"
        formLogin.style.display="none"
        containerRegistrar.style.opacity="0"
        containerLogin.style.opacity="1"
    }else{
        formRegistrar.style.display="block"
        conteinerLoginRegistrar.style.left ="0px"
        formLogin.style.display="none"
        containerRegistrar.style.display="none"
        containerLogin.style.display="block"
        containerLogin.style.opacity="1"
    }
} 
