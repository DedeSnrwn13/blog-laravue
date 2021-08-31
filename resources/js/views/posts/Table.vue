<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Table Of Post</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Publshed</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts" :key="post.id">
                            <th>1</th>
                            <td><router-link :to="{ name: 'posts.show', params: { postSlug: post.slug } }">{{ post.title }}</router-link></td>
                            <td>{{ post.category }}</td>
                            <td>{{ post.published }}</td>
                            <td><router-link :to="{ name: 'posts.edit', params: { postSlug: post.slug } }" class="btn btn-warning">Edit</router-link></td>
                            <td><delete-post :endpoint="post.slug"></delete-post></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import DeletePost from './Delete.vue'

export default {
    components: {
        DeletePost
    },

    data() {
        return {
            posts: []
        }
    },

    mounted() {
        axios.get('/api/posts').then((response) => {
            this.posts = response.data.data
            console.log(response.data.data);
        }).catch((err) => {

        });;
    },

    methods: {
        async getPost() {
            let { data } = await axios.get('/api/posts');
            this.post = data.data
        }
    }
}
</script>
