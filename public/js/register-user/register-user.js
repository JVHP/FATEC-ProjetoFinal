function getCEPInfos(event) {
    if (event.length == 8) {
        let formCadastro = document.forms.cadastro;
        let inputCep = formCadastro.cep;
        let inputRua = formCadastro.nm_rua;
        let inputBairro = formCadastro.ds_bairro;
        let inputNrCasa = formCadastro.nr_casa;

        axios.get(`https://viacep.com.br/ws/${event}/json/`)
        .then(resp => {        
            if (resp.data.erro) {
                return formCadastro.cep.classList.add('is-invalid')
            }

            formCadastro.cep.classList.remove('is-invalid')
            inputRua.setAttribute('value', resp.data.logradouro);
            inputBairro.setAttribute('value', resp.data.bairro);
            inputNrCasa.disabled = false;

        }).catch(ex => {
            return formCadastro.cep.classList.add('is-invalid')
        })
        
    }
}

function getCars() {
    let formCadastro = document.forms.cadastro
    let marca = formCadastro.id_marca
    let ano = formCadastro.ano_carro

    let div = document.querySelector("#accordionExample");

    axios.get(`/carros-registro/${ano.value}/${marca.value}`)
    .then(resp => {
            div.innerHTML = "";

            if (resp.data.length == 0) {
                return createErrorElement("Não foram encontrados carros");
            }
            
            removeErrorElement()

            Object.keys(resp.data).map(tipos => {
                createAccordionDiv(tipos, resp.data[tipos])
            })

    })
    .catch((ex) => {
        console.log(ex)
        createErrorElement("Ocorreu um erro ao buscar os carros");
    })

} 

function createAccordionDiv(tipo, carros) {
    let accordion = document.querySelector("#accordionExample");

    let accordionItem = document.createElement("div");
    accordionItem.classList.add("accordion-item");

    let h2Tipo = document.createElement("h2");
    h2Tipo.classList.add("accordion-header");
    h2Tipo.setAttribute("id", `heading${tipo}`);

    let btnTrigger = document.createElement("button");
    btnTrigger.classList.add("accordion-button", "collapsed");
    btnTrigger.setAttribute("type", "button");
    btnTrigger.setAttribute("data-bs-toggle", "collapse");
    btnTrigger.setAttribute("data-bs-target", `#collapse${tipo}`);
    btnTrigger.setAttribute("aria-expanded", "false");
    btnTrigger.setAttribute("aria-controls", `collapse${tipo}`);
    btnTrigger.innerHTML = tipo;
    
    h2Tipo.appendChild(btnTrigger);
    accordionItem.appendChild(h2Tipo);
    accordion.appendChild(accordionItem);

    let divCollapse = document.createElement("div");
    divCollapse.classList.add("accordion-collapse", "collapse");
    divCollapse.setAttribute("id", `collapse${tipo}`)
    divCollapse.setAttribute("aria-labelledby", `heading${tipo}`)
    divCollapse.setAttribute("data-bs-parent", "#accordionExample")
    
    let divBody = document.createElement("div");
    divBody.classList.add("accordion-body", "row", "col-12");
    
    carros.map(carro => {    
        let inputCar = createCarInput(carro);
        
        let labelCar = document.createElement("label")
        labelCar.classList.add("btn", "btn-outline-success")
        labelCar.setAttribute("for", `btn-check${carro.id}`)
        labelCar.innerHTML = carro.nm_carro
    
    
        let divCol = document.createElement("div")
        divCol.classList.add("col-auto", "m-1")
    
        divCol.appendChild(inputCar)
        divCol.appendChild(labelCar)
    
        divBody.append(divCol)
    })

    divCollapse.appendChild(divBody)

    accordionItem.appendChild(divCollapse)    

    accordion.appendChild(accordionItem)
}

