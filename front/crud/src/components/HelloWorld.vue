<template>
 <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table v-for="todo in result" :key="todo.id"  class="min-w-full divide-y divide-gray-200">
         
          <tbody class="bg-white divide-y divide-gray-200">
            <tr >
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{ todo.first_name }} {{ todo.last_name }}
                    </div>
                   
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"> {{ todo.description }} </div>
               
              </td>
              
             
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
              </td>
            </tr>

            <!-- More items... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  
   

  data: () =>({
    result : null
  }),
  created(){
    axios.get('http://127.0.0.1:8000/api/auth/person',{
      'headers': {
          'Content-Type': 'application/json',
          'X-Requested-With' : 'XMLHttpRequest',
          'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjVlZTAyMTczNWFmZTQ2YzMxNzE0NzJlYjhhZDg3NmVlZmZlMTIyOTk4ZGZlMDM1MTI3N2FlMGFmMTA2ZTQzNzkxZWUwZGY1NDhlNjA1Y2YiLCJpYXQiOiIxNjE0NzQ2MjY5LjIwNTk2MSIsIm5iZiI6IjE2MTQ3NDYyNjkuMjA1OTY4IiwiZXhwIjoiMTY0NjI4MjI2OC43NjUzMTUiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.W7WV0CuC_1cE7oX0wCIPTMUvb5GVuGwZ9UIJWo9CC30HdlBooFwzRD726IKEAXJQbB9D2kxMMvh2_GPrrwIOgGhy0veIgAi98SVjZ4JHuI9MasC6B_53cdlOPIZ5ahPUYWcfwXR9WrBvPOyKZwSwuWjwvLbgzWtqLT1NLihOOiWa38BYUyaYpgT1Ie47oJTLAg919U6YSr0R0rw_P5rshuBHyBRHjeqqEzoC9yRPKZgWx9ANKhDspmxLC3o_i8iBxHVOpHweHissr7DWnmpXHG6-NNBkIzoYpzRhi-MHFXTB_DzgxYE9V77gC5AIt_sVMCzYfUL4U2qrGEqGO0UATWrURYYj9Mcawx_wAcs28WPT3ts16eIJ5bmCll6SbP4CCjT_XkTBRYo_37DIsKiLoldwMRgUHSj_sq7ezaZEoylFKrtGj115AOl16bxjqinWlFyfw2Opm28gJqZKtbSvAZmjiZVPDo2NentbI4BTFh9I2lHFflcjOcTzhmIByogzKk5N6ow4I0qErhxdP2E914RgRzFe9PwNCVffozxd5iWBJvFk8hP7-Si3jd0x2JgaHC4whAj_hkQH-FD5CqQ1_8XEwDIRK-hJC5T3JuaTYJ261LFeHK-6jZ2hq5AgJsZF-qhj8X4wZcn3xEt3OaVVHczLDpDVG4ehGuoy_V5G8-s'
      }
    }).then(result => {
     this.result = result.data;
     console.log(result);
    }).catch(error => {
      console.log(error);
    })
  }
  



}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
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
a {
  color: #42b983;
}
</style>
