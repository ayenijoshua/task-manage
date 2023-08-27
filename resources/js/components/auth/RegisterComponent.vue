<template>
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo"><h2><span class="fa fa-android"></span></h2></span>
                <h4 class="company_title text-white">Personal Task Manager</h4>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2>{{panelTitle}}</h2>
                    </div>
                    <div class="row">
                        <form method="post" :action="postAction" class="form-group" @submit.prevent>
                            <div class="row">
                                <input type="text" v-model="registerForm.name" id="username" class="form__input" placeholder="name">
                            </div>
                            <div class="row">
                                <input type="text" v-model="registerForm.email" id="username" class="form__input" placeholder="Email">
                            </div>
                            <div class="row">
                                <!-- <span class="fa fa-lock"></span> -->
                                <input type="password" v-model="registerForm.password" id="password" class="form__input" placeholder="Password">
                            </div>
                            
                            <div class="row">
                                <input type="submit" value="Submit" class="btn" @click="submit()">
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <p>{{baseLinkName}} <a :href="baseLink">Login </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'RegisterComponent',
    props:{
        panelTitle:{
            default:'register',
            type:String,
            required:true
        },
        postAction:{
            type:String,
            required:true
        },
        baseLink:{
            type:String
        },
        baseLinkName:{
            type:String
        }
    },
    data(){
        return{
            registerForm:{
                name:'',
                email:'',
                password:''
            }
        }
    },

    methods: {
        submit(){
            axios.post(this.postAction, this.registerForm)
            .then(res => {
                if (res.data.success) {
                 location = res.data.redirect_url
                } else {
                    toastr.error(res.data.message);
                }
            })
            .catch(err => {
                if(err.response && err.response.status === 422){
                    toastr.error(err.response.data.message)
                }else{
                    toastr.error("An error occured, please try again")
                    console.log(err);
                }
            });
        }
    }


}
</script>