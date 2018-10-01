<template>
    <div class="file-manager">
        <div class="file-manager-files">
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
                currentFolder: '/'
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
            }
        },
        mounted() {
            this.reloadFileManager()
        }
    }
</script>

<style scoped>

</style>