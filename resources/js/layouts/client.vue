<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-3 d-none d-sm-flex">
                <a-list bordered style="width: 100%"> Đây là trang sản phẩm </a-list>
            </div>
            <div class="col-12 col-sm-9"><router-view></router-view></div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
};
</script>
