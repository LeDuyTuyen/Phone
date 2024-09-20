<template>
    <v-row>
        <v-col cols="12">
            <v-btn color="primary" @click="openForm">Thêm Chi Tiết</v-btn>
        </v-col>
        <v-col cols="12">
            <v-data-table
                :headers="headers"
                :items="detailsData"
                :items-per-page="10"
                items-per-page-text="Hiển thị:"
                disable-sort
                :loading="loading"
            >
                <template v-slot:[`item.index`]="{ index }">
                    {{ index + 1 }}
                </template>

                <template v-slot:[`item.actions`]="{ item }">
                    <v-btn
                        icon
                        size="x-small"
                        color="primary"
                        @click="editDetail(item)"
                    >
                        <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn
                        icon
                        size="x-small"
                        color="error"
                        @click="removeDetail(item)"
                    >
                        <v-icon>mdi-delete</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </v-col>
    </v-row>

    <ImportOrderDetailForm
        v-if="formDialogVisible"
        :visible="formDialogVisible"
        :detail="selectedDetail"
        @update:visible="formDialogVisible = $event"
        @submit="handleDetailSubmit"
    />
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import ImportOrderDetailForm from "./form.vue";

const detailsData = ref([]);
const selectedDetail = ref({});
const formDialogVisible = ref(false);
const loading = ref(false);

const headers = [
    { title: "STT", key: "index" },
    { title: "Giá", key: "price" },
    { title: "Số lượng", key: "quantity" },
    { title: "Đơn hàng", key: "import_order.name" },
    { title: "Kho", key: "wareHouse.name" },
    { title: "Hoạt động", key: "actions" },
];

const openForm = () => {
    selectedDetail.value = {}; // Reset the selected detail
    formDialogVisible.value = true;
};

const handleDetailSubmit = async (formData) => {
    if (formData.id) {
        await updateDetail(formData);
    } else {
        await createDetail(formData);
    }
    await fetchDetails();
    formDialogVisible.value = false;
};

const createDetail = async (formData) => {
    try {
        await axios.post(
            "http://localhost:8000/api/admin/importOrderDetails",
            formData
        );
        snackbarMessage.value = "Thêm thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to create detail:", error);
    }
};

const updateDetail = async (formData) => {
    try {
        await axios.patch(
            `http://localhost:8000/api/admin/importOrderDetails/${formData.id}`,
            formData
        );
        snackbarMessage.value = "Cập nhật thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to update detail:", error);
    }
};

const removeDetail = async (item) => {
    try {
        await axios.delete(
            `http://localhost:8000/api/admin/importOrderDetails/${item.id}`
        );
        await fetchDetails();
        snackbarMessage.value = "Xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete detail:", error);
    }
};

const editDetail = (item) => {
    selectedDetail.value = { ...item };
    formDialogVisible.value = true;
};

const fetchDetails = async () => {
    loading.value = true;
    try {
        const response = await axios.get(
            "http://localhost:8000/api/admin/importOrderDetails"
        );
        detailsData.value = response.data.data;
    } catch (error) {
        console.error("Failed to fetch details:", error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchDetails();
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
</style>
