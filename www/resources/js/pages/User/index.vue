<template>
    <baselayout>
        <v-container>
            <v-row>
                <v-col cols="12">
                    <crudDataTable
                        :headers="headers"
                        :passedRows="users"
                        :tableTitle="title"
                        :singleItemTitle="singleItemTitle"
                        :record="record"
                    />
                </v-col>
            </v-row>
        </v-container>
    </baselayout>
</template>

<script>
import baselayout from "../../layout/baselayout";
import crudDataTable from "../../components/crudDataTable";

export default {
    name: "users",
    props: ["headers", "users"],
    components: {
        baselayout,
        crudDataTable
    },
    data: () => {
        return {
            title: "المستخدمين",
            singleItemTitle: "مستخدم",
            record: {
                name: "",
                username: "",
                password: ""
            }
        };
    }
};
</script>

<style scoped></style>
