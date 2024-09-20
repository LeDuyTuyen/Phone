    <template>
        <a-card title="Tài Khoản" style="width: 100%">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a-button type="primary">
                        <router-link :to="{ name: 'admin-user-create' }">
                            Thêm
                        </router-link>
                    </a-button>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <a-table :dataSource="dataSource" :columns="columns">
                        <template #bodyCell="{ column, index }">
                            <template v-if="column.key === 'index'">
                                <span>{{ index + 1 }}</span>
                            </template>
                        </template>
                    </a-table>
                </div>
            </div>
        </a-card>
        <router-view></router-view>
    </template>
    <script>
    export default {
        setup() {
            return {
                dataSource: [
                    {
                        key: "1",
                        user_name: "Mike",
                        password: 32,
                        email: "10 Downing Street",
                    },
                    {
                        key: "2",
                        user_name: "John",
                        password: 42,
                        email: "10 Downing Street",
                    },
                ],

                columns: [
                    {
                        title: "#",
                        key: "index",
                    },
                    {
                        title: "Name",
                        dataIndex: "user_name",
                        key: "user_name",
                    },
                    {
                        title: "Password",
                        dataIndex: "password",
                        key: "password",
                    },
                    {
                        title: "Email",
                        dataIndex: "email",
                        key: "email",
                    },
                ],
            };
        },
    };
    </script>
