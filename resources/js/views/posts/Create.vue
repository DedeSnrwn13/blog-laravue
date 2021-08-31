<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Create New Article
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" v-on:submit.prevent="store">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" v-model="form.title" id="title" class="form-control">
                                <div v-if="theErrors.title" class="mt-2 text-danger">{{ theErrors.title[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="categories">Categories</label>
                                <select v-model="form.category" id="categories" class="form-control">
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <div v-if="theErrors.category" class="mt-2 text-danger">{{ theErrors.category[0] }}</div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" class="form-control" cols="30" rows="10"></textarea>
                                <div v-if="theErrors.description" class="mt-2 text-danger">{{ theErrors.description[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                Save
                                
                                <template v-if="loading">    
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="30px" height="30px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                        <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#ffffff" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
                                            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                                        </circle>
                                    </svg>
                                </template>
                            </button>
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
            form: {
                title: '',
                description: '',
                category: '',
            },
            loading: false,
            categories: [],
            theErrors: [],

        }
    },

    mounted() {
        this.getCategories();
    },

    methods: {
        async getCategories() {
            let response = await axios.get('/api/categories')
            if (response.status === 200) {
                this.categories = response.data;
            }
        },

        async store() {
            this.loading = true;
            try {
                let response = await axios.post('/api/posts/create-new-post', this.form)
                if (response.status === 200) {
                    this.form.title = ""
                    this.form.description = ""
                    this.form.title = ""
                    this.theErrors = []
                    this.loading = false;
                    this.$toasted.show(response.data.message, {
                        type: "success",
                        position: "top-right",
                        duration : 5000
                    })
                }
            } catch (e) {
                this.loading = false;
                this.$toasted.show("There is something wrong.", {
                    type: "error",
                    position: "top-right",
                    duration : 5000
                })
                this.theErrors = e.response.data.errors;
            }

        }
    },
}
</script>
