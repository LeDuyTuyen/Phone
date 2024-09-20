<template>
    <v-dialog v-model="localDialog" max-width="600">
        <v-card>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-select
                        v-model="localForm.product"
                        :items="products"
                        item-title="name"
                        item-value="id"
                        :rules="[rules.required]"
                        label="Tên sản phẩm"
                        required
                    ></v-select>
                    <v-text-field
                        v-model="localForm.price"
                        label="Giá"
                        required
                        min="0"
                        type="number"
                    ></v-text-field>
                    <v-select
                        v-model="localForm.color"
                        :items="colors"
                        item-title="name"
                        item-value="id"
                        label="Màu"
                        :rules="[rules.required]"
                        required
                    />
                    <v-select
                        v-model="localForm.ram"
                        :items="rams"
                        item-title="ram"
                        item-value="id"
                        label="RAM"
                        :rules="[rules.required]"
                        required
                    />
                    <v-select
                        v-model="localForm.storage"
                        :items="storages"
                        item-title="storage"
                        item-value="id"
                        label="Bộ nhớ"
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
import { onMounted, ref, watch } from "vue";

const props = defineProps({
    visible: Boolean,
    warehouse: Object,
});
const emit = defineEmits(["update:visible", "submit"]);

const localDialog = ref(props.visible);
const localForm = ref({ ...props.warehouse });
const valid = ref(false);
const products = ref([]);
const colors = ref([]);
const rams = ref([]);
const storages = ref([]);

const fetchOptions = async () => {
    try {
        const [productData, colorData, ramData, storageData] =
            await Promise.all([
                axios.get("http://localhost:8000/api/admin/product"),
                axios.get("http://localhost:8000/api/admin/color"),
                axios.get("http://localhost:8000/api/admin/ram"),
                axios.get("http://localhost:8000/api/admin/storage"),
            ]);

        const product = productData.data.map((item) => ({
            id: item.id,
            name: item.name,
        }));

        const color = colorData.data.map((item) => ({
            id: item.id,
            name: item.name,
        }));

        const ram = ramData.data.map((item) => ({
            id: item.id,
            ram: item.ram,
        }));

        const storage = storageData.data.map((item) => ({
            id: item.id,
            storage: item.storage,
        }));
        localStorage.setItem("product", JSON.stringify(product));
        localStorage.setItem("color", JSON.stringify(color));
        localStorage.setItem("ram", JSON.stringify(ram));
        localStorage.setItem("storage", JSON.stringify(storage));
    } catch (error) {
        console.error("Failed to fetch :", error);
    }
};

const loadDataOption = () => {
    const productData = localStorage.getItem("product");
    const colorData = localStorage.getItem("color");
    const ramData = localStorage.getItem("ram");
    const storageData = localStorage.getItem("storage");
    try {
        const product = JSON.parse(productData);
        const color = JSON.parse(colorData);
        const ram = JSON.parse(ramData);
        const storage = JSON.parse(storageData);

        products.value = product;
        colors.value = color;
        rams.value = ram;
        storages.value = storage;
    } catch (error) {
        console.error("Error parsing localStorage data:", error);
    }
};

const rules = {
    required: (value) => !!value || "Không được để trống",
};
const resetForm = () => {
    localForm.value = {};
};

watch(
    () => props.visible,
    (newVal) => {
        localDialog.value = newVal;
    },
    { immediate: true }
);

watch(
    () => props.warehouse,
    (newVal) => {
        localForm.value = { ...newVal };
    }
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

const submit = () => {
    if (valid.value) {
        emit("submit", localForm.value);
    }
};

const cancel = () => {
    localDialog.value = false;
};

onMounted(() => {
    fetchOptions();
});
</script>
