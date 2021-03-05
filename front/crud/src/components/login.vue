<template>
  <div  v-if=" login " id="cardLogin" class="flex items-center min-screen rounded-xl bg-white dark:bg-gray-900">
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-8">
            <div class="text-center">
                <h1 id="tlogin" class="my-1 text-3xl font-semibold text-gray-700 dark:text-gray-200">Sign in</h1>
                
            </div>
            <div class="m-7">
                <form action="">
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Email </label>
                            
                        </div>
                        <input type="email" v-model="dato.email" name="email" id="email" placeholder="you@company.com" class="w-full px-3 py-2 placeholder-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password</label>
                            
                        </div>
                        <input type="password" v-model="dato.password" name="password" id="password" placeholder="Your Password" class="w-full px-3 py-2 placeholder-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <button type="button" @click="entrar" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Sign in</button>
                    </div>
                   <p class="text-sm text-center text-gray-600">Aun no te has registrado?</p> <button type="button" @click="abrirCard" class="text-indigo-400 focus:outline-none focus:underline focus:text-indigo-500 dark:focus:border-indigo-800">Sign up</button>  
                </form>
            </div>
        </div>
    </div>
</div>

<!--
    Registro
-->

<div  v-if=" registro  " id="cardRegis" class="flex items-center min-screen rounded-xl bg-white dark:bg-gray-900">
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-8">
            <div class="text-center">
                <h1 id="tregistro" class="my-1 text-3xl font-semibold text-gray-700 dark:text-gray-200">Sign up</h1>
                
            </div>
            <div class="m-7">
                <form action="">
                   <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Nombre </label>
                            
                        </div>
                        <input type="text"  v-model="dato.name" name="name" id="" placeholder="Nombre Usuario" class="w-full px-3 py-2 placeholder-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Email </label>
                            
                        </div>
                        <input type="email" v-model="dato.email"  name="email" id="email" placeholder="you@company.com" class="w-full px-3 py-2 placeholder-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password</label>
                            
                        </div>
                        <input type="password"  v-model="dato.password" name="password" id="password" placeholder="Your Password" class="w-full px-3 py-2 placeholder-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <button type="button" @click="abrirCard2" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Sign up</button>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>
</div>



</template>

<script>


import axios from 'axios';
export default {
    data: () =>({
        dato : {
            'name' : '',
            'email' : '',
            'password' : ''
        },
        login : true,
        registro: false 

    }),
    methods : {
        abrirCard: function() {
            this.login = false;
            this.registro = true;
            
        },

        abrirCard2: function(){
            axios.post('http://127.0.0.1:8000/api/auth/signup', this.dato,{
                'headers': {
                    'Content-Type': 'application/json',
                    'X-Requested-With' : 'XMLHttpRequest'                    
                  }
            }).then(result => {
                console.log(result);
                this.login = true,
                this.registro = false
            }).catch(error => {
                console.log(error);
            })
        },

        entrar: function(){
            axios.post('http://127.0.0.1:8000/api/auth/login', this.dato,{
                   'headers': {
                    'Content-Type': 'application/json',
                    'X-Requested-With' : 'XMLHttpRequest'                    
                  }
            }).then(result => {
                console.log(result);
                //console.log(result.data.access_token);
                 localStorage.setItem('token', result.data.access_token)
             
                this.$router.push({path:'/list' })
                
            }).catch(error => {
                console.log(error);
            })
        }

    },

    created(){
        this.login = true;
        this.registro = false;
    }
}
</script>

<style scoped>
    /* Login y Registro */
#cardLogin{
  position: relative;
  left: 26%;
   width: 600px;
  height: 500px;
}

#cardRegis{
  position: relative;
  left: 26%;
    width: 600px;
  height: 500px;
}

#tloging{
  position: relative;
  top: -40px;
}

#tregistro{
  position: relative;
  top: -30px;
  
}

/* Login y Registro */
</style>