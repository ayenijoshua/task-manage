<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tasks</h3>
                </div>
                <tasks-component :key="key" :getTasks="fetchTasks"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Create Task</h3>
                </div>
                <create-task-component @task-added="fetchTasksEvent"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                fetchTasks:false,
                key:1
            }
        },

        methods:{
            fetchTasksEvent(){
                this.fetchTasks = true
                this.key = Math.random(5)
                this.$emit('task-added')
            },
        }
    }
</script>