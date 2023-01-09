<template>
    <div class="container">
        <h2 class="text-center">Products List</h2>

        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductCreate' }" class="btn btn-primary btn-sm float-right mb-2">Add
                    Product
                </router-link>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, key) of products" v-bind:key="key">
                        <td>{{ key + 1 }}</td>

                        <td style="height: 100px;">
                            <img :src="'storage/'+product.picture" alt="p-image" style="height: 100%; width:auto;"/>
                        </td>

                        <td>{{ product.name }}</td>

                        <td>
                            <router-link class="btn btn-success btn-sm"
                                         :to="{ name: 'ProductEdit', params: { productId: product.id }}">
                                Edit
                            </router-link>


                            <button class="btn btn-danger btn-sm" @click="swalAlert(product.id)">
                                Delete
<!--                                <sweat-alert>-->
<!--                                </sweat-alert>-->
                            </button>

                        </td>
                    </tr>
                    </tbody>
                    <!--                    <tfoot>-->
                    <!--                    <tr>-->
                    <!--                        <th>#</th>-->
                    <!--                        <th>Omage</th>-->
                    <!--                        <th>Name</th>-->
                    <!--                        <th>Actions</th>-->
                    <!--                    </tr>-->
                    <!--                    </tfoot>-->
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductIndex",
    data() {
        return {
            products: {}
        }
    },
    created() {
        this.getProducts();
    },
    methods: {
        getProducts() {
            this.axios.get('http://localhost:8000/api/product')
                .then(response => {
                    // console.log(response.data);
                    this.products = response.data;
                })
            ;
        },
        swalAlert(productId) {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteProduct(productId);
                }
                // else if (result.isDismissed) {
                //     this.deleteProduct(product.id);
                //
                // }
            });
        },
        deleteProduct(productId) {
            this.axios
                .delete(`http://127.0.0.1:8000/api/product/${productId}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(productId);
                    this.products.splice(i, 1)
                });
        }
    }
}
</script>

<style scoped>

</style>
