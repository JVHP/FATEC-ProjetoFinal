


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
