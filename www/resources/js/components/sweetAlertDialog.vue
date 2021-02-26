<template>
    <v-dialog
        transition="dialog-top-transition"
        max-width="600"
        v-model="dialogStatus"
    >
        <template>
            <v-card>
                <v-toolbar dir="rtl" :color="type" dark>
                    <h3>
                        {{ message }}
                        <v-icon>mdi-account-group-outline</v-icon>
                    </h3>
                </v-toolbar>
                <v-card-text>
                    <div
                        class="text-h5 pa-2 text-right"
                        v-for="(errorfield, index) in errors"
                        :key="index"
                    >
                        <h6 v-for="(error, index) in errorfield" :key="index">
                            {{ error }}
                        </h6>
                    </div>
                </v-card-text>
                <v-card-actions class="justify-end">
                    <v-btn text @click="$emit('close-dialog', dialog)"
                        >اغلاق</v-btn
                    >
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
export default {
    name: "sweetAlertDialog",
    props: ["dialog", "type", "message", "errors"],
    data: () => {
        return {
            dialogStatus: ""
        };
    },
    watch: {
        dialog() {
            this.dialogStatus = this.dialog;
        }
    }
};
</script>

<style scoped></style>
