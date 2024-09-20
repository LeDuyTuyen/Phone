<template>
    <Header v-if="!$route.meta.hideHeader" />
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-list bordered>
                        <Menu v-if="!$route.meta.hideMenu" />
                        <template #body></template>
                    </v-list>
                    <router-view />
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
import Header from "../components/Header.vue";
import Menu from "../components/Menu.vue";
export default {
    components: {
        Header,
        Menu,
    },
};
</script>
<style>
.body {
    margin: 0;
    padding: 0;
}
</style>
