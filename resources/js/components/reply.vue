<template>
    <v-card class="mt-2">
        <v-card-text class="headline font-weight-bold">
            "{{ reply.body }}"
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
                    <v-list-item-title>{{ reply.user.name === current_user_id ? 'You' : reply.user.name }}
                    </v-list-item-title>
                </v-list-item-content>

                <v-row
                    align="center"
                    justify="end"
                >
                    <v-icon class="mr-1" @click="like" :color="likeColor()">
                        mdi-heart
                    </v-icon>
                    <span class="subheading mr-2">{{ like_count }}</span>
                </v-row>
            </v-list-item>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    props: ['reply', 'current_user_id'],
    data() {
        return {
            isLiked: false,
            like_count: 0
        }
    },
    methods: {
        like() {
            if (this.isLiked) {
                axios.post(`api/${this.reply.id}/unlike`).then(res => {
                    this.like_count--;
                    this.isLiked = false;
                }).catch();
            } else {
                axios.post(`api/${this.reply.id}/like`).then(res => {
                    this.like_count++;
                    this.isLiked = true;
                }).catch();
            }
        },
        likeColor() {
            return !!this.isLiked ? 'red lighten-2' : '';
        }
    },
    created() {
        Echo.channel('like-channel')
            .listen('LikeEvent', (e) => {
                if (e.id === this.reply.id) {
                    if (e.type === 'like') {
                        this.like_count++;
                    }
                    if ((e.type === 'unlike')) {
                        this.like_count--;
                    }
                }
            });
        this.isLiked = !!this.reply.likes.find(like => like.user_id === User.id());
        this.like_count = this.reply.likes.length;
    }
}
</script>
