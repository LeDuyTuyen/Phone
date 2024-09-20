<template>
    <v-dialog v-model="localDialog" max-width="600">
        <v-card>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field
                        v-model="localForm.name"
                        :rules="[rules.required]"
                        label="Tên màu"
                        required
                    ></v-text-field>

                    <v-color-picker
                        v-model="localForm.code"
                        :rules="[rules.required]"
                        label="Mã màu"
                        required
                        mode="hex"
                    ></v-color-picker>
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
import { ref, watch } from "vue";

const props = defineProps({
    visible: Boolean,
    color: Object,
});

const emit = defineEmits(["update:visible", "submit"]);

const localDialog = ref(props.visible);
const localForm = ref({ ...props.color });
const valid = ref(false);

const rules = {
    required: (value) => !!value || "Không được để trống.",
};

watch(
    () => props.visible,
    (newVal) => {
        localDialog.value = newVal;
    },
    { immediate: true }
);

watch(
    () => props.color,
    (newVal) => {
        localForm.value = { ...newVal };
    }
);

watch(
    () => localDialog.value,
    (newVal) => {
        if (!newVal) {
            localForm.value = { color: "", code: "" };
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
</script>
