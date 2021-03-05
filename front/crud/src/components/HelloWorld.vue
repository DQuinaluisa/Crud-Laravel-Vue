<template>
<div>
   
 <div class="flex  ">
  <form method="GET">
    <div class=" ">
       
        <button id="ico" type="button" class="p-1 focus:outline-none focus:bg-orange" @click="buscar" >
          <i style="color:#F4832B;" class="far fa-search fa-lg"></i>
        </button>
    
      <input type="text"   id="search" v-model="search"
            class="py-3 font-medium  text-xl  rounded-xl pl-10 focus:outline-none focus:text-gray-900" placeholder="  Buscar Persona.... ">
    </div>
  </form>
</div>
</div>
<div>
    <transition name="modal">
      <div v-if="isOpen">
        <div class="overlay" @click.self="isOpen = false;">
          <div id="modal" class="">
            <div class="container max-w-full mx-auto py-2 px-6">
      <div class="font-sans">
      <div class="max-w-sm  px-6">
        <div class="relative flex flex-wrap">
          <div class="w-full relative">
            <div class="mt-2">
              
              <div id="title" class="text-left  text-xl text-black">
                  <h3>Agregar Nuevo Contacto</h3>
              </div>  
              
            <hr>
          <form class="mt-6">
            <div class="mx-auto max-w-lg">
              <div class="py-2">
                <span id="label" class="text-left  text-black-600">Cargar Imagen</span>
                <br>
                <input placeholder="" type="file" @change="imagen($event)"
                  class="text-md block px-3 py-2  rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
              </div>
              <div class="py-2">
                <span id="label" class="text-left  text-blaxk-600">Nombre</span>
                <br>
                <input placeholder=""  v-model="dataPost.first_name" type="text"
                  class="text-md block px-3 py-2  rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
              </div>
            <div class="py-2">
                <span id="label" class="text-left text-black-600">Detalle</span>
                <br>
                <textarea placeholder="" type="text"  v-model="dataPost.description"
                  class="text-md block px-3 py-2  rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                </textarea>
              </div>
             <button  type="button" class="border border-yellow-600 focus:outline-none  bg-yellow-600 text-white rounded-md px-4 py-2 m-2 "
               @click='guardar()'
              >Guardar</button>
            </div>
          </form>
       
        </div>
      </div>
    </div>
  </div>
</div>
</div>
          </div>
           
        </div>
      </div>
    </transition>
    <button id="button" class="border border-yellow-600 bg-yellow-600" @click="isOpen = !isOpen;">
      <i class="fas fa-plus-circle"></i> Nuevo Contacto
    </button>

     <button id="button2" @click="salir"   class="border border-blue-400 bg-blue-400" >
     <i class="fas fa-sign-out-alt"></i> Salir
    </button>
  </div>


<div class="flex flex-col">
  <div id="card" class="px-8 py-2 overflow-x-auto ">
    <div  v-for="todo in result " :key="todo.id "  class="align-middle  min-w-full ">
      <div id="content"  class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table  class="min-w-full divide-y overflow-x-auto divide-gray-200">
         
          <tbody class="bg-white divide-y divide-gray-200">
           
            <tr scope="row" >
           
              <td class="px-8 py-2  whitespace-nowrap">
                <div class="flex ml-4 ">
                  <div   class="flex-shrink-0  h-12 w-12 ">
                    <img class="h-12 w-12 "  id="img"  :src="`${todo.ima_profile}`"  alt="">
                  </div>
                  <div class="mb-6">
                    <div class="px-6 text-sm font-medium text-gray-900">
                        <input id="inp" class="text-blaxk-600 text-xl" v-model="todo.first_name" :disabled="todo.active ? disabled : '' "  >
                    </div>
                  </div>
                  <div class="mb-6">
                      <div class="px-2 text-sm font-medium text-gray-900">
                        <input id="inp" class="text-blaxk-600 text-xl" v-model="todo.last_name" :disabled="todo.active ? disabled : '' "  >
                        
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-8 py-2  whitespace-nowrap">
              
                <div class="container">
                     <textarea id="tarea" cols="2" rows="4" class="text-sm" v-model="todo.description"
                              :disabled="todo.active ? disabled : '' "
                       ></textarea>
               
                </div>
               
              </td>
              
              <button type="button" v-if="todo.active" id="btn" @click="eliminar(todo.id)"   class="abdolute text-yellow-600 hover:text-yellow-900">Eliminar</button>
             
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button v-if=" todo.active == false " type="button" class="text-indigo-600 hover:text-indigo-900"
                    @click="icons(todo.id,todo)">
                    <i  class="far fa-pencil fa-lg"></i> 
                    
                </button>
                <button  v-else type="button" class="text-indigo-600 hover:text-indigo-900"
                    @click="actualizar(todo.id,todo)">
                   
                    <i  class="far fa-save fa-lg"></i>
                </button>

              </td>
            </tr>
              
        
          
          </tbody>
         
        </table>
        <ul>
    
  </ul>

      </div>
      <br>
    </div>

  </div>
