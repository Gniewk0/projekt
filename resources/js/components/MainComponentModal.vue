<template>
    <div class="modback">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><slot name="header"></slot></h5>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="d-flex numbertitle">
                            <p class="mt-1">Name and Surname</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="name" placeholder="name" v-model="name">
                                <span class="text-danger" v-if="errors.getName(name)" v-text="errors.getName(name)"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="surname" placeholder="surname" v-model="surname">
                                <span class="text-danger" v-if="errors.getSurname(surname)" v-text="errors.getSurname(surname)"></span>
                            </div>
                            <fieldset class="form-group col-md-12">
                                <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">sex:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="male" v-model="sex">
                                            <label class="form-check-label" for="gridRadios1">
                                                male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="female" v-model="sex">
                                            <label class="form-check-label" for="gridRadios2">
                                                female
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="other" v-model="sex">
                                            <label class="form-check-label" for="gridRadios3">
                                                other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger" v-if="errors.getSex(sex)" v-text="errors.getSex(sex)"></span>
                            </fieldset>
                            <br>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="address" placeholder="address" v-model="address">
                                <span class="text-danger" v-if="errors.getAddress(address)" v-text="errors.getAddress(address)"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control" id="age" placeholder="age" v-model="age">
                                <span class="text-danger" v-if="errors.getAge(age)" v-text="errors.getAge(age)"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close')">close</button>
                    <button type="button" class="btn btn-secondary" @click=Add()><span><slot name="footer"></slot></span></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "../Errors/error.js"
    export default {
        props: {
            curentId:{
                // required: true
            },
            add:{
                // required: true
            }
        },
        data() {
            return {
                errors: new Errors,
                name: '',
                surname: '',
                age: '',
                sex: '',
                address: '',
                selected: '',
                response: ''
            }
        },
        computed: {
        },
        watch: {
            'response': function(newVal, oldVal) {
                this.name = this.response.name,
                this.surname = this.response.surname,
                this.age = this.response.age,
                this.sex = this.response.sex,
                this.address = this.response.address
            }
        },
        mounted() {
            if(this.curentId){
                axios.get('/users/show', { params: { id: this.curentId}})
                .then(response => this.response = response.data[0])
                .catch(error => this.errors.record(error.response.data));
            }
        },
        methods: {
            Add() {
            this.errors.clearAll()
                if(this.add){
                    axios.post('/users', {
                        id: this.name,
                        name: this.name,
                        surname: this.surname,
                        age: this.age,
                        sex: this.sex,
                        address: this.address,
                    })
                    .then(response => this.$emit('close'))
                    .catch(error => this.errors.record(error.response.data));
                }else{
                    axios.put('/users/update', {
                        id: this.curentId,
                        name: this.name,
                        surname: this.surname,
                        age: this.age,
                        sex: this.sex,
                        address: this.address,
                    })
                    .then(response => this.$emit('close'))
                    .catch(error => this.errors.record(error.response.data))
                }
            },
        }
    }
</script>

<style scoped>
    .modback{
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: scroll; /* Enable scroll if needed */
        background-color: rgb(0,0,0)!important; /* Fallback color */
        background-color: rgba(0,0,0,0.3)!important; /* Black w/ opacity */
    }

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(228, 226, 226, 0.548);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 900px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(247, 247, 247, 0.089);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
    }
</style>
