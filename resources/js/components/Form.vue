<template>
<div class="container">
<div class="row">
    <div class="col-12">
    <h1 class="titulo">¡Adquiere aquí tu Revista El Man Está Vivo!</h1> 
    <p>Ingresa tus datos en el formulario, selecciona la revista de tu preferencia y sigue los pasos para realizar la compra.</p>
    <hr>
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
            <label>Número de documento</label>
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
                <label for="validationServer033">Ciudad / Departamento</label>
                <select v-model="form.municipio"  id="" :class=" {'form-control':true,'is-valid':validarCiudad}" required>
                    <option value="">Selecione...</option>
                    <option :value="municipio.nombre" v-for="municipio in municipios" :key="municipio.id">{{municipio.nombre}}</option>
                </select>
                <div class="">
                    <!-- Si no encuentra el municipio, comuniquese con soporte! -->
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationServer033">Dirección para envío</label>
                <input type="text" name="" v-model="form.direccion" class="form-control" id="" required>
            </div>
             <div class="col-md-6 mb-3">
                <label for="validationServer033">Metodo de pago</label>
                <select v-model="form.metodo"  id="" class="form-control" required>
                    <option value="" >Selecione...</option>
                    <option value="Efectivo">Efectivo (Baloto, Efecty)</option>
                    <option value="Tarjeta">Tarjetas (Débito, Credito , PSE) </option>
                </select>
                <div class="">
                    <!-- Si no encuentra el municipio, comuniquese con soporte! -->
                </div>
            </div>
        </div>

        <div class="form-row">
            
            <div class="col-md-4 mb-3">
                <label for="validationServer033">Revista</label>
                <select v-model="form.oracional" id="" :class=" {'form-control':true,'is-valid':validarCiudad}" required>
                    <option value="" >Seleccione...</option>
                    <option value="El man esta vivo">El Man Está Vivo</option>
                    <option value="Jovenes">Jóvenes</option>
                    <option value="Kids">Kids</option>
                    <option value="Puerta a la palabra">Puerta a la palabra</option>
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
            <div class="col-md-6 mb-3">
                <label for="validationServer033">Valor (Incluye gastos de envío)</label>
                 <p class="valor">${{form.valor}}</p>
            </div>

           
             
 
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input " id="invalidCheck33" required>
            <label class="custom-control-label" for="invalidCheck33">
                 <a  href="https://elmanestavivo.com/wp-content/uploads/2019/07/terminos_y_condiciones.pdf" target="_blank" rel="noopener noreferrer">Acepto términos y condiciones
            </a>
                </label>
            </div>

        <div class="invalid-feedback">
                You must agree before submitting.
        </div>

        </div>
        <button v-if="!enviando" class="btn btn-primary" type="submit" >Comprar</button>
        <button v-else  class="btn btn-primary" type="button" >Enviando...</button>
        </form>
    </div>
</div>



</div>
</template>

<script>


export default {
    data(){
        return{
            efectivo:'467642f772c8d561e8f53d3f7013c332',
            tarjeta:'088362a71f5e8a50b22e5ff53063a220',
            key:'467642f772c8d561e8f53d3f7013c332',
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
             metodo:'',
             

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
            if(this.form.metodo === 'Tarjeta'){
                this.key = this.tarjeta;
            }
            axios.post('/api/orden',this.form).then(res=>{
                console.log(res.data);
                


                var handler = ePayco.checkout.configure({
  				key: this.key,
  				test: false
  			})
                var data={
                        //Parametros compra (obligatorio)
                        name: "Compra " + this.form.oracional,
                        description: 'Compra ' +  this.form.tiempo + this.form.oracional,
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
                        confirmation:null,
                        response: null,

                        //Atributos cliente
                        name_billing: this.form.nombre,
                        address_billing: this.form.direccion,
                        type_doc_billing: "cc",
                        mobilephone_billing: this.form.tel,
                        number_doc_billing: this.form.cedula
                        }
          handler.open(data)

            });
            

        },
        getValor(){
                if (this.form.tiempo == 6) {

                    this.form.valor = 25000;
                }

                if (this.form.tiempo == 12) {
                    this.form.valor = 41900;
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
    color:#32016d;
    font-size: 21px;
}
.titulo{
    color:#32016d;
}
body{
    background-color: white;
}
</style>

