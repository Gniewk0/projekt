<template>
    <div>
        <MainComponentModal v-if="showModal" @close="closemodal()" :add="add = true" id="exampleModal">
            <template #header>Add User</template>
            <template #footer>Add</template>
        </MainComponentModal>
        <MainComponentModal v-if="showModalEdit" @close="closemodal()" :curentId='curentId' id="exampleModal">
            <template #header>Edit User</template>
            <template #footer>Edit</template>
        </MainComponentModal>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#" @click="getData()">Main Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <button class="btn btn-outline-secondary mx-2" type="submit" @click="showModal = true, searchcheck = false">Add</button>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" @click="searchmethod()">Search</button>
                </form>
            </div>
        </nav>
        <div>
            <MainComponentTabel>
                <tr v-for="user in data" :key="user.id">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.surname}}</td>
                    <td>{{user.age}}</td>
                    <td>{{user.sex}}</td>
                    <td>{{user.address}}</td>
                    <td>
                        <button class="btn btn-outline-secondary mx-2 float-right" type="submit" @click="showModalEdit = true, searchcheck = false, curentId = user.id">Edit</button>
                        <button class="btn btn-outline-secondary mx-2 float-right" type="submit" @click="Delete(user.id)">X</button>
                    </td>
                </tr>
            </MainComponentTabel>
        </div>
    </div>
</template>

<script>
    import MainComponentModal from './MainComponentModal';
    import MainComponentTabel from './MainComponentTabel';
    export default {
        data(){
            return {
                showModal: false,
                showModalEdit: false,
                data: [],
                searchcheck: false,
                search: '',
                curentId: ''
            }
        },
        mounted() {
            this.getData()
            this.getVuexData()
        },
        components: {
            MainComponentTabel,
            MainComponentModal,
        },
        computed: {
            vuexdata: {
                get () {
                return this.$store.getters.getData
                },
                set (value) {
                    this.$store.commit('getData', value);
                }
            },
        },
        methods: {
            closemodal(){
                this.showModalEdit = false
                this.showModal = false
                this.showModalDestroy = false
                this.getData()
            },
            getData(){
                axios.get('/users')
                    .then(response => this.data = response.data)
                    .catch(error => this.errors.record(error.response.data));
            },
            searchmethod(){
                this.Searching(this.search)
            },
            getVuexData(){//pobiera dane wniosku dla e03 przez case_document_1_id
                this.$store.dispatch('getData');
            },
            Searching(value){
                axios.get('/users/search',{
                    params: {
                        key: value
                    }
                })
                .then((response) => {
                    this.data = response.data;
                },(error) => {
                    console.log(error);
                });
            },
            Delete(payload){
                if (confirm('Are you sure you want to delete this user?')) {
                axios.delete('/users', { params: { id: payload}})
                    .then(response => this.getData())
                    .catch(error => this.errors.record(error.response.data));
                }
            }
        }
    }
</script>