</div>


		

  <transition name="slide-fade">
    <div id="alert" v-if="post"  class="alert alert-success" role="alert">
        <h3><b>Usuario creado con exito  <i class="fas fa-user-check fa-lg"></i> </b> </h3>
    </div>
  </transition>

  <transition name="slide-fade">
    <div id="alert" v-if="put" class="alert alert-warning" role="alert">
        <h3><b>Usuario actualizado con exito <i class="fas fa-user-edit fa-lg"></i></b> </h3> 
   </div>
  </transition>

  <transition name="slide-fade">
    <div id="alert" v-if="borrar" class="alert alert-danger" role="alert">
        <h3><b>Usuario Eliminado  <i class="fas fa-user-times fa-lg"></i></b></h3>
    </div>
  </transition>



</template>



<script>
import axios from 'axios';
//import Vue from 'vue';


export default {
  

  data: () =>({
    result : null,
    pageOfItems : [],
    dataPost: {
      'first_name': '',
      'last_name' : '',
      'description' : '',
      'ima_profile' : ''
    },
    isOpen: false,
    icono : true,
    search : '',
    post : false,
    put : false,
    borrar : false,
    token : '',
    

    
  }),

methods : {
  guardar: function(){
   
   var espacio = this.dataPost.first_name;
   var split =  espacio.split(' ');
  
    this.dataPost.first_name = split[0];
    this.dataPost.last_name = split[1];
    if(split[1]==undefined ){
      alert("debe ingresar un Apellido ");
      
    }else{
         axios.post('http://127.0.0.1:8000/api/auth/person', this.dataPost, {
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer ' +  this.token
      }
    }).then(result => {
       
      console.log(result);
      this.isOpen = false;
      
      this.post = true;
      location.reload();
    }).catch(error => {
      location.reload();
      console.log(error);
    })
      
    }

    
      
    // alert(this.dataPost);

    

  },

  eliminar: function(id){
     axios.delete('http://127.0.0.1:8000/api/auth/person/'+ id,{
          'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer ' +  this.token
      }
      }).then(result => {
        this.borrar = true;        
        console.log(result);
        location.reload();
      }).catch(error => {
        console.log(error);
        location.reload();
      })

        /*this.borrar = true;
        console.log(this.borrar);
        location.reload();*/
  },

  actualizar: function(id, data) {
    axios.put('http://127.0.0.1:8000/api/auth/person/'+ id, data, {
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer ' +  this.token
      }
    }).then(result => {
         this.put = true;
        console.log(result);
        location.reload();
      }).catch(error => {
        console.log(error);
        location.reload();
      })
  },

  icons: function(id){
    /*this.icono = id;
    console.log(this.icono);*/
    this.result.forEach((element, index) => {
        //element['active'] = true;
        //this.result['active'] = true;
      //  this.$set(this.result, 0, 'active', true);
      Object.assign(this.result[index], {
      active : false 
    })
     // console.log(index);
        if(id == element.id){
          //Vue.set(this.result, 'active', false);
          Object.assign(this.result[index], {
             active : true 
          })
        }

        
    });
   
    console.log(this.result);
  },



 async imagen(event) {
    const dato = event.target.files[0];
    const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
       reader.onerror = error => reject(error);
    });  
     this.dataPost.ima_profile = await toBase64(dato);

  },

  buscar: function(){
     var espacio = this.search;
     var split =  espacio.split(' ');
     var name = split[0];
     var name2 = '';
     //console.log(split[1]);
     if(split[1]==undefined){
        name2 = null;
     }else {
       name2 = split[1];
     }
   axios.get('http://127.0.0.1:8000/api/auth/users/'+name+'/' +name2 ,{
          'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
         'Authorization' : 'Bearer ' +  this.token
      },
    }).then(result => {
        this.result = result.data;
         this.result.forEach((element, index) => {
     
           Object.assign(this.result[index], {
           active : false 
    })
        
    });
        console.log(result);
        
    }).catch(error => {
      console.log(error);
    })

  

  },
 


  salir: function(){
    localStorage.removeItem('token');
    this.token = '';
    this.$router.push({path:'/' })

  },

 

 


},





