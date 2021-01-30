<template>
    <v-container >
        <div v-if="$page.props.errors" >     
            <v-row dir="rtl">
                <v-col cols='12' v-for="error in $page.props.errors" :key="error">
                    <v-alert class="text-right" dismissible type="error">{{error}}</v-alert>
                </v-col>
            </v-row>
        </div>
        <div v-if="$page.props.flash.message">    
            <v-row>
                <v-col cols='12' >
                     <v-alert class="text-right" dismissible :type="$page.props.flash.message.type">{{$page.props.flash.message.text}}</v-alert>
                </v-col>
            </v-row>
        </div>
    </v-container>
</template>

<script>
export default {
    name:'messages',
}
</script>

<style>

</style>