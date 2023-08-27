<template>
    <div class="">
        <div class="table-responsive">
            <table class="table table-hovered table-bordered ">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tr v-if="tasks.data && tasks.data.length==0">
                    <td colspan="3">
                        <div class="bg-warning text-center">There no tasks</div>
                    </td>
                </tr>
                <tbody>
                    <tr v-for="task in tasks" :key="task.id">
                        <td>{{task.title}}</td>
                        <td>{{task.description}}</td>
                        <td>{{task.status}}</td>
                        <td>{{task.category.name}}</td>
                        <td>{{task.created_at}}</td>
                        <td>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">action</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a  class="dropdown-item" @click="loadEditModal(task)">Edit</a>
                                    <a class="dropdown-item" @click="destroy(task.id)">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row table-responsive">
            <div class="col">
                
            </div>
        </div>

        <div class="modal" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <edit-task-component @task-edited="fetchTasks"  v-if="task !== undefined" :key="task.id" :task="task"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import pagination from 'laravel-vue-pagination';
import EditTaskComponent from './EditTaskComponent.vue';
export default {
    name: 'tasksComponent',
    comments: { pagination, EditTaskComponent },
    data() {
        return {
            tasks: [],
            categories: [],
            task:undefined
        };
    },

    props:{
        getTasks:false
    },

    created() {
        this.getResults();
        if(this.getTasks){
            this.fetchTasks()
        }
    },

    methods: {
        getResults() {
            
            var query = `query 
                    {tasks{id title,description,status,category{id,name},created_at}} 
                    `;
            axios.get('/graphql?query=' + query)
                .then(res => {
                this.tasks = res.data.data.tasks;
            });
            var query = `query 
                    {categories{id name}} 
                    `;
            axios.get('/graphql?query=' + query)
                .then(res => {
                this.categories = res.data.data.categories;
            });
        },

        fetchTasks(){
            var query = `query 
                    {tasks{id title,description,status,category{id,name},created_at}} 
                    `;
            axios.get('/graphql?query=' + query)
                .then(res => {
                this.tasks = res.data.data.tasks;
            });
        },

        destroy(id) {
            //let id = parseInt(iid)
            if (confirm("Do you want to delete this task?")) {
                var query = `mutation 
                    {deleteTask(id: "${id}")
                }`

                axios.get('/graphql?query=' + query)
                    .then(res => {
                    if (res.status==200) {
                        this.getResults();
                        toastr.success('Task deleted successfully');
                        this.fetchTasks()
                    }
                    else {
                        toastr.error('An error occured, try again');
                    }
                }).catch(err => {
                    toastr.error("An error occured, please try again");
                    console.log(err);
                });
            }
        },

        loadEditModal(task) {
            this.task = task
            $('#editModal').modal();
        }
    },
    components: { EditTaskComponent }
}
</script>