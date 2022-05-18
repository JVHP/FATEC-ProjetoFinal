


    //Função para popular o DataList
    let listaPecas = document.getElementById('pecasList');

    let opcaoTodos = document.createElement('option')
    opcaoTodos.text = "Ir para todos"
    opcaoTodos.value = "Ir para todos"
    opcaoTodos.id = "all"
    listaPecas.appendChild(opcaoTodos)


    function getPecas(peca) {
        let i = 0
        var request = $.get('/pecas/nome/' + peca);
        request.then((response) => {
            while (listaPecas.firstChild) {
                listaPecas.removeChild(listaPecas.lastChild)
            }
            var pecas = null
            pecas = response;
            pecas.forEach((item) => {
                i++
                let option = document.createElement('option');
                option.text = "Código: " + item.id
                option.value = item.nm_peca
                option.id = "peca" + i
                listaPecas.appendChild(option)
            })
        })
    }

    //Função seleção opção DataList
    $(document).ready(function() {
        $('#inputPeca').on('change', function() {
            var userText = $(this).val();

            $("#pecasList").find("option").each(function() {
                if ($(this).val() == userText) {
                    irParaPeca($(this).text());
                }
            })
        })
    });

    //Função de pesquisa
    function irParaPeca(peca) {
        window.location = '/pecas/' + peca.substr(8)
    }