<template>
    <v-app>
        <div class="position-relative">
            <div class="row">
                <nav-bar class="position-fixed" style="z-index: 100"></nav-bar>
                <router-view class="col-10 offset-1" style="min-height: 100vh"></router-view>
            </div>
        </div>
    </v-app>
</template>

<script>
import navBar from './components/navBar';

export default {
    name: "App",
    components: {
        navBar
    }
};
</script>
