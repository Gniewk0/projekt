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
                        <div class="form-group" v-if="!add || destroy">
                            <label for="select">select user</label>
                            <select class="form-control" v-model="selected" id="select">
                                <option v-for="(option, i) in data" :key="i" :value="option.id">
                                    id:{{option.id}} | name: {{ option.name }} | surname: {{ option.surname }} | address {{ option.address }}
                                </option>
                            </select>
                        </div>
                        <div class="form-row" v-if="!destroy">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="name" placeholder="name" v-model="name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="surname" placeholder="surname" v-model="surname">
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
                        </fieldset>
                        <br>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="address" placeholder="address" v-model="address">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" id="age" placeholder="age" v-model="age">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close')">zamknij</button>
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
            data:{
                // required: true
            },
            destroy:{
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
                selected: ''
            }
        },
        mounted() {
        },
        computed: {
        },
        methods: {
            Add() {
            // this.errors.clearAll()
                if(this.add){
                    axios.post('/users', {
                        name: this.name,
                        surname: this.surname,
                        age: this.age,
                        sex: this.sex,
                        address: this.address,
                    })
                    .then(response => this.$emit('close'))
                    .catch(error => this.errors.record(error.response.data));
                }else if(this.destroy){
                    axios.delete('/users', {
                       params: { id: this.selected}
                    })
                    .then(response => this.$emit('close'))
                    .catch(error => this.errors.record(error.response.data));
                }else{
                    axios.put('/users/update', {
                        id: this.selected,
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
        /*overflow: scroll; /* Enable scroll if needed */
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
