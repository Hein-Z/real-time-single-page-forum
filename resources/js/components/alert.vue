<template>
    <div class="pt-5" style="cursor: pointer" @click="markAsRead">
        <v-alert
            border="right"
            :color="color"
            dark
        >
            <div class="title">
                {{ data.replyBy }} replied your question "{{ data.question }}" at {{ format(date) }}
            </div>
        </v-alert>
    </div>
</template>
<script>
import moment from 'moment'

export default {
    props: ['data', 'date', 'type', 'id'],
    data() {
        return {
            color: '',
            isUnread: false
        }
    },
    methods: {
        format(date) {
            return moment(date, "YYYYMMDD").fromNow();
        },
        markAsRead() {
            if (this.isUnread) {
                axios.get(`api/markAsRead/${this.id}`).then(res => {
                        this.$router.push('/read/' + this.data.slug)
                        this.$eventHub.$emit('markAsRead');
                    }
                ).catch(err => console.log(err.response));
            } else {
                this.$router.push('/read/' + this.data.slug)
            }
        }
    },
    created() {
        if (this.type === 'unread') {
            this.color = 'blue-grey';
            this.isUnread = true;
        } else if (this.type === 'read') {
            this.color = 'indigo';
            this.isUnread = false;
        }
    }
}
</script>
