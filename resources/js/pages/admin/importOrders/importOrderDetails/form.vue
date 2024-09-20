<template>
    <v-dialog v-model:visible="visible" max-width="500px">
        <v-card>
            <v-card-title>
                <span>{{ detail.id ? "Cập Nhật" : "Thêm" }} Chi Tiết</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field
                        v-model="localDetail.name"
                        label="Tên"
                        required
                    ></v-text-field>
                    <v-textarea
                        v-model="localDetail.description"
                        label="Mô tả"
                        required
                    ></v-textarea>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="close">Hủy</v-btn>
                <v-btn color="primary" @click="submit">Lưu</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
    visible: Boolean,
    detail: Object,
});

const emit = defineEmits(["update:visible", "submit"]);

const localDetail = ref({ ...props.detail });

watch(
    () => props.detail,
    (newValue) => {
        localDetail.value = { ...newValue };
    }
);

const close = () => {
    emit("update:visible", false);
};

const submit = () => {
    emit("submit", localDetail.value);
};
</script>
