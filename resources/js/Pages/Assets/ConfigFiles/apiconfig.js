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
        edit: `${PRODUTOS}/edit`
    },
    pedidos: {
        lista: PEDIDOS,
        detalhe: (pedido) => `${PEDIDOS}/editar/${pedido}`,
        removeDet: `${PEDIDOS}/removeDet`,
        insere: `${PEDIDOS}/insere`,
        editaEntrada: `${PEDIDOS}/EditaEntrada`
    },
    fornecedores: {
        lista: FORNECEDORES
    },
    pessoas:{
        lista: PESSOAS,
        editaPessoa: `${PESSOAS}/editar`
    }
    
}
