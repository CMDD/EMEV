<template>
<div class="container">
<div class="row">
    <div class="col-12">
    <h1>Portal de transacción</h1> <hr>
        <form v-on:submit.prevent="pagar">
        <div class="form-row">

        <div class="col-md-6 mb-3">
            <label>Nombre</label>
            <input type="text" :class=" {'form-control':true,'is-valid':validarName}" required v-model="form.nombre">
            <div class="valid-feedback">
            <!-- Mesaje para validar -->
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>Apellido</label>
            <input type="text" :class=" {'form-control':true,'is-valid':validarName}" v-model="form.apellido">
            <div class="valid-feedback">
            <!-- Mesaje para validar -->
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>Numero de documento</label>
            <input type="text" :class=" {'form-control':true,'is-valid':validarName}" v-model="form.cedula">
            <div class="valid-feedback">
            <!-- Mesaje para validar -->
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>Celular/Tel</label>
            <input type="text" :class=" {'form-control':true,'is-valid':validarName}" required v-model="form.tel">
            <div class="valid-feedback">
            <!-- Mesaje para validar -->
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>Correo</label>
            <input type="mail" :class=" {'form-control':true,'is-valid':validarName}" v-model="form.correo">
            <div class="valid-feedback">
            <!-- Mesaje para validar -->
            </div>
        </div>
         <div class="col-md-6 mb-3">
                <label for="validationServer033">Municipio</label>
                <select v-model="form.municipio"  id="" :class=" {'form-control':true,'is-valid':validarCiudad}" required>
                    <option value="">Selecione...</option>
                    <option :value="municipio.nombre" v-for="municipio in municipios" :key="municipio.id">{{municipio.nombre}}</option>
                </select>
                <div class="">
                    <!-- Si no encuentra el municipio, comuniquese con soporte! -->
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationServer033">Dirección</label>
                <input type="text" name="" v-model="form.direccion" class="form-control" id="" required>
            </div>
        </div>

        <div class="form-row">
            
            <div class="col-md-6 mb-3">
                <label for="validationServer033">Oracional</label>
                <select v-model="form.oracional" id="" :class=" {'form-control':true,'is-valid':validarCiudad}" required>
                    <option value="" >Seleccione...</option>
                    <option value="Puerta a la palabra">Puerta a la palabra</option>
                    <option value="El man esta vivo">El man esta vivo</option>
                    <option value="Kids">Kids</option>
                    <option value="Jovenes">Jovenes</option>
                </select>
                
            </div>
            
            <div class="col-md-3 mb-3">
                <label for="validationServer033">Tiempo</label>
                <select name="" id="" class="form-control " @change="getValor" v-model="form.tiempo" required> 
                    <option value="">Seleccione...</option>
                    <option value="6">Suscripción 6 Meses</option>
                    <option value="12">Suscripción 12 Meses</option>
                    <option value="1">Unidad </option>
                </select>
                <div class="invalid-feedback">
                    <!-- Mensaje   -->
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationServer033">Valor</label>
                 <p class="valor">${{form.valor}}</p>
            </div>

           
             
 
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input " id="invalidCheck33" required>
            <label class="custom-control-label" for="invalidCheck33">Acepto terminos y condiciones</label>
            </div>

        <div class="invalid-feedback">
                You must agree before submitting.
        </div>

        </div>
        <button v-if="!enviando" class="btn btn-primary" type="submit" >Suscribirme</button>
        <button v-else  class="btn btn-primary" type="submit" >Enviando...</button>
        </form>
    </div>
</div>



</div>
</template>

<script>


export default {
    data(){
        return{
            municipios:[],
            enviando:false,
            validarName:false,
            validarCiudad:false,
            form:{
            valor:'',
            tiempo:'',
             oracional:'',
             nombre:'',
             apellido:'',
             cedula:'',
             correo:'',
             tel:'',
             municipio:'',
             direccion:'',
             

            }
        }
    },
    created(){
        axios.get('/api/municipios').then(res=>{
            this.municipios = res.data;
        });
    },
    methods:{

        pagar(){
            this.enviando = true;
            var handler = ePayco.checkout.configure({
  				key: '088362a71f5e8a50b22e5ff53063a220',
  				test: false
  			})
                var data={
                        //Parametros compra (obligatorio)
                        name: "Suscripción " + this.form.oracional,
                        description: 'Suscripción ' + this.form.oracional,
                        invoice: null,
                        currency: "cop",
                        amount: this.form.valor,
                        tax_base: "0",
                        tax: "0",
                        country: "co",
                        lang: "es",

                        //Onpage="false" - Standard="true"
                        external: "true",


                        //Atributos opcionales
                        extra1: "extra1",
                        extra2: "extra2",
                        extra3: "extra3",
                        confirmation: "http://secure2.payco.co/prueba_curl.php",
                        response: "http://secure2.payco.co/prueba_curl.php",

                        //Atributos cliente
                        name_billing: this.form.nombre,
                        address_billing: this.form.direccion,
                        type_doc_billing: "cc",
                        mobilephone_billing: this.form.tel,
                        number_doc_billing: this.form.cedula
                        }
          handler.open(data)

        },
        getValor(){
                if (this.form.tiempo == 6) {

                    this.form.valor = 25000;
                }

                if (this.form.tiempo == 12) {
                    this.form.valor = 41200;
                }
                if(this.form.tiempo == 'Seleccione...'){
                    this.form.valor = ''; 
                }
                if(this.form.tiempo == 1){
                    this.form.valor = 8000; 
                }      
        }
    }

}
</script>

<style>
.container{
margin-top: 7%;
}
.valor{
    color:green;
    font-size: 21px;
}
body{
    background-color: white;
}
</style>

