<template>
    <v-card title="Màu">
        <v-row>
            <v-btn color="primary" @click="dialog = true">Thêm</v-btn>
        </v-row>

        <ColorForm
            :visible="dialog"
            :color="color"
            @update:visible="dialog = $event"
            @submit="handleSubmit"
        />

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
import { ref, onMounted } from "vue";
import ColorForm from "./form.vue";

const dataSource = ref([]);
const color = ref({});
const dialog = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");

const loading = ref(false);

const headers = [
    { title: "STT", key: "index" },
    { title: "Tên", key: "name" },
    { title: "Mã màu", key: "code" },
    { title: "Hoạt động", key: "actions" },
];

const getColor = async () => {
    loading.value = true;
    try {
        const response = await axios.get(
            "http://localhost:8000/api/admin/color"
        );
        dataSource.value = response.data;
    } catch (error) {
        console.error("Failed to fetch colors", error);
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
    await getColor();
    dialog.value = false;
};

const store = async (formData) => {
    try {
        await axios.post("http://localhost:8000/api/admin/color", formData);
        snackbarMessage.value = "Màu đã được thêm thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to create color:", error);
    }
};

const update = async (formData) => {
    try {
        await axios.patch(
            `http://localhost:8000/api/admin/color/${formData.id}`,
            formData
        );
        snackbarMessage.value = "Màu đã được cập nhật thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to update color:", error);
    }
};

const remove = async (item) => {
    try {
        await axios.delete(`http://localhost:8000/api/admin/color/${item.id}`);
        await getColor();
        snackbarMessage.value = "Màu đã được xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete color:", error);
    }
};

const edit = (item) => {
    color.value = { ...item };
    dialog.value = true;
};

onMounted(() => {
    getColor();
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
