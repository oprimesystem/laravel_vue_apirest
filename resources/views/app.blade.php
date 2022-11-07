<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
  <style>
  #app{
      background-color:#CFD8DC;      
  }
  </style>
</head>
<body>
  <div id="app">
    <v-app>
      <v-main>   
                  <!-- Botón CREAR -->  
        <v-flex class="text-center align-center">
          <v-btn class="mx-2 mt-4"  fab dark color="#00B0FF" @click="formNuevo()"><v-icon dark>mdi-plus</v-icon></v-btn>   
        </v-flex>              
                  <!--boton buscar-->
        <v-container>
          <v-form> 
            <v-row>
              <v-col md="7"></v-col>
              <v-col md="2"><!--<v-text-field v-model="parametro2" label="Name" solo required></v-text-field>--></v-col>
              <v-col md="2"><v-text-field v-model="parametro1" label="Email" solo required></v-text-field></v-col>
              <v-col md="1"><v-btn style="" color="primary" @click="modalBuscar()"  small x-small >Buscar</v-btn></v-col>
            </v-row>
          </v-form> 
        </v-container>
        
        <v-card class="mx-auto mt-5" color="transparent" max-width="1280" elevation="8">                    
            <!-- Tabla y formulario -->
          <v-simple-table class="mt-5">
            <template v-slot:default>
              <thead>
                <tr class="indigo darken-4">
                 
                  <th class="white--text">Id</th>
                  <th class="white--text">Name</th>
                  <th class="white--text">Email</th>
                  <th class="white--text">Gender</th>
                  <th class="white--text">Status</th>
                <th class="white--text text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                 
                  <td> @{{ user.id }}</td>
                  <td> @{{ user.name }}</td>
                  <td> @{{ user.email }}</td>
                  <td> @{{ user.gender }}</td>
                  <td> @{{ user.status }}</td>
                  <td>
                    <v-btn fab dark color="##5F9EA0" small @click="userdetalle(user.id)"><v-icon> mdi-head</v-icon></v-btn>
                    <v-btn fab dark color="#00BCD4" small @click="formEditar(user.id,user.name, user.email,user.gender,user.status)"><v-icon>mdi-pencil</v-icon></v-btn>
                    <v-btn fab dark color="#E53935" small @click="borrar(user.id)"><v-icon>mdi-delete</v-icon></v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card>        
              <!-- Componente de Diálogo para CREAR y EDITAR -->
        <v-dialog v-model="dialog" max-width="1000">        
          <v-card>
            <v-card-title class="blue darken-2 white--text">Usuarios</v-card-title>    
            <v-card-text>            
              <v-form>             
                <v-container>
                  <v-row>
                    <input v-model="user.id" hidden></input>
                    <!--<v-col  md="3">
                      <v-text-field v-model="user.id" label="id"  solo required></v-text-field>
                    </v-col>-->
                    <v-col  md="3">
                      <v-text-field v-model="user.name" label="Name" solo required></v-text-field>
                    </v-col>
                    <v-col  md="3">
                      <v-text-field v-model="user.email" label="Email"  solo required></v-text-field>
                    </v-col>

                    <v-col  md="3">
                      <v-text-field v-model="user.gender" label="Gender"  solo required></v-text-field>
                    </v-col>

                    <v-col  md="3">
                      <v-text-field v-model="user.status" label="Status"  solo required></v-text-field>
                    </v-col>
                    
                   
                  </v-row>
                </v-container>            
                </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="dialog=false" color="blue-grey" dark>Cancelar</v-btn>
                    <v-btn @click="guardar()" type="submit" color="blue darken-2" dark>Guardar</v-btn>
                  </v-card-actions>
              </v-form>
          </v-card>
        </v-dialog>

          <!-- Componente de Diálogo buscar -->
        <v-dialog v-model="dialogBuscar" max-width="1000">        
          <v-card>
            <v-card-title class="green darken-2 white--text">Buscar Usuarios</v-card-title>    
            <v-card-text>            
              <v-form>             
                <v-container>
                  <v-row>
                    <input v-model="user.id" hidden></input>
                    <v-col  md="6">
                      <v-text-field v-model="parametro1" label="Name" solo required></v-text-field>
                    </v-col>
                    <v-col  md="6">
                      <v-text-field v-model="parametro2" label="Email"  solo required></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>            
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn @click="dialogBuscar=false" color="blue-grey" dark>Cancelar</v-btn>
              <v-btn @click="modalBuscar(user.id)" type="submit" color="blue darken-2" dark>Guardar</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
      </v-main>
    </v-app>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.5.7/vuetify.min.js" integrity="sha512-BPXn+V2iK/Zu6fOm3WiAdC1pv9uneSxCCFsJHg8Cs3PEq6BGRpWgXL+EkVylCnl8FpJNNNqvY+yTMQRi4JIfZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>

    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
       data() {
        return { 
            dialog: false,
            dialogBuscar: false,
            users:[],
            user:{
             id:null,
             name:'',
             email:'',
             gender:'',
             status:''
            },
            operacion: '',
            parametro1: '',
            parametro2:''            
                   
        }
       },
        created(){               
          this.mostrar()
        },  
       methods:{          
            //MÉTODOS PARA EL CRUD
            mostrar:function(){
              axios.get('http://127.0.0.1/apirestfull/public/api/usuarios')
              .then(response =>{
              this.users = response.data;
              console.log(response.data); 
                            
              })
            },
            crear:function(){
              let parametros = {
                                id:this.user.id,
                                name:this.user.name,
                                email:this.user.email,
                                gender:this.user.gender,
                                status:this.user.status
                              };
             
             
              axios.post('http://127.0.0.1/apirestfull/public/api/usuarios',parametros)
                      .then(response =>{
                              this.mostrar();
                            }); 
                          Swal.fire('¡Usuario creado !', '', 'success')  
                     
                      this.post.id="";
                      this.post.title="";
                      this.post.body="";
                   
           
            },
            editar: function(){
              let parametros = {
                id:this.user.id,
                name:this.user.name,
                email:this.user.email,
                gender:this.user.gender,
                status:this.user.status
              }; 
                                        
              axios.put(`http://127.0.0.1/apirestfull/public/api/usuarios/${this.user.id}`,parametros)                            
                  .then(response => {                                
                     this.mostrar();
                     Swal.fire('Usuario fue Actualizado', '', 'primary')
                  })                
                  .catch(error => {
                      console.log(error);            
                  });
            } ,                      
          
            borrar:function(id){
              Swal.fire({
                title: '¿Confirma eliminar el registro?',   
                confirmButtonText: `Confirmar`,                  
                showCancelButton: true,                          
              }).then((result) => {                
                if (result.isConfirmed) {      
                  axios.delete(`http://127.0.0.1/apirestfull/public/api/usuarios/${id}`)
                    .then(response =>{           
                        this.mostrar();
                    });      
                    Swal.fire('¡Eliminado!', '', 'success')
                } else if (result.isDenied) {                  
                }
              });              
            },
            //Botones y formularios
            guardar:function(){
              if(this.operacion=='crear'){
                this.crear();                
              }
              if(this.operacion=='editar'){ 
                this.editar();                           
              }
              this.dialog=false;                        
            }, 
            formNuevo:function () {
              this.dialog=true;
              this.operacion='crear';
              //this.user.id = id;
                                       
              this.user.name='';
              this.user.email='';
              this.user.gender='';
              this.user.status='';
              
            },
            formEditar:function(id, name, email , gender, status){
              //capturamos los datos del registro seleccionado y los mostramos en el formulario
             
              this.user.id = id;
              this.user.name = name;
              this.user.email = email;  
              this.user.gender = gender;
              this.user.status = status;                           
              this.dialog=true;                            
              this.operacion='editar';
            },
            modalBuscar:function () {
              let parametros = {
                name:this.parametro1,
                email:this.parametro2
              };
          
              axios.post('http://127.0.0.1/apirestfull/public/api/usuarios/findUser',parametros)
                      .then(response =>{
                            //this.mostrar();
                      }); 
                       
            },  //buscar

            userdetalle:function(id){
               axios.get(`http://127.0.0.1/apirestfull/public/api/usuario/${id}`)
               .then(response=>{
                
                
               })
            }

       }      
    });
  </script>
</body>
</html> 