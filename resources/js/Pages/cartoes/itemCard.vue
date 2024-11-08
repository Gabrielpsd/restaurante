
<script>
import inputIntNumber from '../utils/inputIntNumber.vue';
import inputFloatNumber from '../utils/inputFloatNumber.vue';

export default{
    name: "Item",
    props: {
        produto: Object
    },
    components:{
        inputIntNumber,
        inputFloatNumber
    },
    data(){
        return{
            descricao: this.produto.descricao,
            preco: this.produto.preco,
            quantidade: this.produto.quantidade
        }
    },
    computed:{
        atualizaValores(){
            this.updatePreco()
            this.updateQuantidade()
        }
    },
    methods:{
        updatePreco(){
            this.$emit('update:preco',this.preco)
        },
        updateQuantidade(){
            if(NaN(this.quantidade) || !this.quantidade)
            {
                this.quantidade = 0
            }
            this.$emit('update:quantidade',this.quantidade)
        },
        atualizaPrecoTotal(){
            return parseFloat(this.preco) * parseInt(this.quantidade)
        },
        imprimeValor(){
            console.log(this.quantidade)
        }
    }
}
</script>

<template>
    <h5>{{ this.descricao }}</h5>
    <div class="outside">
        <div class="fw-bold "></div>   
            <div class="d-flex justify-content-between">
            <div class="rounded border border-secondary padding" >
                Quantidade:
                <inputIntNumber :number="quantidade" v-model:number="quantidade"></inputIntNumber>
            </div> 
            <div class="rounded border border-secondary padding" >
                Preço:
                <div>
                    R$
                    <inputFloatNumber :number="preco" v-model:preco="preco"></inputFloatNumber>
                </div>
            </div>
            <div class="rounded border border-secondary padding" > 
                Total:
                <div>
                    <label>
                        <input :placeholder="'R$' + atualizaPrecoTotal()" data-slots="_" data-accept="\d" size="5" disabled>
                    </label>
                </div>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-secondary btn-sm" @click="$emit('delete')">Remover <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            </button>
    </div>
    </div>
    
</template>

<style scoped>
    .flex{
        padding: 2px;
        margin: 2px;
    }
    .padding{
        padding: 3px;
        margin: 3px;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        justify-content: center;
        align-items: center;
    }
    h5{
        text-align: justify;
    }
    .outside{
        display: flex;
        flex-direction: row;
    }
</style>