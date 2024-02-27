window.addEventListener("load",()=>{
    console.log("Andando")

    //Ocultar tablas
    document.querySelector("#sectionCliente").style.display="none"
    document.querySelector("#sectionEquipo").style.display="none"
  
    /* Cliente */
    const btnConsultarClientes = document.querySelector("#btnConsultarClientes")
    btnConsultarClientes.addEventListener("click",ClickbtnConsultarClientes)

    const btnIngresarCliente = document.querySelector("#btnIngresarCliente")
    btnIngresarCliente.addEventListener("click",ClickbtnIngresarCliente)

    /* Equipo */

    const btnConsultarEquipos = document.querySelector("#btnConsultarEquipos")
    btnConsultarEquipos.addEventListener("click",ClickbtnConsultarEquipos)

    const btnIngresarEquipo = document.querySelector("#btnIngresarEquipo")
    btnIngresarEquipo.addEventListener("click",ClickbtnIngresarEquipo)

    const divActualizarCliente = document.querySelector("#divActualizarCliente")
    
    const divActualizarEquipo = document.querySelector("#divActualizarEquipo")


    text_idCli = document.querySelector("#text_idCli")
    text_razonSocial = document.querySelector("#text_razonSocial")
    text_dniCli = document.querySelector("#text_dniCli")
    text_telCli = document.querySelector("#text_telCli")
    text_estadoCli = document.querySelector("#text_estadoCli")
    textProvincia = document.querySelector("#textProvincia")
    textDepartamento = document.querySelector("#textDepartamento")
    textLocalidad = document.querySelector("#textLocalidad")
    textCalle = document.querySelector("#textCalle")
    textNumeroCalle = document.querySelector("#textNumeroCalle")
    // const productContainers = [...document.querySelectorAll('.product-container')];
    // const nxtBtn = document.querySelectorAll('.nxt-btn');
    // const preBtn = document.querySelectorAll('.pre-btn');
    
    // productContainers.forEach((item, i) => {
    //     let containerDimensions = item.getBoundingClientRect();
    //     let containerWidth = containerDimensions.width;
    
    //     nxtBtn[i].addEventListener('click', () => {
    //         item.scrollLeft += containerWidth;
    //     })
    
    //     preBtn[i].addEventListener('click', () => {
    //         item.scrollLeft -= containerWidth;
    //     })
    // })

})

/*******************************************************************/
//Buscador
// const input = document.querySelector("#searchInput")
// const  clientesList = document.querySelector("#clientes")
// let clientes = []
// window.addEventListener('DOMContentLoaded',async()=>{
//     const data = await buscarClientes()
//     clientes = data.result_data
//     renderClientes(clientes)
    
// })
// async function buscarClientes(){
//     let Resultado = await fetch(`http://localhost:3000/cliente`)
//     return await Resultado.json()
// }
// input.addEventListener('keyup',(e)=>{
//     //console.log(input.value)
//     const newCliente = clientes.filter(cliente => `${cliente.razonSocialCliente.toLowerCase()}$${cliente.dniCliente.toLowerCase()}`.includes(input.value.toLowerCase()))
//     renderClientes(newCliente)
// })
// const crearItemsClientes = clientes => clientes.map(cliente => `<li>${cliente.razonSocialCliente}</li>`).join(' ')
// function renderClientes(clientes){
//     const itemsString = crearItemsClientes(clientes)
//     clientesList.innerHTML =  itemsString
// }
const input = document.querySelector("#searchInput")
input.addEventListener('input',()=>{
    let clientes = document.querySelectorAll(".clientes")
    for (let i = 0; i < clientes.length; i++) {
        const cliente = clientes[i]
        const colNombre =  cliente.querySelector(".columnaNombre")
        const colDni =  cliente.querySelector(".columnaDni")
        const nombre = colNombre.textContent
        const dni = colDni.textContent 
//|| (!expresion.test(dni) ))
        const expresion = new RegExp(input.value,"i")
        if (expresion.test(nombre) || expresion.test(dni)) {
            cliente.classList.remove("display")            
        } else{
            cliente.classList.add("display")
        }
        //console.log(dni)
    }
})
/*********************************************************************/
/*                  Buscador Equipo */
const inputEquipo = document.querySelector("#searchInputEquipo")
inputEquipo.addEventListener('input',()=>{
    let equipos = document.querySelectorAll(".equipos")
    for (let i = 0; i < equipos.length; i++) {
        const equipo = equipos[i]
        const colCliente =  equipo.querySelector(".columnaCliente")
        const colNumSerie =  equipo.querySelector(".columnaNumSerie")

        const cliente = colCliente.textContent
        const numSerie = colNumSerie.textContent 

        const expresion = new RegExp(inputEquipo.value,"i")
        if (expresion.test(numSerie) || expresion.test(cliente)) {
            equipo.classList.remove("display")            
        } else{
            equipo.classList.add("display")
        }
    }
})
/*********************************************************************/
const HttpEndPointCliente = `http://localhost:3000/cliente`

