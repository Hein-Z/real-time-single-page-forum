<template>
    <form @submit.prevent="reply">
        <v-textarea
            label="Reply"
            v-model="body"
        ></v-textarea>
        <button type="submit" class="btn btn-primary btn-block" >Submit</button>
    </form>
</template>
<script>
export default {
    props: ['question'],
    data() {
        return {
            body: ''
        }
    },
    methods: {
        reply() {
            if (this.body) {
                axios.post('api/' + this.question + '/reply', {body: this.body}).then(res => {
                    this.$emit('reply', res.data);
                    this.body = '';
                }).catch();
            }
        }
    }
}
</script>
