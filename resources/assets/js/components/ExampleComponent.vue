<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel-task panel panel-default border-blue">
                    <div class="panel-heading">Tasks</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <h3>Welcome </h3>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                task: {
                    id: '',
                    name: '',
                    description: '',
                    duedate: '',
                    status:'',
                },
                task_id: '',
                edit:false,
            }
        },

        create() {
            this.fetchTasks();
        },

        methods: {
            fetchTasks() {
                fetch('api/tasks')
                    .then(res => res.json())
                    .then(res => {
                        console.log(res.data);
                    })
            }
        }
    };
</script>

<style scoped>
    .border-blue{
        border-color: #5fafe6;
    }
    .panel-task{
        height: 83vh;
    }
</style>