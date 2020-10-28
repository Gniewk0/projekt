<template>
    <div class="mx-4 my-4">
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in data" :key="user.id">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.surname}}</td>
                    <td>
                       <button type="button" class="btn btn-secondary" @click="Delete(user.id)">X</button>
                    </td>
                </tr>
            </tbody>
            </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.')
        },
        props: {
            data: {
                required: true
            },
        },
        methods: {
            Delete(value){
                axios.delete('/users', {params: {id: value}})
                .then(response => this.getNumbers(this.id))
                .catch(error => this.errors = error.response.state);
            }
        }
    }
</script>
