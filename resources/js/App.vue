<template>
    <v-app>
        <v-alert type="warning" :value="true">
            Vuetify was installed properly
        </v-alert>
        <router-view></router-view>

    </v-app>
</template>

<script>
export default {
    name: "App"
};
</script>
