<template>
    <v-data-table
        :headers="headers"
        :items="rows"
        :items-per-page="10"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar>
                <!-- table CRUD -->
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                            @click="initializeNewRecord()"
                        >
                            اضافة {{ singleItemTitle }}
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="4"
                                        v-for="(field, index) in defaultItem"
                                        :key="index"
                                    >
                                        <v-text-field
                                            v-model="defaultItem[index]"
                                            :readonly="index == 'id'"
                                            :label="index"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                                إالغاء
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="save(defaultItem)"
                            >
                                حفظ
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="headline"
                            >هل تريد حذف هذا التسجيل؟</v-card-title
                        >
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="closeDelete"
                                >إالغاء</v-btn
                            >
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="deleteItemConfirm"
                                >تاكيد</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-spacer></v-spacer>
                <!-- table title  -->
                <v-toolbar-title>
                    {{ tableTitle }}
                </v-toolbar-title>
            </v-toolbar>
        </template>
        <!-- table actions for edit-delete -->
        <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">
                Reset
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
export default {
    name: "crudDataTable",
    props: ["tableTitle", "singleItemTitle", "record", "headers", "passedRows"],
    data: () => {
        return {
            dialog: false,
            dialogDelete: false,
            rows: [],
            editedIndex: -1,
            defaultItem: {}
        };
    },
    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? `اضافة ${this.singleItemTitle}`
                : `تعديل ${this.singleItemTitle}`;
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        }
    },

    created() {
        this.initialize();
        this.initializeNewRecord();
    },

    methods: {
        initialize() {
            this.rows = this.passedRows;
        },
        initializeNewRecord() {
            this.defaultItem = this.record;
        },
        editItem(item) {
            this.editedIndex = this.rows.indexOf(item);
            this.defaultItem = Object.assign({}, item);
            this.dialog = true;
        },
        close() {
            this.dialog = false;
        },
        save(defaultItem) {
            if (defaultItem.id) {
                this.$emit("edit-record", defaultItem);
            } else {
                this.$emit("new-record", defaultItem);
            }
            this.close();
        },
        deleteItem(item) {
            this.editedIndex = this.rows.indexOf(item);
            this.dialogDelete = true;
        },
        deleteItemConfirm() {
            this.$emit("delete-record", this.editedIndex);
            this.closeDelete();
        },
        closeDelete() {
            this.dialogDelete = false;
        },       
    }
};
</script>

<style scoped></style>
