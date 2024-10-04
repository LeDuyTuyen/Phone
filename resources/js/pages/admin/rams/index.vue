<template>
    <v-card title="RAM">
        <v-row>
            <v-btn color="primary" @click="dialog = true">Thêm</v-btn>
        </v-row>

        <RamForm
            :visible="dialog"
            :ram="ram"
            @update:visible="dialog = $event"
            @submit="handleSubmit"
        />
        <template v-slot:text>
            <v-text-field
                v-model="search"
                label="Search"
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
            :search="search"
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
import RamForm from "./form.vue";

const dataSource = ref([]);
const ram = ref({ id: "", ram: "" });
const dialog = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");

const loading = ref(false);
const search = ref("");

const headers = [
    { title: "STT", key: "index" },
    { title: "RAM", key: "ram" },
    { title: "Hoạt động", key: "actions" },
];

const getRam = async () => {
    loading.value = true;
    try {
        const response = await axios.get("http://localhost:8000/api/admin/ram");
        dataSource.value = response.data;

        console.log(response.data);
    } catch (error) {
        console.error("Failed to fetch rams:", error);
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
    await getRam();
    dialog.value = false;
};

const store = async (formData) => {
    try {
        await axios.post("http://localhost:8000/api/admin/ram", formData);
        snackbarMessage.value = "Ram đã được thêm thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to create ram:", error);
    }
};

const update = async (formData) => {
    try {
        await axios.patch(
            `http://localhost:8000/api/admin/ram/${formData.id}`,
            formData
        );
        snackbarMessage.value = "Ram đã được cập nhật thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to update ram:", error);
    }
};

const remove = async (item) => {
    try {
        await axios.delete(`http://localhost:8000/api/admin/ram/${item.id}`);
        await getRam();
        snackbarMessage.value = "Ram đã được xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete ram:", error);
    }
};

const edit = (item) => {
    ram.value = { ...item };
    dialog.value = true;
};

onMounted(() => {
    getRam();
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
