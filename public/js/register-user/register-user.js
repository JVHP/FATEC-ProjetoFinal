



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
    removeErrorElement()

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

            resp.data.map(carro => {

                /* <div class="col-auto m-2">
                    <input class="form-check btn-check" type="checkbox"
                        id="btn-check{{ $carro->id }}" name="carros[]"
                        value="{{ $carro->id }}" id="">
                    <label class="btn btn-outline-success"
                        for="btn-check{{ $carro->id }}" for="">
                        {{ $carro->nm_carro }}
                    </label>
                </div> */

                let inputCar = document.createElement("input")
                inputCar.classList.add("form-check")
                inputCar.classList.add("btn-check")
                inputCar.setAttribute("type", "checkbox")
                inputCar.setAttribute("name", "carros[]")
                inputCar.setAttribute("value",  carro.id)
                inputCar.setAttribute("id", `btn-check${carro.id}`)
                inputCar.addEventListener("click", function (event) {
                    let divCarrosLista = document.querySelector("#carroslista")

                    let divCarroAtual = document.querySelector(`#${carro.nm_carro}`)

                    if (divCarroAtual != null) {
                        divCarrosLista.removeChild(divCarroAtual)
                    } else {
                        divCarroAtual = document.createElement("div")
                        divCarroAtual.setAttribute("id", carro.nm_carro)
                        divCarroAtual.innerHTML = carro.nm_carro
                        
                        divCarrosLista.appendChild(divCarroAtual)
                    }
                })

                let labelCar = document.createElement("label")
                labelCar.classList.add("btn")
                labelCar.classList.add("btn-outline-success")
                labelCar.setAttribute("for", `btn-check${carro.id}`)
                labelCar.innerHTML = carro.nm_carro


                let divCol = document.createElement("div")
                divCol.classList.add("col-auto")
                divCol.classList.add("m-2")

                divCol.appendChild(inputCar)
                divCol.appendChild(labelCar)


                div.append(divCol)
            })

    })
    .catch((ex) => {
        createErrorElement("Ocorreu um erro ao buscar os carros");
    })


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
    let div = document.querySelector("#divSearch");

    let texto_erro = document.createElement("p");
    texto_erro.setAttribute("id", "texto");
    texto_erro.classList.add("text-danger");
    texto_erro.classList.add("p-0");
    texto_erro.classList.add("m-0");
    texto_erro.classList.add("mx-auto");
    texto_erro.append(mensagem_erro)
    console.log(texto_erro)
    div.appendChild(texto_erro)
}
