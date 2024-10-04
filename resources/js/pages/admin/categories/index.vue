<template>
    <v-card title="Quản lý danh mục">
        <v-row>
            <v-btn color="primary" @click="dialog = true">Thêm</v-btn>
        </v-row>

        <CategoryForm
            :visible="dialog"
            :category="category"
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
import CategoryForm from "./form.vue";

const dataSource = ref([]);
const category = ref({});
const dialog = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");
const search = ref();

const loading = ref(false);

const headers = [
    { title: "STT", key: "index" },
    { title: "Tên", key: "name" },
    { title: "Slug", key: "slug" },
    { title: "Hoạt động", key: "actions" },
];

const getCategory = async () => {
    loading.value = true;
    try {
        const response = await axios.get(
            "http://localhost:8000/api/admin/category",
            {
                params: {
                    category: search.value,
                },
            }
        );
        dataSource.value = response.data;
    } catch (error) {
        console.error("Failed to fetch categories:", error);
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
    await getCategory();

    dialog.value = false;
};

const store = async (formData) => {
    try {
        await axios.post("http://localhost:8000/api/admin/category", formData);
        snackbarMessage.value = "Danh mục đã được thêm thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to create category:", error);
    }
};

const update = async (formData) => {
    try {
        await axios.patch(
            `http://localhost:8000/api/admin/category/${formData.id}`,
            formData
        );
        snackbarMessage.value = "Danh mục đã được cập nhật thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to update category:", error);
    }
};

const remove = async (item) => {
    try {
        await axios.delete(
            `http://localhost:8000/api/admin/category/${item.id}`
        );

        await getCategory();
        snackbarMessage.value = "Danh mục đã được xóa thành công!";
        snackbar.value = true;
    } catch (error) {
        console.error("Failed to delete category:", error);
    }
};

const edit = (item) => {
    category.value = { ...item };
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
        await getCategory(newSearch);
    }, 500)
);

onMounted(() => {
    getCategory();
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
