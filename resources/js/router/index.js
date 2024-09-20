import { createRouter, createWebHistory } from "vue-router";
import admin from "./admin.js";
import client from "./client.js";

const routes = [...client, ...admin];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    const token = localStorage.getItem("token");

    if (requiresAuth) {
        try {
            if (token) {
                // Kiểm tra tính hợp lệ của token bằng cách gọi API
                await axios.get("http://localhost:8000/api/admin/user", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                next(); // Cho phép truy cập route
            } else {
                // Nếu chưa có token và đang cố vào trang cần xác thực
                if (to.name !== "admin-login") {
                    next({ name: "admin-login" });
                } else {
                    next(); // Nếu đang ở trang login, cho phép vào
                }
            }
        } catch (error) {
            console.error("Authentication error:", error);
            // Nếu token không hợp lệ, chuyển hướng đến trang đăng nhập
            if (to.name !== "admin-login") {
                next({ name: "admin-login" });
            } else {
                next(); // Nếu đang ở trang login, cho phép vào
            }
        }
    } else {
        next(); // Nếu route không yêu cầu xác thực, tiếp tục
    }
});

export default router;
