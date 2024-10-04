<template>
    <v-dialog
        v-model="localDialog"
        max-width="600"
        transition="dialog-bottom-transition"
    >
        <v-card>
            <v-card-text>
                <v-card-title> Chỉnh sửa </v-card-title>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field
                        v-model="localForm.name"
                        :rules="[rules.required]"
                        label="Tên sản phẩm"
                        required
                    />

                    <v-text-field
                        v-model="localForm.description"
                        label="Mô tả"
                    />
                    <v-file-input
                        v-model="localForm.image"
                        label="Chọn ảnh"
                        prepend-icon="mdi-camera"
                        chips
                        multiple
                        :item-text="getItemText"
                    />

                    <v-select
                        v-model="localForm.category_id"
                        :items="categories"
                        item-title="name"
                        item-value="id"
                        label="Danh mục"
                        :rules="[rules.required]"
                        required
                    />
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="error" text @click="cancel">Hủy</v-btn>
                <v-btn color="primary" text @click="submit">Lưu</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
    visible: Boolean,
    product: Object,
});
const emit = defineEmits(["update:visible", "submit"]);

const localDialog = ref(props.visible);
const localForm = ref({ ...props.product });
const valid = ref(false);
const categories = ref({});

const rules = {
    required: (value) => !!value || "Không được để trống.",
};
const resetForm = () => {
    localForm.value = {};
};
function getItemText(item) {
    return item.path ? item.path.split("/").pop() : item.name || "Không có tên";
}

const fetchOptions = async () => {
    try {
        const categoryData = await axios.get(
            "http://localhost:8000/api/admin/category"
        );

        const category = categoryData.data.map((item) => ({
            id: item.id,
            name: item.name,
        }));

        localStorage.setItem("category", JSON.stringify(category));
    } catch (error) {
        console.error("Failed to fetch :", error);
    }
};

const loadDataOption = async () => {
    const categoryData = localStorage.getItem("category");
    try {
        const category = JSON.parse(categoryData);

        categories.value = category;
    } catch (error) {
        console.error("Error parsing localStorage data:", error);
    }
};

watch(
    () => props.visible,
    (newVal) => {
        localDialog.value = newVal;
    },
    { immediate: true }
);

watch(
    () => localDialog.value,
    (newVal) => {
        if (newVal) {
            loadDataOption();
        } else {
            resetForm();
            emit("update:visible", false);
        }
    }
);

watch(
    () => props.product,
    (newVal) => {
        localForm.value = { ...newVal };
    }
);

const submit = () => {
    if (valid.value) {
        const formData = new FormData();
        formData.append("_method", "PATCH");
        Object.keys(localForm.value).forEach((key) => {
            if (key === "image" && localForm.value.image) {
                // Nếu là ảnh, thêm từng file vào FormData
                localForm.value.image.forEach((file) => {
                    formData.append(`image[]`, file);
                });
            } else {
                formData.append(key, localForm.value[key] || "");
            }
        });
        emit("submit", { formData, id: localForm.value.id });
    }
};

const cancel = () => {
    localDialog.value = false;
};
onMounted(() => {
    fetchOptions();
});
</script>
