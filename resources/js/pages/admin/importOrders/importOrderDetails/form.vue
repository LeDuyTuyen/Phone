<template>
    <v-dialog v-model="visible" max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline">Thêm Chi Tiết Đơn Hàng Nhập</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field
                        v-model="formData.detailField"
                        label="Tên chi tiết"
                    />
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="submit">Lưu</v-btn>
                <v-btn text @click="close">Hủy</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps(["visible", "importOrderId"]);
const emit = defineEmits(["update:visible"]);

const detailsForm = {};

const submit = async () => {
    await axios.post(`http://localhost:8000/api/admin/importOrderDetails`, {
        ...detailsForm.value,
        importOrderId: props.importOrderId,
    });
    emit("update:visible", false);
};

const close = () => {
    emit("update:visible", false);
};
</script>
