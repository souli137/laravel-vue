<template>
 <div class="container">
  <div class="card">
   <div class="card-header">Login</div>
 
   <div class="card-body">
    <div class="col-md-6 offset-md-3">
      <form v-on:submit.prevent="onSubmit">
        <div class="alert alert-danger" v-if="errors.length">
          <ul class="mb-0">
            <li v-for="(error, index) in errors" :key="index">
              {{error}}
            </li>
           </ul>
         </div>

        

                 <div class="form-group">
           <label>Username</label>
           <input type="text" class="form-control" placeholder="Username..." v-model="username">
         </div>

<div class="form-group">
           <label>Password</label>
           <input type="password" class="form-control" placeholder="Password..." v-model="password">
         </div>



         <button class="btn btn-success">Login</button>
        </form>
       </div>
     </div>
    </div>
   </div>
</template>

<script>
export default {
   name: "login",
   props: ["app"],
   data() {
      return { 
         username: '',
         password: '',
         errors: []
      }
   },
   methods: {
     onSubmit()
     {
         this.errors= [];

         

         if (!this.username)  //obligation de remplir tous les champs
         {
             this.errors.push('Username is requires.');
         }

         if (!this.password)
         {
              this.errors.push('Password is resuired.');
         }

         

         

         if (!this.errors.length)
         {
            const data = {
              username: this.username,
              password: this.password,
            };

             this.app.req.post("auth/login", data).then(response => {
                this.app.user = response.data;
                this.$router.push("/");
              }}.catch(error => {
                this.errors.push(error.response.data.error);
              });
     
           }
        }
     }
};
</script>

<style>
</style>




