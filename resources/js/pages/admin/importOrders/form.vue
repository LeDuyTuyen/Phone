<template>
    <v-dialog v-model="localDialog" max-width="600">
        <v-card>
        
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field
                        v-model="localForm.total"
                        :rules="[rules.required]"
                        label="Tổng"
                        required
                    />
                    <v-text-field
                        v-model="localForm.user_id"
                        :rules="[rules.required]"
                        label="Người nhập"
                        required
                    />
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" text @click="cancel">Hủy</v-btn>
                <v-btn color="primary" text @click="submit">Lưu</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";

const props = defineProps({
    visible: Boolean,
    importOrder: Object,
});
const emit = defineEmits(["update:visible", "submit"]);

const localDialog = ref(props.visible);
const localForm = ref({ ...props.importOrder });
const valid = ref(false);

const rules = {
    required: (value) => !!value || "Không được để trống.",
};
const resetForm = () => {
    localForm.value = {
        total: null,
        user_id: null,
        created_at: null,
    };
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
        if (!newVal) {
            resetForm;
            emit("update:visible", false);
        }
    }
);

watch(
    () => props.importOrder,
    (newVal) => {
        localForm.value = { ...newVal };
    }
);

const submit = () => {
    if (valid.value) {
        emit("submit", localForm.value);
    }
};

const cancel = () => {
    emit("update:visible", false);
};
</script>
