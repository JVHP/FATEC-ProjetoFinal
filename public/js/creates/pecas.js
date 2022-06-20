
function pesquisarInfosFilialPeca() {
    let inputFilial = document.querySelector('#id_empresa');
    let pesquisado = document.querySelector('#pesquisado');


    if (inputFilial == null) {
        return null;   
    }

    habilitarDesabilitarBtnPeca(pesquisado.value)

    if (pesquisado.value == "true") {
        pesquisado.value = "false"

        this.limparMarcasPeca(id_empresa)
        this.limparTiposPeca(id_empresa)

    } else {
      
        pesquisado.value = "true"

        let id_empresa = inputFilial.value;

        this.pesquisarMarcasPeca(id_empresa)
        this.pesquisarTiposPeca(id_empresa)

    }
    
}

function pesquisarMarcasPeca(id_empresa) {
    this.carregandoOpcoesMarcasPeca()

    axios.get(`/marcas-peca-filial/${id_empresa}`)
    .then(resp => {
        if (resp.data.length == 0) {
            return this.marcasNaoEncontradasPeca()
        }

        this.montarSelectMarcasPeca(resp.data)
    })
    .catch(ex => {
        this.erroEncontrarMarcasPeca()
    })
}

function montarSelectMarcasPeca(marcas) {
    let selectMarcas = document.querySelector('#id_marca');
    
    this.limparMarcasPeca()

    marcas.map(x => {
        let option = document.createElement('option')

        option.setAttribute("value", x.id);
        option.innerHTML = x.nm_marca;

        selectMarcas.appendChild(option)
    })

    selectMarcas.removeAttribute('disabled')
}

function pesquisarTiposPeca(id_empresa) {
    this.carregandoOpcoesTiposPeca()

    axios.get(`/tipos-peca-filial/${id_empresa}`)
    .then(resp => {

        if (resp.data.length == 0) {
            return this.tiposNaoEncontradosPeca()
        }
        
        this.montarSelectTiposPeca(resp.data)
    })
    .catch(ex => {
        this.erroEncontrarTiposPeca()
    })

}

function montarSelectTiposPeca(tipos) {
    let selectTipos = document.querySelector('#id_tipo_peca');

    this.limparTiposPeca()

    tipos.map(x => {
        let option = document.createElement('option')

        option.setAttribute("value", x.id);
        option.innerHTML = x.nm_tipo;

        selectTipos.appendChild(option)
    })

    selectTipos.removeAttribute('disabled')
}

function carregandoOpcoesMarcasPeca() {
    let selectMarcas = document.querySelector('#id_marca');
    selectMarcas.innerHTML = ""
    selectMarcas.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Pesquisando...";
    selectMarcas.appendChild(optionDefault)
}

function carregandoOpcoesTiposPeca() {
    let selectTipos = document.querySelector('#id_tipo_peca');
    selectTipos.innerHTML = ""
    selectTipos.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Pesquisando...";
    selectTipos.appendChild(optionDefault)
}

function limparMarcasPeca() {
    let selectMarcas = document.querySelector('#id_marca');
    selectMarcas.innerHTML = ""
    selectMarcas.value = ""
    selectMarcas.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Selecione...";
    selectMarcas.appendChild(optionDefault)
}

function limparTiposPeca() {
    let selectTipos = document.querySelector('#id_tipo_peca');
    selectTipos.innerHTML = ""
    selectTipos.value = ""
    selectTipos.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Selecione...";
    selectTipos.appendChild(optionDefault)
}

function marcasNaoEncontradasPeca() {
    let selectMarcas = document.querySelector('#id_marca');
    selectMarcas.innerHTML = ""
    selectMarcas.value = ""
    selectMarcas.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Filial não contém marcas cadastradas";
    selectMarcas.appendChild(optionDefault)
}

function tiposNaoEncontradosPeca() {
    let selectTipos = document.querySelector('#id_tipo_peca');
    selectTipos.innerHTML = ""
    selectTipos.value = ""
    selectTipos.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Filial não contém tipos de peça cadastradas";
    selectTipos.appendChild(optionDefault)
}

function erroEncontrarMarcasPeca() {
    let selectMarcas = document.querySelector('#id_marca');
    selectMarcas.innerHTML = ""
    selectMarcas.value = ""
    selectMarcas.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Ocorreu um erro ao pesquisar marcas";
    selectMarcas.appendChild(optionDefault)
}

function erroEncontrarTiposPeca() {
    let selectTipos = document.querySelector('#id_tipo_peca');
    selectTipos.innerHTML = ""
    selectTipos.value = ""
    selectTipos.setAttribute("disabled", "true");
    let optionDefault = document.createElement('option')
    optionDefault.setAttribute("value", "");
    optionDefault.setAttribute("disabled", "true");
    optionDefault.setAttribute("selected", "true");
    optionDefault.innerHTML = "Ocorreu um erro ao pesquisar tipos";
    selectTipos.appendChild(optionDefault)
}

function habilitarDesabilitarBtnPeca(pesquisado) {
    let btnFilial = document.querySelector('#btn_empresa');

    if (pesquisado == "true") {
        pesquisado.value = "false"
        btnFilial.classList.remove('btn-danger')
        btnFilial.classList.add('btn-primary')
    } else {
        pesquisado.value = "false"
        btnFilial.classList.remove('btn-primary')
        btnFilial.classList.add('btn-danger')
    }
}


function limparPesquisaPeca() {
    let btnFilial = document.querySelector('#btn_empresa');
    let pesquisado = document.querySelector('#pesquisado');

    pesquisado.value = "false"

    btnFilial.classList.remove('btn-danger')
    btnFilial.classList.add('btn-primary')
    
    this.limparMarcasPeca(id_empresa)
    this.limparTiposPeca(id_empresa)
}