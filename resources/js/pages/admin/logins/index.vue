<template>
    <div>
        <v-img
            class="mx-auto my-6"
            max-width="228"
            src="https://cdn.vuetifyjs.com/docs/images/logos/vuetify-logo-v3-slim-text-light.svg"
        ></v-img>

        <v-card
            class="mx-auto pa-12 pb-8"
            elevation="8"
            max-width="448"
            rounded="lg"
        >
            <v-form v-model="valid" lazy-validation>
                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field
                    v-model="email"
                    density="compact"
                    placeholder="Email address"
                    prepend-inner-icon="mdi-email-outline"
                    variant="outlined"
                    :rules="[rules.required, rules.email]"
                ></v-text-field>

                <div
                    class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
                >
                    Password
                </div>

                <v-text-field
                    v-model="password"
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"
                    density="compact"
                    placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline"
                    variant="outlined"
                    @click:append-inner="visible = !visible"
                    :rules="[rules.required]"
                ></v-text-field>
                <a
                    class="text-caption text-decoration-none text-blue"
                    href="change-password"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    Forgot login password?
                </a>
                <v-btn
                    class="mb-8"
                    color="blue"
                    size="large"
                    variant="tonal"
                    block
                    @click="submitLogin"
                    :disabled="!valid"
                >
                    Log In
                </v-btn>
            </v-form>

            <v-card-text class="text-center">
                <a
                    class="text-blue text-decoration-none"
                    href="#"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
                </a>
            </v-card-text>
        </v-card>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const visible = ref(false);
const email = ref("");
const password = ref("");
const valid = ref(false);
const errorMessage = ref("");

// Quy tắc kiểm tra form
const rules = {
    required: (value) => !!value || "Vui lòng nhập thông tin.",
    email: (value) => {
        const pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        return pattern.test(value) || "Email không hợp lệ";
    },
};

// Kiểm tra token khi vào trang
onMounted(() => {
    const token = localStorage.getItem("token");
    if (token) {
        // Nếu đã có token, chuyển hướng đến trang admin
        window.location.href = "/admin";
    }
});

// Hàm xử lý đăng nhập
const submitLogin = async () => {
    if (valid.value) {
        try {
            const response = await axios.post(
                "http://localhost:8000/api/admin/login",
                {
                    email: email.value,
                    password: password.value,
                }
            );
            console.log("Phản hồi từ API:", response.data);
            // Nếu đăng nhập thành công, lưu token vào localStorage
            if (response.data.access_token) {
                localStorage.setItem("token", response.data.access_token);
                // Chuyển hướng đến trang admin
                window.location.href = "/admin";
            }
        } catch (error) {
            errorMessage.value =
                "Email hoặc mật khẩu không đúng. Vui lòng thử lại!";
        }
    }
};
</script>

<style scoped>
.fill-height {
    min-height: 100vh;
}
</style>
