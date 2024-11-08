<script>
import Layout from '../shared/Layout.vue';
import itemCard from '../cartoes/itemCard.vue';

export default {
    layout:Layout,
    props: {
        PedidoBD: Object,
        ProdutosBD: Array
    },
    components:{
        itemCard
    },
    data(){
        return{
            Pedido:this.PedidoBD[0],
            Produtos: this.ProdutosBD
        }
    },
    methods:{
        valorTotal(){
            let valorTotal = 0.00 
            this.Produtos.forEach(element => {
                valorTotal = parseFloat(element.preco) * parseInt(element.quantidade)
            });

            return valorTotal
        }
    }
}
</script>

<template>
    <button @click="voltar" class="btn-close"></button>
    <h2>Pedido {{Pedido.id}}</h2>
    <div class="pedidos rounded border border-secondary ">
        <div class="dadosPedido">
            <h3>Cliente:</h3>
            <p>{{ Pedido.cliente }}</p>
            <h3>Garçom</h3>
            <p>{{ Pedido.garcom }}</p>
            <h3>TotalPedido</h3>
            <p> R$ - {{valorTotal().toFixed(2)}}</p>
        </div>
        <div class="ListaProdutos">
            <div class="rounded border border-secondary menu"> 
                Adicionar Item 
                <button type="button" class="btn btn-secondary btn-sm" @click="insercao = true" >Adicionar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </button>
            </div>
            <ul class="list-group">
                <li class="list-group-item justify-content-between align-items-start" v-for="produto in Produtos" :key="index">
                    <itemCard :produto="produto" v-model:preco="produto.preco" v-model:quantidade="produto.quantidade"></itemCard>
                </li>
            </ul>
            <div class="salvaAlteracoes">
                <button type="button" class="btn btn-secondary" v-if="!modificacao" disabled>Salvar Alterações 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                    </svg>
                </button>
                <button type="button" class="btn btn-secondary" v-if="modificacao">Salvar Alterações
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .pedidos{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    p{
        border-color: gray;
        margin: 4px;
    }
</style>