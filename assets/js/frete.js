// Pega os elementos da página pelo id
const lista = document.getElementById('lista-produtos');
const botaoAdicionar = document.getElementById('btn-adicionar');

// Quando clicar em "+ Adicionar produto"...
botaoAdicionar.addEventListener('click', function () {
    // copia a primeira linha de produto
    const primeiraLinha = lista.querySelector('.linha-produto');
    const novaLinha = primeiraLinha.cloneNode(true);

    // limpa a cópia: nenhum produto escolhido e quantidade 1
    novaLinha.querySelector('select').value = '';
    novaLinha.querySelector('input').value = 1;

    // coloca a cópia no final da lista
    lista.appendChild(novaLinha);
});

// Quando clicar em algum botão "Remover"...
lista.addEventListener('click', function (evento) {
    if (evento.target.classList.contains('btn-remover')) {
        const linhas = lista.querySelectorAll('.linha-produto');

        if (linhas.length > 1) {
            // apaga a linha onde está o botão clicado
            evento.target.closest('.linha-produto').remove();
        } else {
            alert('O frete precisa ter pelo menos um produto.');
        }
    }
});