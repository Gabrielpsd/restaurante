<script>
import Layout from '../shared/Layout.vue'
import produtoCard from '../cartoes/produtoCard.vue'

export default {
    layout: Layout,
    props: {
        Produtos: Array
    },
    components:{
        produtoCard
    },

}
</script>

<template>
    <div >
        <div class="grid">
            <produtoCard :produto='produto' v-for="produto in Produtos" ></produtoCard>
        </div>
    </div>
</template>

<style scoped>
    produtoCard {
        margin: 1px;
    }
    .grid{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        margin: 0 auto;
        width: 80%;
    }
    h2{
      text-align: center;
      margin-top: 50px;
      margin-bottom: 50px;  
    }
    .busy_dot{
        height: 20px;
        width: 20px;
        background-color: red;
        border-radius: 50%;
        padding: 10px;

    }
    .free_dot{
        height: 20px;
        width: 20px;
        background-color: green;
        border-radius: 50%;
        padding: 10px;

    }
    .tables{
        display: flex;
        align-items: baseline;
        margin-left: 200px;
        padding: 5px;
    }
    .tables>p{
        padding-right: 20px;
        padding-left: 5px;
    }
</style>