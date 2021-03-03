<template>
    <baselayout>
        <v-container>
            <v-row>
                <v-col cols="auto">
                    <sweetAlertDialog
                        :dialog="dialog"
                        :type="type"
                        :message="message"
                        :errors="errors"
                        v-on:close-dialog="closeDialog"
                    />
                </v-col>
                <v-col cols="12">
                    <crudDataTable
                        :headers="headers"
                        :passedRows="dataTable"
                        :tableTitle="title"
                        :singleItemTitle="singleItemTitle"
                        :record="record"
                        v-on:new-record="newRecord"
                        v-on:edit-record="editRecord"
                        v-on:delete-record="deleteRecord"
                    />
                </v-col>
            </v-row>
        </v-container>
    </baselayout>
</template>

<script>
import baselayout from "../../layout/baselayout";
import crudDataTable from "../../components/crudDataTable";
import sweetAlertDialog from "../../components/sweetAlertDialog";

export default {
    name: "sections",
    props: ["headers", "dataTable"],
    components: {
        baselayout,
        crudDataTable,
        sweetAlertDialog
    },
    data: function() {
        return {
            title: "القطاعات",
            singleItemTitle: "قطاع",
            record: {
                name: ""
            },
            dialog: false,
            type: "",
            message: "",
            errors: {}
        };
    },
    methods: {
        async newRecord(defaultItem) {
            try {
                const response = await axios.post("/sections", defaultItem);
                //console.log(response.data);
                this.dataTable.push(response.data.section);
                this.record = {
                    name: ""
                };
                this.errors = {};
                this.type = "success";
                this.message = response.data.message;
                this.closeDialog(this.dialog);
            } catch (error) {
                //console.error(error);
                this.errors = error.response.data.errors;
                this.type = "error";
                this.message = "خطاء اثناء إتمام العملية";
                this.closeDialog(this.dialog);
            }
        },
        async editRecord(defaultItem) {
            try {
                const response = await axios.patch(`/sections/${defaultItem.id}`,defaultItem);
                Object.assign(this.dataTable[defaultItem.id - 1],response.data.section);
                this.record = {
                    name: ""
                };
                this.errors = {};
                this.type = "success";
                this.message = response.data.message;
                this.closeDialog(this.dialog);
            } catch (error) {
                //console.error(error);
                this.errors = error.response.data.errors;
                this.type = "error";
                this.message = "خطاء اثناء إتمام العملية";
                this.closeDialog(this.dialog);
            }
        },
        async deleteRecord(recordId){
            try {
                const response = await axios.delete(`/sections/${recordId}`);
                //console.log(response.data);
                this.dataTable.splice(recordId, 1);
                this.errors = {};
                this.type = "success";
                this.message = "لقد تم حذف القطاع";
                this.closeDialog(this.dialog);
            } catch (error) {
                //console.error(error);
                this.errors = error.response.data.errors;
                this.type = "error";
                this.message = "خطاء اثناء إتمام العملية";
                this.closeDialog(this.dialog);
            }
        },
        closeDialog(dialog) {
            this.dialog = !dialog;
        }
    }
};
</script>

<style scoped></style>
