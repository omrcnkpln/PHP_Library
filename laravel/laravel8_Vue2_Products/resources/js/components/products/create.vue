<template>
    <div class="container">
        <h2 class="text-center">Create product</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductIndex' }" class="btn btn-success btn-sm float-right mb-2">
                    List
                </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>

                    <div class="form-group">
                        <div>
                            <label>Picture</label>
                            <input type="file" class="form-control" accept="image/*" @change=uploadImage>
                        </div>

                        <div>
                            <img :src="product.picture" class="uploading-image mt-4" style="height: 100px;"/>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" @click="createProduct()">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductCreate",
    data() {
        return {
            product: {
                picture:""
            }
        }
    },
    methods: {
        createProduct() {
            this.axios.post('http://127.0.0.1:8000/api/product', this.product)
                .then(response => (
                    this.$router.push({name: 'ProductIndex'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
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
