<template>
    <div class="row mt-8">
        <question v-for="question in questions"
                  :key="question.id"
                  :id="question.id" :title="question.title" :body="question.body"
                  :slug="question.slug" :created-at="question.created_at"
                  :category-name="question.category.name"
                  :user-name="question.user.name"
        ></question>
    </div>
</template>
<script>
import question from "../components/question";

export default {
    data() {
        return {
            questions: {}
        }
    },
    components: {
        question
    },
    created() {
        axios.get('api/question').then(res => {
            this.questions = res.data
        }).catch(err => console.log(err.response));
    }
}
</script>
