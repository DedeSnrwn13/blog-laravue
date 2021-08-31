<template>
    <div class="container">
        <h1>{{ post.title }}</h1>
        <hr>
        <span>{{ post.published }} - {{ post.category }}</span>
        <p>{{ post.description }}</p>

    </div>
</template>

<script>
export default {
    data() {
        return {
            post: []
        }
    },

    mounted() {
        this.getPost();
        // console.log(this.$route.params);
    },

    methods: {
        async getPost() {
            let { data } = await axios.get('/api/posts/' +  this.$route.params.postSlug)
            this.post = data.data
        }
    }
}
</script>