const ClickbtnIngresarCliente = async ()=>{
    
    let datos = {
        
        razonsocial:text_razonSocial.value,
        dnicli:text_dniCli.value,
        telcli:text_telCli.value,
        estadocli:text_estadoCli.value,
        provincia:text_Provincia.value,
        departamento:text_Departamento.value,
        localidad:text_Localidad.value,
        calle:text_Calle.value,
        numerocalle:text_NumeroCalle.value
    }
    let Resultado = await fetch(HttpEndPointCliente,{
        method:'post',
        body: JSON.stringify(datos),
        headers:{'Content-Type':'application/json'}
    })
    let Datos = await Resultado.json()
    if(Datos.result_estado === 'ok'){
        console.log(Datos.result_data)
        formInsertarCliente.reset()
    } else {
        alert (`Algo salio mal ${Datos.result_message}`)
    }
}
async function deleteFilaCliente(idcli){
    let dato = {
        idcli,
    }
    let Resultado = await fetch(HttpEndPointCliente,{
        method:'delete',
        body: JSON.stringify(dato),
        headers:{'Content-Type':'application/json'}
    })
    let Datos = await Resultado.json()
    if(Datos.result_estado === 'ok'){
        console.log(Datos.result_data)
    } else {
        alert (`Algo salio mal ${Datos.result_message}`)
    }
}
async function UpdateClientes(){
    let datos = {
        idcli:text_idCliActualizar.value,
        razonsocial:text_razonSocialActualizar.value,
        dnicli:text_dniCliActualizar.value,
        telcli:text_telCliActualizar.value,
        estadocli:text_estadoCliActualizar.value,
        provincia:textProvinciaActualizar.value,
        departamento:textDepartamentoActualizar.value,
        localidad:textLocalidadActualizar.value,
        calle:textCalleActualizar.value,
        numerocalle:textNumeroCalleActualizar.value
    }
    let Resultado = await fetch(HttpEndPointCliente,{
        method:'put',
        body: JSON.stringify(datos),
        headers:{'Content-Type':'application/json'}
    })
    let Datos = await Resultado.json()
    if(Datos.result_estado === 'ok'){
        console.log(Datos.result_data)
    } else {
        alert (`Algo salio mal ${Datos.result_message}`)
    }
}
function crearmodalCliente (idcli,razonsocial,dnicli,telcli,estadocli,provincia,departamento,localidad,calle,numerocalle){

    const formActualizarCliente = document.querySelector("#formActualizarCliente")
   
    divActualizarCliente.innerHTML = `
    <label for="message-text" class="col-form-label" >Id Cliente:</label>
    <input type="text" class="form-control" id="text_idCliActualizar" value="${idcli}">

    <label for="message-text" class="col-form-label">Razon Social:</label>
    <input type="text" class="form-control" id="text_razonSocialActualizar" value="${razonsocial}">

    <label for="message-text" class="col-form-label">DNI/CUIT:</label>
    <input type="text" class="form-control" id="text_dniCliActualizar" value="${dnicli}">

    <label for="message-text" class="col-form-label">Numero de Celular:</label>
    <input type="text" class="form-control" id="text_telCliActualizar" value="${telcli}">
    
    
    <label for="message-text" class="col-form-label">Estado: 0 = Activo, 1 = Inactivo</label>
    <input type="text" class="form-control" id="text_estadoCliActualizar" value="${estadocli}">

    <label for="message-text" class="col-form-label">Provincia:</label>
    <input type="text" class="form-control" id="textProvinciaActualizar" value="${provincia}">

    <label for="message-text" class="col-form-label">Departamento:</label>
    <input type="text" class="form-control" id="textDepartamentoActualizar" value="${departamento}">

    <label for="message-text" class="col-form-label">Localidad:</label>
    <input type="text" class="form-control" id="textLocalidadActualizar" value="${localidad}">

    <label for="message-text" class="col-form-label">Calle:</label>
    <input type="text" class="form-control" id="textCalleActualizar" value="${calle}">

    <label for="message-text" class="col-form-label">N° de Calle:</label>
    <input type="text" class="form-control" id="textNumeroCalleActualizar" value="${numerocalle}">
    `
    formActualizarCliente.appendChild(divActualizarCliente)
}
function crearTablaCliente (data){
    data.forEach(cliente => {
        const tbody = document.querySelector("#idTbodyCliente")
        const fila = document.createElement("tr")
        fila.classList.add("clientes")

        const columnaId = document.createElement("td")
        columnaId.innerText = cliente.idCliente 
        fila.appendChild(columnaId)

        const columnaNombre= document.createElement("td")
        columnaNombre.innerText = cliente.razonSocialCliente
        fila.appendChild(columnaNombre)
        columnaNombre.classList.add("columnaNombre")

        const columnaDni = document.createElement("td")
        columnaDni.innerText = cliente.dniCliente 
        fila.appendChild(columnaDni)
        columnaDni.classList.add("columnaDni")

        const columnaTel= document.createElement("td")
        columnaTel.innerText = cliente.telefonoCliente
        fila.appendChild(columnaTel)

        const columnaEstado = document.createElement("td")
        columnaEstado.innerText = cliente.estadoClienteDenominacion 
        fila.appendChild(columnaEstado)

        const columnaProvincia = document.createElement("td")
        columnaProvincia.innerText = cliente.provincia
        fila.appendChild(columnaProvincia)

        const columnaDepartamento = document.createElement("td")
        columnaDepartamento.innerText = cliente.departamento
        fila.appendChild(columnaDepartamento)

        const columnaLocalidad = document.createElement("td")
        columnaLocalidad.innerText = cliente.localidad
        fila.appendChild(columnaLocalidad)

        const columnaCalle = document.createElement("td")
        columnaCalle.innerText = cliente.calle
        fila.appendChild(columnaCalle)

        const columnaNumCalle = document.createElement("td")
        columnaNumCalle.innerText = cliente.numeroCalle
        fila.appendChild(columnaNumCalle)

        // const btnVerDomicilio = document.createElement("td")
        // btnVerDomicilio.innerHTML = `
        // <button type="button" data-bs-toggle="modal" data-bs-target="#ModalVerDomicilio" 
        // class="btn btn-secondary">Ver</button>`
        // fila.appendChild(btnVerDomicilio)
        
        const btnModificarCliente = document.createElement("td")
        btnModificarCliente.innerHTML = `
        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalActualizarCliente" 
        class="btn btn-secondary">Modificar</button>`
        fila.appendChild(btnModificarCliente)

        const btnEliminarCliente= document.createElement("td")
        btnEliminarCliente.innerHTML = `
        <button type="button" class="btn btn-danger">Eliminar</i></button>`
        fila.appendChild(btnEliminarCliente)

        btnModificarCliente.addEventListener("click",()=>{
            divActualizarCliente.innerHTML = ``
            let idcli = cliente.idCliente
            let razonsocial = cliente.razonSocialCliente
            let dnicli = cliente.dniCliente
            let telcli = cliente.telefonoCliente
            let estadocli = cliente.idEstadoCliente
            let provincia = cliente.provincia
            let departamento = cliente.departamento
            let localidad = cliente.localidad
            let calle = cliente.calle
            let numerocalle = cliente.numeroCalle
            //cliente.estadocliente//Revisar aca el dato undefined
            //console.log(estadocli2)
            //let iddomi = cliente.id_Domicilio
            crearmodalCliente(idcli,razonsocial,dnicli,telcli,estadocli,provincia,departamento,localidad,calle,numerocalle)//,estadocli2,iddomi)
        })  
        // btnVerDomicilio.addEventListener("click",()=>{
        //     divActualizarClienteDomicilio.innerHTML = ``
        //     let id = cliente.iddomicilio
        //     let provincia = cliente.provincia
        //     let departamento = cliente.departamento
        //     let localidad = cliente.localidad
        //     let calle = cliente.calle
        //     let numerocalle = cliente.numerocalle
        //     console.log(id,provincia,departamento,localidad,calle,numerocalle)
        //     crearmodalDomicilio(id,provincia,departamento,localidad,calle,numerocalle)
        // })
        btnEliminarCliente.addEventListener("click",async ()=>{
            let idcli = cliente.idCliente
            deleteFilaCliente(idcli)
            console.log(idcli)
        })   
        tbody.appendChild(fila)     
    });
}
const ClickbtnConsultarClientes = async ()=>{

    let Resultado = await fetch(HttpEndPointCliente)
    let Datos = await Resultado.json()

    if(Datos.result_estado === 'ok')
    {
        console.log(Datos.result_data)
        document.querySelector("#tablaCliente tbody").innerHTML = ``
        crearTablaCliente(Datos.result_data)
        mostrarCliente()
    } else {
        alert(`Algo salio mal ${Datos.result_message}`)
    }
}
function mostrarCliente(){
    
    document.querySelector("#sectionCliente").style.display="block"
}
const HttpEndPointEquipo = `http://localhost:3000/equipo`
const ClickbtnConsultarEquipos = async ()=>{

    let Resultado = await fetch(HttpEndPointEquipo)
    let Datos = await Resultado.json()

    if(Datos.result_estado === 'ok')
    {
        console.log(Datos.result_data)
        document.querySelector("#tablaEquipo tbody").innerHTML = ``
        crearTablaEquipo(Datos.result_data)
        mostrarEquipo()
    } else {
        alert(`Algo salio mal ${Datos.result_message}`)
    }
}
function crearmodalEquipo (idequipo,caracteristicas,numCopias,numSerie,idestado,idcliente){

    const formActualizarEquipo = document.querySelector("#formActualizarEquipo")
   
    divActualizarEquipo.innerHTML = `
    <label for="message-text" class="col-form-label" >Id Equipo:</label>
    <input type="text" class="form-control" id="text_idEquipoActualizar" value="${idequipo}">

    <label for="message-text" class="col-form-label">Caracteristicas:</label>
    <input type="text" class="form-control" id="text_caracteristicasActualizar" value="${caracteristicas}">

    <label for="message-text" class="col-form-label">N° copias:</label>
    <input type="text" class="form-control" id="text_cantCopiasActualizar" value="${numCopias}">

    <label for="message-text" class="col-form-label">N° de serie:</label>
    <input type="text" class="form-control" id="text_numSerieActualizar" value="${numSerie}">
    
    
    <label for="message-text" class="col-form-label">Id Estado:1: Alquilado ; 2: Vendido
    3: Stock ; 4: Scrap
    </label>
    <input type="text" class="form-control" id="text_estadoEquipoActualizar" value="${idestado}">

    <label for="message-text" class="col-form-label">Id Cliente: (0 = No Asignado)</label>
    <input type="text" class="form-control" id="text_idCliEquipoActualizar" value="${idcliente}">

    `
    formActualizarEquipo.appendChild(divActualizarEquipo)
}

