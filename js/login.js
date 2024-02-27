window.addEventListener("load",()=>{
    const sectionLogin = document.querySelector("#sectionLogin")
    const sectionRecuperarContraseña = document.querySelector("#sectionRecuperarContraseña")
    sectionRecuperarContraseña.style.display="none"
})

const btnRecuperarContraseña = document.querySelector("#aRecuperarContraseña")
btnRecuperarContraseña.addEventListener("click",()=>{
    sectionLogin.style.display="none"
    sectionRecuperarContraseña.style.display="block"
})

const btnIngresar = document.querySelector("#btnIngresar")
btnIngresar.addEventListener("click",()=>{
    const regExp = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
    const email = document.querySelector("#email")
    const regExpPass = /[a-z0-9]{1,15}/
    const password = document.querySelector("#password")
    if(regExp.test(email.value) && regExpPass.test(password.value)){
        location.href='http://localhost:3000/admin.html'
    }
    console.log(email.value)
    console.log(password.value)
})
