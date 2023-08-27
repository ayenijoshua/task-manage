<template>
    <form method="post" @submit.prevent>
        <label for="title" class="form-label">Title</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="title" v-model="form.title" placeholder="title" aria-describedby="basic-addon1">
        </div>

        <label for="description" class="form-label">Description</label>
        <div class="input-group mb-3">
            <textarea class="form-control" v-model="form.description" placeholder="description" aria-describedby="basic-addon2" />
        </div>

        <label for="status" class="form-label">Status</label>
        <div class="input-group mb-3">
            <select type="test" class="form-control" v-model="form.status" aria-describedby="basic-addon2">
                <option value="">Select status</option>
                <option value="completed">Completed</option>
                <option value="in-process">In process</option>
                <option value="not-started">Not started</option>
            </select>
        </div>

        <label for="category" class="form-label">Category</label>
        <div class="input-group mb-3">
            <select class="form-control" v-model="form.category_id" aria-describedby="basic-addon2">
                <option value="">Select category</option>
                <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <input type="submit" value="submit" class="btn btn-primary" @click="submit()">
        </div>
        
    </form>
</template>

<script>
//import Input from '../../../vendor/laravel/breeze/stubs/inertia/resources/js/Components/Input.vue';
export default {
  //components: { Input },
    name:'CreateTaskComponent',
    props:{
        
    },
    data(){
        return{
            form:{
                title:'',
                description:'',
                status:'',
                category:'',
            },

            categories : []
        }
    },

    created(){
        var query = `query 
                    {categories{id name}} 
                    `
            axios.get('/graphql?query='+query)
                .then(res => {
                    this.categories = res.data.data.categories;
                });
    },

    methods: {
         
        submit(){
            var query = `mutation 
                    {createTask(title: "${this.form.title}" description:"${this.form.description}" status:"${this.form.status}" category_id:"${this.form.category_id}")
                {title}} 
                    `
            axios.post('/graphql',{"query":query})
            .then(res => {
                if (res.status==200) {
                    toastr.success("Task created successfully");
                    this.$emit('task-added')
                } else {
                    toastr.warning('An error occured, please try again');
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