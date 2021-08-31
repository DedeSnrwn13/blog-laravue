<template>
    <button ref="deletePost" @click="destroyPost">Delete</button>
</template>

<script>
export default {
    props: [
        'endpoint'
    ],

    mounted() {
        console.log(this.endpoint)
    },

    methods: {
        async destroyPost() {
            let question = window.confirm("Are you sure ?");

            if (question ==  true) {
                let response = await axios.delete(`/api/posts/${this.endpoint}/delete`);
                if (response.status == 200) {
                     this.$toasted.show(response.data.message, {
                        type: "success",
                        position: "top-right",
                        duration : 5000
                    })

                    this.$refs.deletePost.parentNode.parentNode.remove();
                } else {

                }
            }
        }
    }
}
</script>
