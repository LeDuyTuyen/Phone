<template>
    <v-app-bar app style="background-color: beige">
        <v-container fluid>
            <v-row class="col-12">
                <v-col>
                    <span class="title">Trang Quản Trị</span>
                </v-col>

                <v-col class="d-flex justify-content-end">
                    <v-menu offset-y>
                        <template v-slot:activator="{ attrs }">
                            <v-btn text @click="goToInfoPage">
                                <v-avatar color="" v-bind="attrs">
                                    <v-icon icon="mdi-account-circle"></v-icon>
                                </v-avatar>
                                <span class="ml-2">Admin</span>
                            </v-btn>
                        </template>
                    </v-menu>
                </v-col>
            </v-row>
        </v-container>
    </v-app-bar>
</template>

<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const goToInfoPage = () => {
    router.push("/admin/user-info");
};
</script>

<style>
.title {
    font-weight: bold;
}
</style>
