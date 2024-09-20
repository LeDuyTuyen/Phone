<template>
    <v-navigation-drawer permanent style="background-color: beige">
        <v-list nav dense>
            <v-list-item
                v-for="item in items"
                :key="item.title"
                :to="item.route"
            >
                <v-list-item
                    ><v-icon class="mr-2"> {{ item.icon }}</v-icon
                    >{{ item.title }}</v-list-item
                >
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { ref } from "vue";

const items = ref([
    {
        title: "Danh mục",
        icon: "mdi-view-headline",
        route: { name: "admin-category" },
    },
    {
        title: "Sản phẩm",
        icon: "mdi-view-headline",
        route: { name: "admin-product" },
    },
    {
        title: "Màu",
        icon: "mdi-view-headline",
        route: { name: "admin-color" },
    },
    {
        title: "RAM",
        icon: "mdi-view-headline",
        route: { name: "admin-ram" },
    },
    {
        title: "Bộ nhớ",
        icon: "mdi-view-headline",
        route: { name: "admin-storage" },
    },
    {
        title: "Kho",
        icon: "mdi-view-headline",
        route: { name: "admin-warehouse" },
    },
    {
        title: "Phiếu nhập",
        icon: "mdi-view-headline",
        route: { name: "admin-importOrder" },
    },
]);
</script>
