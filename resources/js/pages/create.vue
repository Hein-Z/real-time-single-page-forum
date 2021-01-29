<template>
    <form class="pt-15" @submit.prevent="askQuestion">
        <h5 class="text-center">Create Question</h5>
        <v-text-field label="Title" v-model="title"></v-text-field>
        <v-textarea
            label="Ask your question"
            v-model="body"
        ></v-textarea>
        <v-select
            :items="categories"
            label="Category"
            v-model="category"
        ></v-select>
        <button type="submit" class="btn btn-primary" >Ask</button>
    </form>
</template>
<script>
export default {
    data() {
        return {
            categories: [],
            category_ids: [],
            category: '',
            title: '',
            body: ''
        }
    },
    methods: {
        askQuestion() {
            if (this.title && this.body && this.category) {
                axios.post('api/question', {
                    body: this.body,
                    title: this.title,
                    category_id: this.category
                }).then(res => {
                    this.$router.push({name: 'forum'});
                }).catch();
            }
        }
    },
    created() {
        axios.get('api/category').then(res => {
            this.categories = res.data.map(category => {
                return {text: category.name, value: category.id}
            });
        }).catch();
    }
}
</script>
