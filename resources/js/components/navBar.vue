<template>
    <v-navigation-drawer
        v-model="drawer"
        :mini-variant.sync="mini"
        permanent
    >
        <v-list-item class="px-2">
            <v-list-item-avatar class="rounded-0">
                <v-img
                    src="https://img.favpng.com/15/8/0/internet-forum-discussion-group-portable-network-graphics-clip-art-computer-icons-png-favpng-qAvEEmg1F42QNbejsMmSW283P.jpg"></v-img>
            </v-list-item-avatar>

            <v-list-item-title>Realtime Forum</v-list-item-title>

            <v-btn
                icon
                @click.stop="mini = !mini"
            >
                <v-icon>mdi-chevron-left</v-icon>
            </v-btn>
        </v-list-item>

        <v-divider></v-divider>

        <v-list dense>
            <!--            forum-->
            <router-link v-for="(item,index) in items" :key="index" v-if="item.show" :to="item.to">

                <v-list-item
                    link
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                        <div class="badge badge-success" v-if="isNoti(item.title)">{{ noti_count }}</div>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title> {{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </router-link>


            <v-list-item
                link
                @click="logout"
                v-if="logoutItem.show"
            >
                <v-list-item-icon>
                    <v-icon>{{ logoutItem.icon }}</v-icon>

                </v-list-item-icon>

                <v-list-item-content>

                    <v-list-item-title>{{ logoutItem.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>


        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    data() {
        return {
            drawer: true,
            isLoggedIn: null,
            mini: true,
            noti_count: null,
            items: [
                {title: 'Forum', icon: 'mdi-home-city', to: '/forum', show: true},
                {
                    title: 'Create Question',
                    icon: 'mdi-comment-question',
                    to: '/question/create',
                    show: User.isLoggedIn()
                },
                {
                    title: 'Notification',
                    icon: 'mdi-bell',
                    to: '/notification',
                    show: User.isLoggedIn()
                },
                {title: 'Login', icon: 'mdi-login', to: '/login', show: !User.isLoggedIn()},
                {title: 'Sign Up', icon: 'mdi-account-multiple-plus', to: '/register', show: !User.isLoggedIn()}
            ],
            logoutItem: {title: 'Logout', icon: 'mdi-logout', show: User.isLoggedIn()},
        }
    },
    watch: {
        isLoggedIn() {
            this.items.forEach((item, index) => {
                if (index !== 0) {
                    if (index === 1 || index === 2) {
                        item.show = this.isLoggedIn
                    } else {
                        item.show = !this.isLoggedIn
                    }
                }
            });
            this.logoutItem.show = this.isLoggedIn;
        }
    },
    methods: {
        logout() {
            User.logout();
            if (!User.isLoggedIn()) {
                this.$router.push({name: 'login'});
                this.isLoggedIn = User.isLoggedIn();
                window.axios.defaults.headers.common['Authorization'] = '';
            }
        },
        isNoti(data) {
            return data === 'Notification';
        }
    },
    created() {
        this.isLoggedIn = User.isLoggedIn();
        this.$eventHub.$on('logged-in', _ => this.isLoggedIn = User.isLoggedIn());
        this.$eventHub.$on('notify', noti_count => {
            this.noti_count = noti_count;
        });
        this.$eventHub.$on('markAsRead', _ => this.noti_count--);
    }
}
</script>
