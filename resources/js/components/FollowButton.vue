<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser">Follow</button>
    </div>
</template>

<script>
    export default {
        props: ['userId'],


        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            followUser() {
                // reach in server
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        alert(response.data);
                    });
            }
        }
    }
</script>
