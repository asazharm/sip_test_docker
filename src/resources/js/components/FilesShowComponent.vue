<template>
    <div class="container col-md-8">
        <div v-if="!readyToShow" class="text-center mt-3">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <ul v-if="readyToShow" class="list-group">
            <li v-for="file in files" :key="file.id" class="list-group-item justify-content-between align-items-center">
                <a class="button is-primary" :href="file.path" target="_blank">
                    {{file.name}}
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
                <div>
                    <span class="badge badge-primary badge-pill">{{file.created_at}}</span>
                    <span class="badge badge-primary badge-pill">{{(file.size / (1024*1024)).toFixed(3) + 'MB'}}</span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                files: {},
                readyToShow: false
            };
        },
        methods: {

            fetchFile() {
                this.readyToShow = false;
                axios.get('files/')
                .then(result => {
                    this.files = result.data.data.data.map(file=>{
                        let date = new Date(file.created_at);
                        file.created_at = date.toLocaleString();
                        return file
                    });
                    this.readyToShow = true;
                }).catch(error => {
                    console.log(error);
                });

            }

        },

        mounted() {
            this.fetchFile();
            this.$root.$refs.FilesShowComponent = this;
        },

    }

</script>
