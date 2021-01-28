<template>
    <v-app>
        <h1 class="text-center mt-5">Login Your Account</h1>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            @submit.prevent="login"
            class="mt-16"
        >

            <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
            ></v-text-field>
            <v-text-field
                v-model="password"
                :rules="passwordRule"
                label="Password"
                required
            ></v-text-field>

            <v-btn
                color="primary"
                @click="login"
            >
                Submit
            </v-btn>
        </v-form>
    </v-app>
</template>
<script>

export default {
    name: 'login',
    data: () => ({
        valid: true,
        password: '',
        passwordRule: [
            v => !!v || 'Password is required',
        ],
        email: '',
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
    }),

    methods: {
        login() {
            if (this.valid) {
                axios.post('api/auth/login', {email: this.email, password: this.password})
                    .then(res => {
                        User.responseAfterLogin(res)
                        if (User.isLoggedIn()) {
                            this.$router.push({name: 'forum'});
                            this.$eventHub.$emit('logged-in');
                        }
                    }).catch(err => console.log(err.response));
            }
        }
    },
    created() {
    }
}
</script>
