function trocarExibicao(tab) {
    let tabUser = document.querySelector("#banner_usuario"); 
    let tabComp = document.querySelector("#banner_empresa");
    let btnUser = document.querySelector("#btn_usuario");
    let btnComp = document.querySelector("#btn_empresa");
    let formComp = document.querySelector("#form_empresa");
    let formUser = document.querySelector("#form_usuario");
    switch(tab) {
        case "usr": 
            tabUser.classList.remove('hidden')
            tabComp.classList.add('hidden')

            formUser.classList.remove('hidden')
            formComp.classList.add('hidden')

            btnUser.setAttribute("checked", "true")
            btnComp.removeAttribute("checked")

            break;
        case "cmp":
            tabUser.classList.add('hidden')
            tabComp.classList.remove('hidden')

            formComp.classList.remove('hidden')
            formUser.classList.add('hidden')

            btnComp.setAttribute("checked", "true")
            btnUser.removeAttribute("checked")

            break;
        default:
            console.log("Não foi encontrada tab escolhida no botão");
    }
}

function irParaLogin() {
    window.location = '/login'
}