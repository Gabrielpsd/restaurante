export const BASE_URL = 'http://127.0.0.1:8000'
export const PRODUTOS = `${BASE_URL}/produtos`
export const ENTRADAS = `${BASE_URL}/entradas`
export const FORNECEDORES = `${BASE_URL}/fornecedores`

export default { 
    produtos: {
        lista: PRODUTOS,
        detalhe: (produtId) => `${PRODUTOS}/${produtId}`,
        novo: `${PRODUTOS}/novo`,
        edit: `${PRODUTOS}/edit`
    },
    mesas: {
        lista: ENTRADAS,
        detalhe: (entradaId) => `${ENTRADAS}/${entradaId}`,
        removeDet: `${ENTRADAS}/removeDet`,
        insere: `${ENTRADAS}/insere`,
        editaEntrada: `${ENTRADAS}/EditaEntrada`
    },
    fornecedores: {
        lista: FORNECEDORES
    },
    functions: {
        getCookieByName: (name)=>{
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
    }
}
