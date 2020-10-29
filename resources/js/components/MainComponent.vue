<template>
<div>
    <MainComponentModal v-if="showModal" @close="closemodal()" :add="add = true" id="exampleModal">
        <template #header>Dodaj Urzytkownika</template>
        <template #footer>Dodaj</template>
    </MainComponentModal>
    <MainComponentModal v-if="showModalEdit" @close="closemodal()" :add="add = false" :data='data' id="exampleModal">
        <template #header>Edytuj Urzytkownika</template>
        <template #footer>Edytuj</template>
    </MainComponentModal>
        <MainComponentModal v-if="showModalDestroy" @close="closemodal()" :destroy="destroy = true" :data='data' id="exampleModal">
        <template #header>Usuń Urzytkownika</template>
        <template #footer>Usuń</template>
    </MainComponentModal>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <button class="btn btn-outline-secondary mx-2" type="submit" @click="showModal = true, searchcheck = false">Add</button>
            </li>
            <li class="nav-item">
                <button class="btn btn-outline-secondary mx-2" type="submit" @click="showModalEdit = true, searchcheck = false">Edit</button>
            </li>
                        <li class="nav-item">
                <button class="btn btn-outline-secondary mx-2" type="submit" @click="showModalDestroy = true, searchcheck = false">Delete</button>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" @click="searchmethod()">Search</button>
        </form>
    </div>
    </nav>
        <div>
            <MainComponentTabel v-if="!searchcheck" :data='data'></MainComponentTabel>
            <MainComponentTableSearch v-if="searchcheck" :search='search'></MainComponentTableSearch>
        </div>
    </div>
</template>

<script>
    import MainComponentModal from './MainComponentModal';
    import MainComponentTabel from './MainComponentTabel';
    import MainComponentTableSearch from './MainComponentTableSearch';
    export default {
        data(){
            return {
                showModal: false,
                showModalEdit: false,
                showModalDestroy: false,
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
            MainComponentTableSearch,
            MainComponentModal,
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
            async searchmethod(){
                if(this.searchcheck == true){
                    this.searchcheck = false
                    setTimeout(function(){ this.searchcheck = true }, 1);

                }else{
                    this.searchcheck = true
                }

            }
        }
    }
</script>
