<script>
import { readonly } from 'vue';
import Layout from '../shared/Layout.vue'
import axios from 'axios';
import rotas from '../Assets/ConfigFiles/apiconfig'

export default{
    layout: Layout,
    props: {
        produto: Object
    },
    data(){
        return{
            descricao: this.produto.descricao,
            preco: this.produto.preco,
            edicaoInativa: true,
        }
    },
    methods: {
        salvaAlteracoes(){
            if(this.produto.descricao != this.descricao || this.produto.preco != this.preco)
            {
                const csrfToken = document.getElementsByName("_token")[0].value
                var request = new XMLHttpRequest()
                var data = new FormData()
                data.append('descricao',this.descricao)
                data.append('preco',this.preco)
                let url = rotas.produtos.edit +'/'+this.produto.id
                request.open('POST',url,true)
                request.setRequestHeader('X-CSRF-TOKEN',csrfToken)
                
                request.onload = function(){
                    console.log("Requisição bem sucedida ")
                }
                request.send(data)

            } 
            this.edicaoInativa = true
            console.log(" não houve alteração")
        },
        liberaEdicao(){
            this.edicaoInativa = false
        }
    }
}
</script>

<template>
    <div class="card border-dark mb-3" style="max-width: 18rem;" >
        <div class="card-header spacing">
            Produto {{ produto.id }}
            <button  class="btn btn-secondary"  @click="liberaEdicao()"v-if="edicaoInativa">Editar Produto</button>
            <button  class="btn btn-primary" @click="salvaAlteracoes()" v-if="!edicaoInativa">Salvar</button>
        </div>
        <div class="card-body text-dark">
            <h5 class="card-title"><input type="text" class="form-control" v-bind:readonly="edicaoInativa" v-model="descricao"></h5>
            <p class="card-text">Preço: <input type="number" min="1" step="any" class="form-control" v-bind:readonly="edicaoInativa" v-model="preco"></p>
        </div>
    </div>
</template>