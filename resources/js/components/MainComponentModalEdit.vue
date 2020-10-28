<template>
<div class="modback">
<div class="">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj użytkownika</h5>
        <!-- <p>{{amout}}</p> -->
      </div>
      <div class="modal-body">
        <div class="d-flex numbertitle">
            <p class="mt-1">Imię i nazwisko</p>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputEmail4" placeholder="name" v-model="name">
                <!-- <span class="text-danger" v-if="errors.getStart(number)" v-text="errors.getStart(number)"></span> -->
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputPassword4" placeholder="surname" v-model="surname">
                <!-- <span class="text-danger" v-if="errors.getEnd(number)" v-text="errors.getEnd(number)"></span> -->
            </div>
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="$emit('close')">zamknij</button>
        <button type="button" class="btn btn-secondary" @click=Add()>
            <span>dodaj numery</span>
        </button>
      </div>
    </div>
  </div>
</div>
</div>
</template>

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

.spinner{
  position: absolute;
  z-index: 1;
  left: 47%;
  top: 40%;
}
</style>

<script>
    import Errors from "../Errors/error.js"
    export default {
        props: {
            appId: {
                // required: true
            }
        },
        data() {
            return {
                errors: new Errors,
                name: '',
                surname: ''
            }
        },
        mounted() {
        },
        computed: {
        },
        methods: {
            Add() {
            // this.errors.clearAll()
            axios.post('/users', {
                name: this.name,
                surname: this.surname,
            })
            .then(response => this.$emit('close'))
            .catch(error => this.errors.record(error.response.data));
            },
        }
    }
</script>

<style>
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
