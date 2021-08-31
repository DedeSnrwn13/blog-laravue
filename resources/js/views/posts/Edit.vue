<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Create New Article
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" v-on:submit.prevent="update">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input v-model="form.title" type="text" id="title" class="form-control">
                                <div v-if="theErrors.title" class="mt-2 text-danger">{{ theErrors.title[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="category">Categories</label>
                                <select @change="selectedCategory" id="category" class="form-control">
                                    <option :value="form.subjectId" v-text="form.category"></option>
                                    <template v-for="category in categories">
                                        <option v-if="form.categoryId !== category.id" :key="category.id" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </template>
                                </select>
                                <div v-if="theErrors.category" class="mt-2 text-danger">{{ theErrors.category[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" class="form-control" cols="30" rows="10"></textarea>
                                <div v-if="theErrors.description" class="mt-2 text-danger">{{ theErrors.description[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: [],
            categories: [],
            theErrors: [],
            selected: '',
            loading: false,
        }
    },

    mounted() {
        this.getCategories();
        this.getPost();
    },

    methods: {
        async getCategories() {
            let response = await axios.get('/api/categories')
            if (response.status === 200) {
                this.categories = response.data;
            }
        },

        async getPost() {
            let response = await axios.get(`/api/posts/${this.$route.params.postSlug}`);
            this.form = response.data.data
        },

        selectedCategory(e) {
            this.selected = e.target.value
        },

        async update() {
            this.loading = true;
            this.form['category'] = this.selected || this.form.categoryId;

            let response = await axios.patch(`/api/posts/${this.$route.params.postSlug}/edit`, this.form)

            if (response.status == 200) {
                this.loading = false;
                this.$toasted.show(response.data.message, {
                    type: "success",
                    position: "top-right",
                    duration : 5000
                })

                this.$router.push('/posts/table')
            }
        }
    }
}
</script>
