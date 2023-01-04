<template>
    <div class="container">
        <h2 class="text-center">Update Product</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductIndex' }" class="btn btn-success btn-sm float-right mb-2">
                    List
                </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>

                    <div class="form-group">
                        <div>
                            <label>Picture</label>
                            <input type="file" class="form-control" accept="image/*" @change=uploadImage>
                        </div>

                        <div style="height: 100px;">
                            <!--                            <img :src="product.picture" class="uploading-image mt-4" style="height: 100px;"/>-->
                            <img :src="product.picture" alt="p-image" style="height: 100%; width:auto;"/>
                        </div>
                    </div>

                    <button type="button" class="btn btn-warning" @click="updateProduct()"> Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductEdit",
    data() {
        return {
            product: {
                picture: ""
            }
        }
    },
    mounted() {
        this.fetchProduct(this.$route.params.productId);
    },
    methods: {
        fetchProduct(productId) {
            this.axios.get(`http://127.0.0.1:8000/api/product/${productId}`)
                .then((res) => {
                    this.product = res.data;
                    this.product.picture = "storage/" + res.data.picture;
                });
        },
        updateProduct() {
            this.axios
                .patch(`http://127.0.0.1:8000/api/product/${this.$route.params.productId}`, this.product)
                .then((res) => {
                    this.$router.push({name: 'ProductIndex'});
                });
        },
        uploadImage(e) {
            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.product.picture = e.target.result;
            };
        }
    }
}
</script>

<style scoped>

</style>
