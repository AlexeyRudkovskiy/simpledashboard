<template>
    <div class="file-manager" @dragover.prevent @drop="drop">
        <div class="file-manager-files">
            <div class="uploading" v-if="uploading.isActive">
                <div class="uploading-label">Завантаження файлів: {{ uploading.count }}</div>
                <div class="uploading-progress">
                    <div class="progress">
                        <div class="progress-bar" v-bind:style="{width: uploading.progress + '%'}"></div>
                    </div>
                </div>
            </div>
            <div class="file-container" v-for="folder in folders" :value="folder" @click="goToFolder(folder)">
                <div class="file-name">{{ folder.name }}</div>
            </div>
            <File
                v-for="(file, index) in files"
                :value="file"
                :key="index"
                :file="file"
                @deleted="removeFile(index)"
            ></File>
        </div>
        <div class="file-manager-file-info" v-if="isShowingDetails">{{ selectedFile }}</div>
    </div>
</template>

<script>
    import File from "./File";
    export default {
        name: "FileManager",
        components: {File},
        data() {
            return {
                files: [ ],
                folders: [ ],
                isShowingDetails: false,
                selectedFile: null,
                currentFolder: '/',
                uploading: {
                    isActive: false,
                    count: -1,
                    progress: 0
                }
            };
        },
        methods: {
            showDetails(file) {
                this.selectedFile = file;
                this.isShowingDetails = true;
            },
            async reloadFileManager() {
                const data = await axios('/admin/files/directory?folder=' + this.currentFolder)
                    .then(response => response.data);
                this.files = data.files;
                this.folders = data.folders;
            },
            goToFolder(folder) {
                this.currentFolder = folder.path;
                this.reloadFileManager();
            },
            removeFile(index) {
                this.files.splice(index, 1);
            },
            drop(e) {
                e.preventDefault();
                const files = [...e.dataTransfer.files];
                if (files.length < 1) {
                    return;
                }
                this.uploading.isActive = true;
                this.uploading.count = files.length;

                this.uploadFile(files);
            },
            uploadFile(files) {
                let file = null;
                if (files.length >= 1) {
                    file = files[0];
                    files.splice(0, 1);
                } else {
                    this.uploading.isActive = false;
                    return;
                }

                let xhr = new XMLHttpRequest();
                let formData = new FormData();
                let csrf = (document.querySelector('meta[name="csrf_token"]')).content;

                formData.append('file', file);
                formData.append('folder', this.currentFolder);

                xhr.open('POST', '/admin/files/upload', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', csrf);

                xhr.addEventListener('progress', (e) => {
                    const loaded = e.total / e.loaded * 100;
                    this.uploading.progress = loaded;
                });

                xhr.addEventListener('readystatechange', () => {
                    if (xhr.status === 200 && xhr.readyState === 4) {
                        const response = JSON.parse(xhr.responseText);
                        this.files = response.files;
                        this.folders = response.folders;
                        this.uploading.count--;
                        this.uploadFile(files);
                    }
                });

                xhr.send(formData);
            }
        },
        mounted() {
            this.reloadFileManager()
        }
    }
</script>

<style scoped>

</style>