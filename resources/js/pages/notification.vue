<template>
    <div>
        <alert v-for="noti in notifications" :key="noti.id" :data="noti.data" :date="noti.created_at"
               :type="noti.read_at?'read':'unread'" :id="noti.id">
        </alert>
    </div>
</template>
<script>

import alert from '../components/alert'

export default {
    components: {
        alert
    },
    data() {
        return {
            notifications: [],
            noti_count: 0
        }
    },
    created() {
        axios.post('api/notification').then(res => {
            this.notifications = res.data.notifications;
            this.notifications.forEach(noti => {
                if (!noti.read_at) {
                    this.noti_count++;
                }
            });
            this.$eventHub.$emit('notify', this.noti_count);
        }).catch();


    }
}
</script>
