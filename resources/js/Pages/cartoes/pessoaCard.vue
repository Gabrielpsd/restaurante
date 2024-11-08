<script>
import Layout from '../shared/Layout.vue'
import rotas from '../Assets/ConfigFiles/apiconfig'

export default{
    layout: Layout,
    props: {
        pessoa: Object
    },
    data(){
        return{
            nome: this.pessoa.nome,
            cliente: this.pessoa.Cliente,
            edicaoInativa: true,
        }
    },
    methods: {
        salvaAlteracoes(){
            if(this.pessoa.descricao != this.descricao || this.pessoa.cliente != this.cliente)
            {
                const csrfToken = document.getElementsByName("_token")[0].value
                var request = new XMLHttpRequest()
                var data = new FormData()
                data.append('nome',this.nome)
                data.append('Cliente',this.cliente)
                let url = rotas.pessoas.editaPessoa +'/'+this.pessoa.id
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
            Nome:  {{ pessoa.id }}
            <button  class="btn btn-secondary"  @click="liberaEdicao()"v-if="edicaoInativa">Editar cadastro</button>
            <button  class="btn btn-primary" @click="salvaAlteracoes()" v-if="!edicaoInativa">Salvar</button>
        </div>
        <div class="card-body text-dark">
            <h5 class="card-title"><input type="checkbox" v-bind:disabled="edicaoInativa" v-model="cliente">Cliente</h5>
            <h5 class="card-title">Nome<input type="text" class="form-control" v-bind:readonly="edicaoInativa" v-model="nome"></h5>

        </div>
    </div>
</template>