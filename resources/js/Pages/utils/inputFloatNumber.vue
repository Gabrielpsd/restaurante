<script>
    export default{
        props:{
            number: Number
        },
        data(){
            return{
                inputNumber:(this.number + '').replace(/[\.]/,','),
            }
        },
        methods:{
            updateNumber(){
                this.$emit('update:number',parseInt(this.inputNumber))
            },
            formataNumeroParaBrasileira(number){

                 number = number + ''
                 number = number.replace(',','.')
                 let validador = parseFloat(number)
                 number = number.replace(/[\.,]/,'')

                 if(validador < 1)
                 {
                     number = '0' +  ',' + (number + '').slice(-2)
                     console.log(number)
                    }
                    else 
                    {
                        number = number + ''
                        number = number.substring(0,number.length -2) + ',' + number.slice(-2)
                        console.log(number)
                 }
                 return number
            },
            verificaDigito(key) {
                console.log(key)
                if(key.code == "Tab")
                    return

                if(key.code == 'Backspace')
                {

                    if(parseFloat((this.inputNumber).replace(',','.') <= 0.00))
                    return
                    
                    let number = (this.inputNumber+'').replace(',','')
                    console.log(number)
                    if(number.length <= 2 )
                        number  = '0' + ',' + number.slice(0,number.length-2)
                    else 
                        number = number.substring(0,number.length -2) + ',' + number.slice(-2)
                    
                    this.inputNumber = number
                    return 
                }

                if(parseInt(key.key) >= 0 && parseInt(key.key) <= 9)
                {
                    let number = (this.inputNumber + '').replace(/[\D\s\._]/,'')
                    number = number + key.key
                    number = this.formataNumeroParaBrasileira(number)
                
                   this.inputNumber = number
                }
                key.preventDefault()
                key.stopPropagation()
            },
        }
     
    }

</script>

<template>
     <label>
        <input size="5" :placeholder="inputNumber" :value="inputNumber" v-on:keydown="verificaDigito">
    </label>
</template>

<style scoped></style>