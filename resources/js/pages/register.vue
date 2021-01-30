<template>
    <v-app>
        <h1 class="text-center mt-5">Register Your Account</h1>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            class="mt-16"
        >

            <v-text-field
                v-model="name"
                :rules="nameRules"
                label="Name"
                required
            ></v-text-field>

            <br>
            <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
            ></v-text-field>
            <br>
            <v-text-field
                v-model="password"
                :counter="10"
                :rules="passwordRules"
                label="Password"
                required
                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show1 ? 'text' : 'password'"
                value=""
                @click:append="show1 = !show1"
            ></v-text-field>
            <br>
            <v-text-field
                v-model="password_confirmation"
                :counter="10"
                :rules="passwordConfirmationRules"
                label="Confirm Password"
                required
                value=""
                :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show2 ? 'text' : 'password'"
                @click:append="show2 = !show2"
            ></v-text-field>
            <small
                class="text-center text-danger">{{
                    password !== password_confirmation ? 'Password do not match' : ''
                }}</small>
            <br>
            <v-btn
                color="primary"
                @click="register"
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
        show1: false,
        show2: true,
        name: '',
        nameRules: [
            v => !!v || 'Name is required',
            v => v.length >= 4 || 'Min 4 characters',
            v => v.length < 15 || 'Max 15 characters',
        ],
        password: '',
        passwordRules: [
            v => !!v || 'Password is required',
            v => v.length >= 6 || 'Min 6 characters',
            v => v.length < 10 || 'Max 10 characters',
        ],
        password_confirmation: '',
        passwordConfirmationRules: [
            v => !!v || 'Password is required',
            v => v.length >= 6 || 'Min 6 characters',
            v => v.length < 10 || 'Max 10 characters'
        ],
        email: '',
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
    }),

    methods: {
        register() {
            if (this.password !== this.password_confirmation) {
                return;
            }
            if (this.valid) {
                axios.post('api/auth/signup', {
                    email: this.email,
                    password: this.password,
                    name: this.name,
                    password_confirmation: this.password_confirmation
                })
                    .then(res => {
                        User.responseAfterLogin(res);
                        if (User.isLoggedIn()) {
                            this.$router.push({name: 'forum'});
                            this.$eventHub.$emit('logged-in');

                        }
                    }).catch(err => {
                    alert(err.response.data.errors.email[0]);
                });
            }
        }
    },
}
</script>
