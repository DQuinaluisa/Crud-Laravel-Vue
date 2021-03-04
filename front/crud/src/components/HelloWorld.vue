<template>
<div>
    <transition name="modal">
      <div v-if="isOpen">
        <div class="overlay" @click.self="isOpen = false;">
          <div class="modal">
            <div class="container max-w-full mx-auto py-2 px-6">
      <div class="font-sans">
      <div class="max-w-sm  px-6">
        <div class="relative flex flex-wrap">
          <div class="w-full relative">
            <div class="mt-2">
              
              <div id="title" class="text-left font-medium text-xl text-black">
                  <h2>Agregar Nueco Contacto</h2>
              </div>  
              
            <hr>
          <form class="mt-6">
            <div class="mx-auto max-w-lg">
              <div class="py-2">
                <span class="text-left  text-black-600">Cargar Imagen</span>
                <br>
                <input placeholder="" type="file" @change="imagen($event)"
                  class="text-md block px-3 py-2  rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
              </div>
              <div class="py-2">
                <span class="text-left  text-blaxk-600">Nombre</span>
                <br>
                <input placeholder=""  v-model="dataPost.first_name" type="text"
                  class="text-md block px-3 py-2  rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
              </div>
            <div class="py-2">
                <span class="text-left text-black-600">Detalle</span>
                <br>
                <textarea placeholder="" type="text"  v-model="dataPost.description"
                  class="text-md block px-3 py-2  rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                </textarea>
              </div>
             <button  type="button" class="border border-yellow-600 bg-yellow-600 text-white rounded-md px-4 py-2 m-2 "
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
  </div>


<div class="flex flex-col">
  <div id="card" class="px-8 py-6 overflow-x-auto ">
    <div  v-for="todo in result" :key="todo.id "  class="align-middle  min-w-full ">
      <div   class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table  class="min-w-full divide-y overflow-x-auto divide-gray-200">
         
          <tbody class="bg-white divide-y divide-gray-200">
           
            <tr scope="row" >
           
              <td class="px-8 py-6 whitespace-nowrap">
                <div class="flex ml-4 ">
                  <div   class="flex-shrink-0  h-10 w-12 ">
                    <img class="h-10 w-12 "  id="img"  :src="`${todo.ima_profile}`"  alt="">
                  </div>
                  <div class="ml-6">
                    <div class="px-6 py-2 text-sm font-medium text-gray-900">
                        <input  v-model="todo.first_name"  >
                         <input v-model="todo.last_name"  >
                          <button type="button"  id="btn" @click="eliminar(todo.id)"  class="text-yellow-600 hover:text-yellow-900">Eliminar</button>
                    </div>
                   
                  </div>
                </div>
              </td>
              <td class="px-8 py-4 whitespace-nowrap">
              
                <div class="container">
                     <textarea id="tarea" cols="5" rows="5" v-model="todo.description"  ></textarea>
               
                </div>
               
              </td>
              
             
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button  type="button" class="text-indigo-600 hover:text-indigo-900"
                    @click="icons(todo.id,todo)">
                    <i  class="far fa-pencil fa-lg"></i> 
                    
                </button>
                <button   type="button" class="text-indigo-600 hover:text-indigo-900"
                    @click="actualizar(todo.id,todo)">
                   
                    <i  class="far fa-save fa-lg"></i>
                </button>

              </td>
            </tr>
              
        
          
          </tbody>
         
        </table>
        
      </div>
      <br>
    </div>
     
  </div>
</div>

  

</template>



