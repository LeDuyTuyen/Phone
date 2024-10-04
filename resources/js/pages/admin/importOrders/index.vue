<template>
    <ImportOrderForm
        v-if="dialog !== null && importOrder !== null"
        :visible="dialog"
        :importOrder="importOrder"
        @update:visible="dialog = $event"
        @submit="handleSubmit"
    />
    <ImportOrderDetailsForm
        v-if="detailDialog"
        :visible="detailDialog"
        :importOrderId="importOrderId"
        @update:visible="detailDialog = $event"
    />

    <v-row>
        <v-btn color="primary" @click="dialog = true">Thêm</v-btn>
    </v-row>

    <v-data-table
        :headers="headers"
        :items="dataSource"
        :items-per-page="10"
        items-per-page-text="Hiển thị:"
        disable-sort
        :loading="loading"
        show-expand
    >
        <template v-slot:[`item.index`]="{ index }">
            {{ index + 1 }}
        </template>

        <template v-slot:[`item.actions`]="{ item }">
            <v-btn icon size="x-small" color="primary" @click="add(item)">
                <v-icon>mdi-plus</v-icon>
            </v-btn>
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
</template>

<script setup>
import { ref, onMounted } from "vue";
import ImportOrderForm from "./form.vue";
import ImportOrderDetailsForm from "./importOrderDetails/form.vue";

const dataSource = ref([]);
const importOrder = ref({});
const dialog = ref(false);
const detailDialog = ref(false);
const importOrderId = ref(null);
const snackbar = ref(false);
const snackbarMessage = ref("");

const loading = ref(false);

const headers = [
    { title: "STT", key: "index" },
    { title: "Tổng", key: "total" },
    { title: "Người nhập", key: "user.name" },
    { title: "Ngày nhập", key: "created_at" },
    { title: "Hoạt động", key: "actions" },
];

const getImportOrder = async () => {
    loading.value = true;
    try {
        const response = await axios.get(
            "http://localhost:8000/api/admin/importOrder"
        );
        dataSource.value = response.data.data;
        console.log(response.data);
    } catch (error) {
        console.error("Failed to fetch importOrder :", error);
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
    await getImportOrder();
    dialog.value = false;
};

const store = async (formData) => {
    try {
        console.log(formData);
        await axios.post(
            "http://localhost:8000/api/admin/importOrder",
            formData
        );
        snackbarMessage.value = "Thêm thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to create importOrder:", error);
    }
};

const update = async (formData) => {
    try {
        await axios.patch(
            `http://localhost:8000/api/admin/importOrder/${formData.id}`,
            formData
        );
        snackbarMessage.value = "Cập nhật thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to update importOrder:", error);
    }
};

const remove = async (item) => {
    try {
        await axios.delete(
            `http://localhost:8000/api/admin/importOrder/${item.id}`
        );
        await getImportOrder();
        snackbarMessage.value = "Xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete importOrder:", error);
    }
};

const add = (item) => {
    importOrderId.value = item.id;
    detailDialog.value = true;
};

const edit = (item) => {
    importOrder.value = { ...item };
    dialog.value = true;
};

onMounted(() => {
    getImportOrder();
});
</script>
<style>
.v-row {
    justify-content: end;
    margin: 0px 0px 10px 0px;
}
.v-data-table {
    table-layout: fixed;
    width: 100%;
}
.expanded-row-cell {
    padding: 8px;
}
</style>
