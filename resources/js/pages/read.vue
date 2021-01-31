<template>
    <div class=" mt-3">
        <v-card
            style="cursor: pointer"
            :color="backgroundColor"
            dark
        >
            <v-card-title>
                <div class="flex flex-row">
                    <div class="title font-weight-light">{{ question.title }}</div>
                    <div class="h5 badge-dark badge">{{ category }}</div>
                </div>
            </v-card-title>

            <v-card-text class="headline font-weight-bold">
                "{{ question.body }}"
            </v-card-text>

            <v-card-actions>
                <v-list-item class="grow">
                    <v-list-item-avatar color="grey darken-3">
                        <v-img
                            class="elevation-6"
                            alt=""
                            src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                        ></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{ user_name === current_user_id ? 'You' : user_name }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-card-actions>
        </v-card>
        <reply-input :question="question.slug" @reply="createReply"></reply-input>
        <reply v-for="reply in replies" :key="reply.id" :reply='reply' :current_user_id="current_user_id"></reply>
    </div>
</template>
<script>

import reply from '../components/reply';
import replyInput from "../components/replyInput";

export default {
    components: {
        reply,
        replyInput
    },
    data: () => ({
        backgroundColor: '#' + (Math.random() * 0xDDDDDD << 0).toString(16),
        question: {},
        category: '',
        user_name: '',
        replies: [],
        current_user_id: User.id()
    }),
    methods: {
        createReply(data) {
            this.replies.unshift(data.reply);
        }
    },
    created() {
        axios.get('/api/question/' + this.$route.params.slug).then(
            res => {
                this.question = res.data.question;
                this.user_name = res.data.question.user.name;
                this.category = res.data.question.category.name;
                this.replies = res.data.replies.slice().reverse().map(reply => reply);
            }
        ).catch(err => console.log(err.response));
    }
}
</script>
