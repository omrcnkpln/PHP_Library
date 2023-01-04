<template>
    <div class="test" @click="swalAlert()">
        Delete
    </div>
</template>

<script>
export default {
    name: "sweatAlert",
    data() {
        return {
            message: ""
        }
    },
    methods: {
        swalAlert(){
           // alert();
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });
        }
        // deleteProduct(productId) {
        //
        //
        //     // this.axios
        //     //     .delete(`http://127.0.0.1:8000/api/product/${productId}`)
        //     //     .then(response => {
        //     //         // console.log(response);
        //     //         let i = this.products.map(data => data.id).indexOf(productId);
        //     //         this.products.splice(i, 1)
        //     //     });
        // }
    }
}
</script>

<style scoped>

</style>
