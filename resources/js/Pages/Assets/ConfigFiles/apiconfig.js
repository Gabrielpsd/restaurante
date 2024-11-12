export const BASE_URL = 'http://localhost:8000'
export const PRODUTOS = `${BASE_URL}/produtos`
export const PEDIDOS = `${BASE_URL}/pedidos`
export const FORNECEDORES = `${BASE_URL}/fornecedores`
export const PESSOAS = `${BASE_URL}/pessoas`

export default { 
    produtos: {
        lista: PRODUTOS,
        detalhe: (produtId) => `${PRODUTOS}/${produtId}`,
        novo: `${PRODUTOS}/novo`,
        edit: `${PRODUTOS}/editar`
    },
    pedidos: {
        lista: PEDIDOS,
        detalhe: (pedido) => `${PEDIDOS}/editar/${pedido}`,
        remover: (pedido) => `${PEDIDOS}/removerProdutosPedido/${pedido}`,
        adicionar: (pedido) => `${PEDIDOS}/inserirProdutos/${pedido}`,
        editar: (pedido) => `${PEDIDOS}/editarProdutoPedido/${pedido}`,
    },
    fornecedores: {
        lista: FORNECEDORES
    },
    pessoas:{
        lista: PESSOAS,
        editaPessoa: `${PESSOAS}/editar`
    },
    FLAG: {
        VERDADEIRO: 1,
        FALSO: 0
    }
}
