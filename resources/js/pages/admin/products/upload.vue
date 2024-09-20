<!-- <template>
    <div>
        <input
            type="file"
            @change="onFileChange"
            ref="fileInput"
            style="display: none"
        />
        <button @click="$refs.fileInput.click()">Thêm ảnh</button>
        <img v-if="preview" :src="preview" alt="Preview" />
        <button @click="uploadImage">Upload</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            selectedImage: null,
            preview: null,
        };
    },
    methods: {
        onFileChange(event) {
            this.selectedImage = event.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.preview = e.target.result;
            };
            reader.readAsDataURL(this.selectedImage);
        },
        async uploadImage() {
            const formData = new FormData();
            formData.append("image", this.selectedImage);

            try {
                const response = await axios.post("/api/upload", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                console.log(response.data); // public_id
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script> -->