beforeCreate(){
  this.token = + localStorage.getItem('token');
  console.log(this.token);
},

created(){
  this.token = localStorage.getItem('token');
    axios.get('http://127.0.0.1:8000/api/auth/person',{
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer ' +  this.token
      }
    }).then(result => {
     this.result = result.data;
     console.log(this.result);
     this.result.forEach((element, index) => {
     
      Object.assign(this.result[index], {
      active : false 
    })
        
    });
   // console.log(this.result);
    }).catch(error => {
      console.log(error);
    })

  },
   
    


  

  
   



}
</script>





<style scoped>


#alert {
  position: relative;
  width: 40%; 
  top: 75%;
}

.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}


button.page-link {
	display: inline-block;
}
button.page-link {
    font-size: 20px;
    color: #29b3ed;
    font-weight: 500;
}
.offset{
  width: 500px !important;
  margin: 20px auto;  
}


#search {
  width: 125%;
  position: relative;
  top: -90px;
  
  left: 40px;
  z-index: 1;
}

#ico {
  position: relative;
  height: 40px;
  width: 50px;
  right: 100px;
  top: -42px;
  z-index: 2;
  
  

}

#card {
  
  position: relative;
  top: -70px;
}

#content {
  height: 95px;
}

#inp{
  width: 80px;
}

#des {
 position: absolute;
 
 top: 88px;
}

#img {
  width: 200%;
  height: 140%;
  border-radius: 50%;
  position: relative;
  top: -12px;
  z-index: 2;
}

#tarea{
  width: 700px;
  position: relative;
  right: 20px;
}

#descrip{
  position: relative;
  top: -10px;
}
#modal {
  width: 450px;
  height: 450px;
  position: relative;
  top: 90px;
  margin: 0px auto;
  padding: 20px;
  background-color: rgb(252, 253, 253);
  border-radius: 8px;
  box-shadow: 0 2px 8px 3px;
  transition: all 0.2s ease-in;
  
  
}
.fadeIn-enter {
  opacity: 0;
}

.fadeIn-leave-active {
  opacity: 0;
  transition: all 0.2s step-end;
}

.fadeIn-enter .modal,
.fadeIn-leave-active.modal {
  transform: scale(1.1);
}
#button {
  padding: 7px;
  margin-top: 10px;
  position: absolute;
  top: -2px;
  left: 85%;
  color: white;
  font-size: 1.1rem;
  border-radius: 5px;
}

#button2 {
  padding: 7px;
  margin-top: 10px;
  position: absolute;
  top: -2px;
  left: 78%;
  color: white;
  font-size: 1.1rem;
  border-radius: 5px;
}
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  
  width: 100%;
  height: 100%;
  background: #00000094;
  z-index: 999;
  transition: opacity 0.2s ease;
}

#label {
  position: relative;
  right: 110px;
}

#title{
  position: relative;
  top: -4px;
}

#btn {
  position: relative;
  top: 40px;
  right: 30px;
  
}

</style> 