function crearTablaEquipo (data){
    data.forEach(equipo => {
        const tbody = document.querySelector("#idTbodyEquipo")
        const fila = document.createElement("tr")
        fila.classList.add("equipos")
        
        const columnaId = document.createElement("td")
        columnaId.innerText = equipo.idequipo
        fila.appendChild(columnaId)

        const columnaCaracteristicas= document.createElement("td")
        columnaCaracteristicas.innerText = equipo.caracteristicasequipo
        fila.appendChild(columnaCaracteristicas)

        const columnaCantCopias = document.createElement("td")
        columnaCantCopias.innerText = equipo.cantcopiasequipo 
        fila.appendChild(columnaCantCopias)

        const columnaNumSerie= document.createElement("td")
        columnaNumSerie.innerText = equipo.numeroSerie
        fila.appendChild(columnaNumSerie)
        columnaNumSerie.classList.add("columnaNumSerie")

        const columnaEstado = document.createElement("td")
        columnaEstado.innerText = equipo.estadoEquipoDenominacion 
        fila.appendChild(columnaEstado)

        const columnaCliente = document.createElement("td")
        columnaCliente.innerText = equipo.razonSocialCliente
        fila.appendChild(columnaCliente)
        columnaCliente.classList.add("columnaCliente")

        // const btnVerCliente = document.createElement("td")
        // btnVerCliente.innerHTML = `
        // <button type="button" data-bs-toggle="modal" data-bs-target="#ModalVerCliente" 
        // class="btn btn-secondary">Ver</button>`
        // fila.appendChild(btnVerCliente)

        const btnModificarEquipo = document.createElement("td")
        btnModificarEquipo.innerHTML = `
        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalActualizarEquipo" 
        class="btn btn-secondary">Modificar</button>`
        fila.appendChild(btnModificarEquipo)

        const btnEliminarEquipo= document.createElement("td")
        btnEliminarEquipo.innerHTML = `
        <button type="button" class="btn btn-danger">Eliminar</button>`
        fila.appendChild(btnEliminarEquipo)

        btnModificarEquipo.addEventListener("click",()=>{
            divActualizarEquipo.innerHTML = ``
            let idequipo = equipo.idequipo
            let caracteristicas = equipo.caracteristicasequipo
            let numCopias = equipo.cantcopiasequipo
            let numSerie = equipo.numeroSerie
            let idestado = equipo.estado_equipo
            let idcliente = equipo.id_cliente
            console.log(idcliente)
            crearmodalEquipo(idequipo,caracteristicas,numCopias,numSerie,idestado,idcliente)
        })  
        btnEliminarEquipo.addEventListener("click",async ()=>{
            let id = equipo.idequipo
            deleteFilaEquipo(id)
            console.log(id)
        })   
        tbody.appendChild(fila)     
    });
}
function mostrarEquipo(){
    
    document.querySelector("#sectionEquipo").style.display="block"
}
async function deleteFilaEquipo(id){
    let dato = {
        id,
    }
    let Resultado = await fetch(HttpEndPointEquipo,{
        method:'delete',
        body: JSON.stringify(dato),
        headers:{'Content-Type':'application/json'}
    })
    let Datos = await Resultado.json()
    if(Datos.result_estado === 'ok'){
        console.log(Datos.result_data)
    } else {
        alert (`Algo salio mal ${Datos.result_message}`)
    }
}
const ClickbtnIngresarEquipo = async ()=>{
    
    let datos = {
        caracEquipo:text_caracteristicas.value,
        cantCopias:text_cantCopias.value,
        numSerie:text_numSerie.value,
        estadoEquipo:text_estadoEquipo.value,
        idCli:text_idCliEquipo.value
    }
    let Resultado = await fetch(HttpEndPointEquipo,{
        method:'post',
        body: JSON.stringify(datos),
        headers:{'Content-Type':'application/json'}
    })
    let Datos = await Resultado.json()
    if(Datos.result_estado === 'ok'){
        console.log(Datos.result_data)
        formIngresarEquipo.reset()
    } else {
        alert (`Algo salio mal ${Datos.result_message}`)
    }
}
async function UpdateEquipos(){
    let datos = {
        estadoEquipo:text_estadoEquipoActualizar.value,
        caracEquipo:text_caracteristicasActualizar.value,
        cantCopias:text_cantCopiasActualizar.value,
        numSerie:text_numSerieActualizar.value,
        idCli:text_idCliEquipoActualizar.value,
        idEquipo:text_idEquipoActualizar.value
    }
    let Resultado = await fetch(HttpEndPointEquipo,{
        method:'put',
        body: JSON.stringify(datos),
        headers:{'Content-Type':'application/json'}
    })
    let Datos = await Resultado.json()
    if(Datos.result_estado === 'ok'){
        console.log(Datos.result_data)
    } else {
        alert (`Algo salio mal ${Datos.result_message}`)
    }
}

/*********************************************************/

/*********************************************************/