<script>
import axios from 'axios';
//import Vue from 'vue';
export default {
  

    /*data: function() {
    return {
      isOpen: false
    };
  }*/

  

  data: () =>({
    result : null,
    dataPost: {
      'first_name': '',
      'last_name' : '',
      'description' : '',
      'ima_profile' : ''
    },
    isOpen: false,
    icono : true
    
  }),

methods : {
  guardar: function(){
   
   var espacio = this.dataPost.first_name;
   var split =  espacio.split(' ');
  
    this.dataPost.first_name = split[0];
    this.dataPost.last_name = split[1];
    console.log(this.dataPost);
      this.isOpen = false;
    // alert(this.dataPost);

    axios.post('http://127.0.0.1:8000/api/auth/person', this.dataPost, {
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOThiY2I4MDIzN2IzMjg2NGU3MTA4MjJhM2NlYzBlNWNiYzYzNjYwM2VhN2E3OGFjOGZkZGExYTdmZmJiNWQ4MDI2Yzg3NDAyODNkMGFlMTkiLCJpYXQiOiIxNjE0ODI4NTcxLjI5NTI5MCIsIm5iZiI6IjE2MTQ4Mjg1NzEuMjk1Mjk3IiwiZXhwIjoiMTY0NjM2NDU3MS4xOTIxNDMiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.FO7mLcTu2MAXUgB7bpiXvNM6V7cqbztluaYnYQPJtEfogfmMiVLSSsUCrf7XG8az6tgfoyK5GI9S6hN8gbXEHkpn5vdW0V3KgcmBjvZU7lUvyi4mYRW-1evbF_U4iAmbXF-x9XhUGVg4M-KKeCy-FNORX_2ZX5_tEqcELSd_1YyqAcBxpqmzQZ49ch-6fOGCcurHvTWjJYALUBlG3RhPge_X8CcK-e-jKuZ1AsIOQ2CO60rbwZUKQRFZ4PXv5icnUTZjSW4sQDqeeWJ7jtVPl1BgNh1V6xi_ADa0s6Ztkkugbkxon1Ha2JuDulh4Y7YrudbvZGgSfkLeEVkX3Q47hqeuoXFPFM7wZPgNTOKim5cTpfKGZcuiQnKZTUgFW36uC3Bf_h0QTIAP-Yl5trnO7u0HAugLC9gTz5uUfrlDjg-vBrcb8VZzGJK7CNLaA_6i_fdaNBDwT6t7uC9NVJnlQs8soA4moSFI6thAH9AkXfz0Ee46Uyhm-VYBHyDsIL_8SWVqwm-We2CjqWG1cfxO3rEI79hExLJu2kghvlCfMNF_KvCHqG0Uw3LrMsecwBSCl96-YzUM9J7EMwnNJjLNlZW5tjAWTeZXWqFeEdxk0BrqJaiXK2c5fp5VDqEzS9fQTxcsBR8zug_lRp170TBAOXuWlkauHjTnz9zSshsNjTI'
      }
    }).then(result => {
      console.log(result);
    }).catch(error => {
      console.log(error);
    })

  },

  eliminar: function(id){
      axios.delete('http://127.0.0.1:8000/api/auth/person/'+ id,{
          'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOThiY2I4MDIzN2IzMjg2NGU3MTA4MjJhM2NlYzBlNWNiYzYzNjYwM2VhN2E3OGFjOGZkZGExYTdmZmJiNWQ4MDI2Yzg3NDAyODNkMGFlMTkiLCJpYXQiOiIxNjE0ODI4NTcxLjI5NTI5MCIsIm5iZiI6IjE2MTQ4Mjg1NzEuMjk1Mjk3IiwiZXhwIjoiMTY0NjM2NDU3MS4xOTIxNDMiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.FO7mLcTu2MAXUgB7bpiXvNM6V7cqbztluaYnYQPJtEfogfmMiVLSSsUCrf7XG8az6tgfoyK5GI9S6hN8gbXEHkpn5vdW0V3KgcmBjvZU7lUvyi4mYRW-1evbF_U4iAmbXF-x9XhUGVg4M-KKeCy-FNORX_2ZX5_tEqcELSd_1YyqAcBxpqmzQZ49ch-6fOGCcurHvTWjJYALUBlG3RhPge_X8CcK-e-jKuZ1AsIOQ2CO60rbwZUKQRFZ4PXv5icnUTZjSW4sQDqeeWJ7jtVPl1BgNh1V6xi_ADa0s6Ztkkugbkxon1Ha2JuDulh4Y7YrudbvZGgSfkLeEVkX3Q47hqeuoXFPFM7wZPgNTOKim5cTpfKGZcuiQnKZTUgFW36uC3Bf_h0QTIAP-Yl5trnO7u0HAugLC9gTz5uUfrlDjg-vBrcb8VZzGJK7CNLaA_6i_fdaNBDwT6t7uC9NVJnlQs8soA4moSFI6thAH9AkXfz0Ee46Uyhm-VYBHyDsIL_8SWVqwm-We2CjqWG1cfxO3rEI79hExLJu2kghvlCfMNF_KvCHqG0Uw3LrMsecwBSCl96-YzUM9J7EMwnNJjLNlZW5tjAWTeZXWqFeEdxk0BrqJaiXK2c5fp5VDqEzS9fQTxcsBR8zug_lRp170TBAOXuWlkauHjTnz9zSshsNjTI'
      }
      }).then(result => {
        console.log(result);
      }).catch(error => {
        console.log(error);
      })
  },

  actualizar: function(id, data) {
    axios.put('http://127.0.0.1:8000/api/auth/person/'+ id, data, {
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOThiY2I4MDIzN2IzMjg2NGU3MTA4MjJhM2NlYzBlNWNiYzYzNjYwM2VhN2E3OGFjOGZkZGExYTdmZmJiNWQ4MDI2Yzg3NDAyODNkMGFlMTkiLCJpYXQiOiIxNjE0ODI4NTcxLjI5NTI5MCIsIm5iZiI6IjE2MTQ4Mjg1NzEuMjk1Mjk3IiwiZXhwIjoiMTY0NjM2NDU3MS4xOTIxNDMiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.FO7mLcTu2MAXUgB7bpiXvNM6V7cqbztluaYnYQPJtEfogfmMiVLSSsUCrf7XG8az6tgfoyK5GI9S6hN8gbXEHkpn5vdW0V3KgcmBjvZU7lUvyi4mYRW-1evbF_U4iAmbXF-x9XhUGVg4M-KKeCy-FNORX_2ZX5_tEqcELSd_1YyqAcBxpqmzQZ49ch-6fOGCcurHvTWjJYALUBlG3RhPge_X8CcK-e-jKuZ1AsIOQ2CO60rbwZUKQRFZ4PXv5icnUTZjSW4sQDqeeWJ7jtVPl1BgNh1V6xi_ADa0s6Ztkkugbkxon1Ha2JuDulh4Y7YrudbvZGgSfkLeEVkX3Q47hqeuoXFPFM7wZPgNTOKim5cTpfKGZcuiQnKZTUgFW36uC3Bf_h0QTIAP-Yl5trnO7u0HAugLC9gTz5uUfrlDjg-vBrcb8VZzGJK7CNLaA_6i_fdaNBDwT6t7uC9NVJnlQs8soA4moSFI6thAH9AkXfz0Ee46Uyhm-VYBHyDsIL_8SWVqwm-We2CjqWG1cfxO3rEI79hExLJu2kghvlCfMNF_KvCHqG0Uw3LrMsecwBSCl96-YzUM9J7EMwnNJjLNlZW5tjAWTeZXWqFeEdxk0BrqJaiXK2c5fp5VDqEzS9fQTxcsBR8zug_lRp170TBAOXuWlkauHjTnz9zSshsNjTI'
      }
    }).then(result => {
        console.log(result);
      }).catch(error => {
        console.log(error);
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

  }
},


  created(){
    axios.get('http://127.0.0.1:8000/api/auth/person',{
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOThiY2I4MDIzN2IzMjg2NGU3MTA4MjJhM2NlYzBlNWNiYzYzNjYwM2VhN2E3OGFjOGZkZGExYTdmZmJiNWQ4MDI2Yzg3NDAyODNkMGFlMTkiLCJpYXQiOiIxNjE0ODI4NTcxLjI5NTI5MCIsIm5iZiI6IjE2MTQ4Mjg1NzEuMjk1Mjk3IiwiZXhwIjoiMTY0NjM2NDU3MS4xOTIxNDMiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.FO7mLcTu2MAXUgB7bpiXvNM6V7cqbztluaYnYQPJtEfogfmMiVLSSsUCrf7XG8az6tgfoyK5GI9S6hN8gbXEHkpn5vdW0V3KgcmBjvZU7lUvyi4mYRW-1evbF_U4iAmbXF-x9XhUGVg4M-KKeCy-FNORX_2ZX5_tEqcELSd_1YyqAcBxpqmzQZ49ch-6fOGCcurHvTWjJYALUBlG3RhPge_X8CcK-e-jKuZ1AsIOQ2CO60rbwZUKQRFZ4PXv5icnUTZjSW4sQDqeeWJ7jtVPl1BgNh1V6xi_ADa0s6Ztkkugbkxon1Ha2JuDulh4Y7YrudbvZGgSfkLeEVkX3Q47hqeuoXFPFM7wZPgNTOKim5cTpfKGZcuiQnKZTUgFW36uC3Bf_h0QTIAP-Yl5trnO7u0HAugLC9gTz5uUfrlDjg-vBrcb8VZzGJK7CNLaA_6i_fdaNBDwT6t7uC9NVJnlQs8soA4moSFI6thAH9AkXfz0Ee46Uyhm-VYBHyDsIL_8SWVqwm-We2CjqWG1cfxO3rEI79hExLJu2kghvlCfMNF_KvCHqG0Uw3LrMsecwBSCl96-YzUM9J7EMwnNJjLNlZW5tjAWTeZXWqFeEdxk0BrqJaiXK2c5fp5VDqEzS9fQTxcsBR8zug_lRp170TBAOXuWlkauHjTnz9zSshsNjTI'
      }
    }).then(result => {
     this.result = result.data;
     //console.log(result);
    }).catch(error => {
      console.log(error);
    })
  },

 
  
   



}
</script>


<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
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
  top: -2px;
  z-index: 2;
}

#tarea{
  width: 550px;
  position: relative;
  right: 70px;
}

#descrip{
  position: relative;
  top: -10px;
}
.modal {
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
  top: -5px;
  left: 85%;
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

span {
  position: relative;
  right: 110px;
}

#title{
  position: relative;
  top: -4px;
}

</style> 




<!--<script>
export default {
  data: function() {
    return {
      isOpen: false
    };
  }
};
</script>-->

<!--<style scoped>
.modal {
  width: 450px;
  height: 450px;
  position: relative;
  top: 140px;
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
  position: relative;

  color: white;
  font-size: 1.1rem;
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

span {
  position: relative;
  right: 110px;
}

#title{
  position: relative;
  top: -4px;
}

</style> -->