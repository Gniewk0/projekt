<template>
    <div class="mx-4 my-4">
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in searchresult" :key="user.id">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.surname}}</td>
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
        watch: {
            search(value){
                if(this.search.length > 0){
                    if(value == this.search)
                        this.Searching(value);
                }
            },
        },
        props: {
            search: {
                required: true
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
