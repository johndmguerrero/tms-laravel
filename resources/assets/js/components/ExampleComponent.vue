<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel-task panel panel-default border-blue">
                    <div class="panel-heading">Tasks</div>

                    <div class="panel-body task-navi">
                        <ul class="nav section-change nav-pills">
                            <li class="active"><a data-toggle="pill" href="#done">Done</a></li>
                            <li><a data-toggle="pill" href="#active">Active</a></li>
                            <li><a data-toggle="pill" href="#pending">Pending</a></li>
                            <li><a data-toggle="pill" href="#block">Block</a></li>
                        </ul>
                        <form @submit.prevent="addTask" class="panel-task-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="" v-model="task.name" placeholder="New Task">
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" id="" v-model="task.description" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="date" v-model="task.duedate" class="form-control" name="duedate" id="">
                            </div>
                            <div class="form-group">
                                <label for="sel1"></label>
                                <select name="status" class="form-control" v-model="task.status"  id="">
                                    <option value="0">Pending</option>
                                    <option value="1">Active</option>
                                    <option value="2">Blocked</option>
                                    <option value="3">Done</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel-task task-group panel panel-default border-blue">

                    <div class="tab-content">
                        <div id="done" class="tab-pane fade in active">
                            <div v-for="task in tasks" :key="task.id" >
                                <div v-if="task.status == 3" class="status-done" :key="task.id">
                                    <h3>{{ task.name }}</h3>
                                    <p>{{ task.description }}</p>
                                    <p>Due date: {{ task.duedate }}</p>
                                    <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>

                                </div>
                                <div v-else></div>
                            </div>
                        </div>
                        <div id="active" class="tab-pane fade in">
                            <div v-for="task in tasks" :key="task.id" >
                                <div v-if="task.status == 1" class="status-active" :key="task.id">
                                    <h3>{{ task.name }}</h3>
                                    <p>{{ task.description }}</p>
                                    <p>Due date: {{ task.duedate }}</p>
                                    <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>

                                </div>
                                <div v-else></div>
                            </div>
                        </div>
                        <div id="pending" class="tab-pane fade in">
                            <div v-for="task in tasks" :key="task.id" >
                                <div v-if="task.status == 0" class="status-pending" :key="task.id">
                                    <h3>{{ task.name }}</h3>
                                    <p>{{ task.description }}</p>
                                    <p>Due date: {{ task.duedate }}</p>
                                    <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>

                                </div>
                                <div v-else></div>
                            </div>
                        </div>
                        <div id="block" class="tab-pane fade in">
                            <div v-for="task in tasks" :key="task.id" >
                                <div v-if="task.status == 2" class="status-blocked" :key="task.id">
                                    <h3>{{ task.name }}</h3>
                                    <p>{{ task.description }}</p>
                                    <p>Due date: {{ task.duedate }}</p>
                                    <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>
                                </div>
                                <div v-else></div>
                            </div>
                        </div>
                    </div>

                </div>
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

        created() {
            this.fetchTasks();
        },

        methods: {
            fetchTasks() {
                fetch('api/tasks')
                    .then(res => res.json())
                    .then(res => {
                        this.tasks = res.data;
                    })
            },
            deleteTask(id){
                if(confirm('are you sure?')) {
                    fetch(`api/task/${id}` , {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Task Removed');
                        this.fetchTasks();
                    })
                    .catch(err => console.log(err))
                }
            },
            addTask(){
                if(this.edit === false){
                    fetch('api/task',{
                        method: 'post',
                        body: JSON.stringify(this.task),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.task.name = '';
                        this.task.description = '';
                        this.task.duedate = '';
                        this.task.status = '';
                        alert('task added');
                        this.fetchTasks();
                    })
                    .catch(err => console.log(err));
                }else{

                }
            }
        }
    };
</script>

<style scoped>
    .border-blue{
        border-color: #5fafe6;
    }
    .panel-task-form{
        margin: 10px;
    }


    [class^="status-"]{
        margin: 20px;
        padding: 15px;
        border-radius: 5px;
        max-width: 300px;
        padding-left: 20px;
        background-color:#fff;
        border-left: 5px solid;
        box-shadow: 0px 3px 5px 1px #0000001c;
    }

    .status-blocked{
        border-color:#e89494;
    }
    .status-active{
        border-color:#79c3ef;
    }
    .status-pending{
        border-color:#efaa79;
    }
    .status-done{
        border-color:#a1e894;
    }
    [class^="status-"] h3{
        font-weight: 600;
        margin: 5px 0px;
        line-height: 20px;
        font-size: 18px;
    }

    [class^="status-"] p{
        margin: 0;
    }

    .task-navi{
        padding: 15px 0;
    }
    .task-navi .nav-pills{
        margin:0;
        padding:0;
    }
    .task-navi .nav-pills > li{
        float:unset;
    }
    .nav-pills > li.active > a,
    .nav-pills > li.active > a:hover,
    .nav-pills > li.active > a:focus{
        border-left: 3px solid #5fafe6;
        color: #000;
        background-color: #efefef;
        border-radius: unset;
    }

</style>