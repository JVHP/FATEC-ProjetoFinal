function exibirTodosCarrosPeca(id_peca) {
    let carrosPeca = document.querySelector('#carrosPeca'+id_peca)
    let cardBody = document.querySelector('#peca'+id_peca)

    if (carrosPeca != null) {
        if (carrosPeca.classList.contains("d-flex")) {
            carrosPeca.classList.remove("d-flex", "gap-1", "text-truncate")
            cardBody.classList.add("overflow-auto")
        } else {
            carrosPeca.classList.add("d-flex", "gap-1", "text-truncate")
            cardBody.classList.remove("overflow-auto")
        }

    }

}