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
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        mounted() {
        },
        methods: {

        }
    }
</script>
