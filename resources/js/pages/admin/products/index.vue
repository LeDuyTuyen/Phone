<template>
    <v-card title="Quản lý sản phẩm">
        <v-row>
            <v-btn color="primary" @click="createDialog = true">Thêm</v-btn>
        </v-row>

        <createForm
            :visible="createDialog"
            @update:visible="createDialog = $event"
            @submit="store"
        />
        <updateForm
            :visible="updateDialog"
            :product="product"
            @update:visible="updateDialog = $event"
            @submit="update"
        />

        <v-data-table
            :headers="headers"
            :items="dataSource"
            :items-per-page="20"
            items-per-page-text="Hiển thị:"
            disable-sort
            :loading="loading"
        >
            <template v-slot:[`item.index`]="{ index }">
                {{ index + 1 }}
            </template>

            <template v-slot:[`item.image`]="{ item }">
                <div v-if="item.image.length">
                    <v-img
                        v-for="(image, idx) in item.image"
                        :key="idx"
                        :src="image.path"
                        height="100"
                        width="100"
                        contain
                    ></v-img>
                </div>
                <span v-else>Không có ảnh</span>
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
import createForm from "./createForm.vue";
import updateForm from "./updateForm.vue";

const dataSource = ref([]);
const product = ref({});
const createDialog = ref(false);
const updateDialog = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");
const loading = ref(false);

const headers = [
    { title: "STT", key: "index" },
    { title: "Tên", key: "name" },
    { title: "Hình ảnh", key: "image" },
    { title: "Mô tả", key: "description" },
    { title: "Danh mục", key: "category_name" },
    { title: "Hoạt động", key: "actions" },
];

const getProduct = async () => {
    loading.value = true;
    try {
        const response = await axios.get(
            "http://localhost:8000/api/admin/product"
        );
        dataSource.value = response.data;

        // console.log(response);
    } catch (error) {
        console.error("Failed to fetch product :", error);
    } finally {
        loading.value = false;
    }
};

const store = async (formData) => {
    try {
        await axios.post(
            "http://localhost:8000/api/admin/product/upload",
            formData
        );
        snackbarMessage.value = "Thêm thành công!";
        snackbar.value = true;
        await getProduct();
    } catch (error) {
        console.error("Failed to create product:", error);
    } finally {
        createDialog.value = false;
    }
};

const update = async ({ formData, id }) => {
    try {
        const response = await axios.post(
            `http://localhost:8000/api/admin/product/${id}`,
            formData
        );
        console.log(response.data);
        snackbarMessage.value = " Cập nhật thành công!";
        snackbar.value = true;
        await getProduct();
    } catch (error) {
        console.error("Cập nhật thất bại:", error);
    } finally {
        updateDialog.value = false;
    }
};

const remove = async (product) => {
    try {
        const response = await axios.delete(
            `http://localhost:8000/api/admin/product/${product.id}`
        );
        console.log(response);
        await getProduct();
        snackbarMessage.value = "Xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete product:", error);
    }
};
const removeImage = async (id, public_id) => {
    try {
        await axios.delete(
            `http://localhost:8000/api/admin/product/${id}/image/${public_id}`
        );
        snackbarMessage.value = "Ảnh đã được xóa thành công!";
        snackbar.value = true;
        await getProduct(); // Cập nhật lại danh sách sản phẩm
    } catch (error) {
        console.error("Failed to delete image:", error);
        snackbarMessage.value = "Xóa ảnh thất bại!";
        snackbar.value = true;
    }
};

const edit = (item) => {
    product.value = { ...item };
    updateDialog.value = true;
};

onMounted(() => {
    getProduct();
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
