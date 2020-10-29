<template>
    <div class="mx-4 my-4">
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">age</th>
                <th scope="col">sex</th>
                <th scope="col">address</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in searchresult" :key="user.id">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.surname}}</td>
                    <td>{{user.age}}</td>
                    <td>{{user.sex}}</td>
                    <td>{{user.address}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                searchresult: [],
            }
        },
        mounted(){
            this.Searching(this.search)
        },
        props: {
            search: {
                required: true,
            },
        },
        methods: {
            Searching(value){
                axios.get('/users/search',{
                    params: {
                        key: value
                    }
                })
                .then((response) => {
                    this.searchresult = response.data;
                },(error) => {
                    console.log(error);
                });
            },
        }
    }
</script>
