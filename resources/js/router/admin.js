const admin = [
    {
        path: "/admin",
        component: () => import("../layouts/admin.vue"),
        meta: { requiresAuth: true },
        children: [
            //Quản lý users
            {
                path: "user",
                name: "admin-user",
                component: () => import("../pages/admin/users/index.vue"),
            },
            //Quản lý sản phẩm
            {
                path: "product",
                name: "admin-product",
                component: () => import("../pages/admin/products/index.vue"),
            },
            //Danh mục sản phẩm
            {
                path: "category",
                name: "admin-category",
                component: () => import("../pages/admin/categories/index.vue"),
            },
            {
                path: "color",
                name: "admin-color",
                component: () => import("../pages/admin/colors/index.vue"),
            },
            {
                path: "ram",
                name: "admin-ram",
                component: () => import("../pages/admin/rams/index.vue"),
            },
            {
                path: "storage",
                name: "admin-storage",
                component: () => import("../pages/admin/storages/index.vue"),
            },
            {
                path: "warehouse",
                name: "admin-warehouse",
                component: () => import("../pages/admin/warehouses/index.vue"),
            },
            {
                path: "importOrder",
                name: "admin-importOrder",
                component: () =>
                    import("../pages/admin/importOrders/index.vue"),
            },
            {
                path: "login",
                name: "admin-login",
                component: () => import("../pages/admin/logins/index.vue"),
                meta: { hideHeader: true, hideMenu: true },
            },
        ],
    },
];

export default admin;
