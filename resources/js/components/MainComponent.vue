<template>
<div>
    <MainComponentModal v-if="showModal" @close="closemodal()" id="exampleModal"></MainComponentModal>
    <MainComponentModal v-if="showModalEdit" @close="closemodal()" id="exampleModal"></MainComponentModal>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <button class="btn btn-outline-secondary mx-2" type="submit" @click="showModal = true">Add</button>
            </li>
            <li class="nav-item">
                <button class="btn btn-outline-secondary mx-2" type="submit" @click="showModalEdit = true">Edit</button>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" @click="searchmethod(search)">Search</button>
        </form>
    </div>
    </nav>
        <div>
            <MainComponentTabel v-if="!searchcheck" :data='data'></MainComponentTabel>
            <MainComponentTableSearch v-if="searchcheck" :search='search' ></MainComponentTableSearch>
        </div>
    </div>
</template>

<script>
    import MainComponentModal from './MainComponentModal';
    import MainComponentTabel from './MainComponentTabel';
    import MainComponentTableSearch from './MainComponentTableSearch';
    import MainComponentModalEdit from './MainComponentModalEdit';
    export default {
        data(){
            return {
                showModal: false,
                showModalEdit: false,
                data: [],
                searchcheck: false,
                search: ''
            }
        },
        mounted() {
            this.getData()
        },
        components: {
            MainComponentTabel,
            MainComponentModal,
            MainComponentModalEdit,
        },
        methods: {
            closemodal(){
                this.showModalEdit = false
                this.showModal = false
                this.getData()
            },
            getData(){
                axios.get('/users')
                    .then(response => this.data = response.data)
                    .catch(error => this.errors.record(error.response.data));
            },
            searchmethod(value){
                if(value.length > 0){
                    this.searchcheck = true
                }else{
                    this.searchcheck = false
                }
            }
        }
    }
</script>
