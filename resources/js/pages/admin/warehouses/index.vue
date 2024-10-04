<template>
    <v-card title="Quản lý kho">
        <v-row>
            <v-btn color="primary" @click="dialog = true">Thêm</v-btn>
        </v-row>

        <WarehouseForm
            v-if="dialog !== null && warehouse !== null"
            :visible="dialog"
            :warehouse="warehouse"
            @update:visible="dialog = $event"
            @submit="handleSubmit"
        />

        <template v-slot:text>
            <v-text-field
                v-model="search"
                label="Tìm kiếm"
                prepend-inner-icon="mdi-magnify"
                variant="outlined"
                hide-details
                single-line
            ></v-text-field>
        </template>
        <v-data-table
            :headers="headers"
            :items="dataSource"
            :items-per-page="10"
            items-per-page-text="Hiển thị:"
            disable-sort
            :loading="loading"
        >
            <template v-slot:[`item.index`]="{ index }">
                {{ index + 1 }}
            </template>

            <template v-slot:[`item.actions`]="{ item }">
                <v-btn icon size="x-small" color="primary" @click="edit(item)">
                    <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon size="x-small" color="error" @click="remove(item)">
                    <v-icon>mdi-delete</v-icon>
                </v-btn>
            </template>
        </v-data-table>
        <v-snackbar v-model="snackbar" :timeout="3000" color="success">
            {{ snackbarMessage }}
        </v-snackbar>
    </v-card>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import WarehouseForm from "./form.vue";
import axios from "axios";

const dataSource = ref([]);
const warehouse = ref({});
const dialog = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");
const search = ref();
const loading = ref(false);

const headers = [
    { title: "STT", key: "index" },
    { title: "Tên sản phẩm", key: "product.name" },
    { title: "Giá", key: "price" },
    { title: "Màu", key: "color.name" },
    { title: "RAM", key: "ram.ram" },
    { title: "Bộ nhớ", key: "storage.storage" },
    { title: "Hoạt động", key: "actions" },
];

const getWarehouse = async () => {
    loading.value = true;
    try {
        const response = await axios.get(
            "http://localhost:8000/api/admin/warehouse",
            { params: {} }
        );
        dataSource.value = response.data;
    } catch (error) {
        console.error("Failed to fetch warehouse :", error);
    } finally {
        loading.value = false;
    }
};

const handleSubmit = async (formData) => {
    if (formData.id) {
        await update(formData);
    } else {
        await store(formData);
    }
    await getWarehouse();
    dialog.value = false;
};

const store = async (formData) => {
    try {
        console.log(formData);
        await axios.post("http://localhost:8000/api/admin/warehouse", formData);
        snackbarMessage.value = "Thêm thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to create warehouse:", error);
    }
};

const update = async (formData) => {
    try {
        console.log(formData);
        await axios.patch(
            `http://localhost:8000/api/admin/warehouse/${formData.id}`,
            formData
        );
        snackbarMessage.value = "Cập nhật thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to update warehouse:", error);
    }
};

const remove = async (item) => {
    try {
        await axios.delete(
            `http://localhost:8000/api/admin/warehouse/${item.id}`
        );
        await getWarehouse();
        snackbarMessage.value = "Xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete warehouse:", error);
    }
};

const edit = (item) => {
    warehouse.value = { ...item };
    dialog.value = true;
};

function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(this, args);
        }, wait);
    };
}

watch(
    search,
    debounce(async (newSearch) => {
        await getWarehouse(newSearch);
    }, 500)
);

onMounted(() => {
    getWarehouse();
});
</script>
<style>
.v-row {
    justify-content: end;
    padding: 10px;
    margin: 0;
}
.v-card {
    width: 100%;
}
</style>