function createCarInput(carro) {
    let inputCar = document.createElement("input")

    inputCar.classList.add("form-check", "btn-check")
    inputCar.setAttribute("type", "checkbox")
    inputCar.setAttribute("value", carro.id)
    inputCar.setAttribute("name", "carros[]")
    inputCar.setAttribute("id", `btn-check${carro.id}`)

    inputCar.addEventListener("click", function (event) {
        let divCarrosLista = document.querySelector("#carroslista")

        let divCarroAtual = document.querySelector(`#${carro.nm_carro}`)

        if (divCarroAtual != null) {
            divCarrosLista.removeChild(divCarroAtual)

        } else {
            let divMain = document.createElement("div")
            divMain.classList.add("card", "p-2", "m-3")
            divMain.setAttribute("id", carro.nm_carro)

            divCarroAtual = document.createElement("div")
            divCarroAtual.setAttribute("id", `autal${carro.nm_carro}`)
            divCarroAtual.classList.add("row", "col-12", "mx-auto", "py-2")

            let DivCarro = document.createElement("div");
            let DivKm1 = document.createElement("div");
            let DivMediaKm2 = document.createElement("div");
            let Div3 = document.createElement("div");

            DivCarro.classList.add("col-3", "h-3", "my-auto")
            DivKm1.classList.add("col-3", "form-floating")
            DivMediaKm2.classList.add("col-3", "form-floating")
            Div3.classList.add("col-3", "form-floating")

            let LabelCarro = document.createElement("h3");
            LabelCarro.classList.add("my-auto");

            let inputKm = document.createElement("input");
            let inputMediaKm = document.createElement("input");
            let input3 = document.createElement("input");
            let inputHidden = document.createElement("input");

            let labelKm = document.createElement("label");
            let labelMediaKm = document.createElement("label");
            let label3 = document.createElement("label");
            labelKm.classList.add("ms-2")
            labelMediaKm.classList.add("ms-2")
            label3.classList.add("ms-2")

            labelKm.innerHTML = "Kilômetros rodados"
            labelMediaKm.innerHTML = "Média aproximada de kilômetros por semana"
            label3.innerHTML = "Ainda sem atribuição"

            LabelCarro.innerHTML = carro.nm_carro

            inputHidden.setAttribute("name", `carros[${carro.id}][id]`)
            inputHidden.setAttribute("value", `${carro.id}`)
            inputHidden.setAttribute("type", "hidden")

            inputKm.classList.add("form-control")
            inputKm.setAttribute("type", "number")
            inputKm.setAttribute("placeholder", "Kilômetros rodados")
            inputKm.setAttribute("name", `carros[${carro.id}][km]`)
            inputKm.setAttribute("value",  `0`)

            inputMediaKm.classList.add("form-control")
            inputMediaKm.setAttribute("type", "number")
            inputMediaKm.setAttribute("placeholder", "Média de kilômetros")
            inputMediaKm.setAttribute("name",  `carros[${carro.id}][media_km]`)
            inputMediaKm.setAttribute("value",  `0`)

            input3.classList.add("form-control")
            input3.setAttribute("type", "number")
            input3.setAttribute("placeholder", "Ainda sem atribuição")
            input3.setAttribute("name",  `carros[${carro.id}][input3]`)
            input3.setAttribute("value",  `0`)
            
            DivCarro.appendChild(LabelCarro)
            DivKm1.appendChild(inputKm)
            DivMediaKm2.appendChild(inputMediaKm)
            Div3.appendChild(input3)
            Div3.appendChild(inputHidden)

            DivKm1.appendChild(labelKm)
            DivMediaKm2.appendChild(labelMediaKm)
            Div3.appendChild(label3)

            divCarroAtual.appendChild(DivCarro)
            divCarroAtual.appendChild(DivKm1)
            divCarroAtual.appendChild(DivMediaKm2)
            divCarroAtual.appendChild(Div3)

           /*  divCarroAtual.innerHTML = carro.nm_carro */

            divMain.appendChild(divCarroAtual)
            divCarrosLista.appendChild(divMain)
        }
    })

    return inputCar
}

function adicionarLinhaCarro(carro) {
    console.log(carro)
}

function removeErrorElement() {
    let div = document.querySelector("#divSearch");
    let texto_erro_old = document.querySelector("#texto");

    if (texto_erro_old != null) {
        div.removeChild(texto_erro_old);
    }
}

function createErrorElement(mensagem_erro) {
    removeErrorElement();

    let div = document.querySelector("#divSearch");

    let texto_erro = document.createElement("p");
    texto_erro.setAttribute("id", "texto");
    texto_erro.classList.add("text-danger", "p-0", "m-0", "mx-auto");
    texto_erro.append(mensagem_erro)
    console.log(texto_erro)
    div.appendChild(texto_erro)
}
