<template>
    <v-container>
        <v-row>
          <v-col cols='12'>
              <v-alert dismissible type="success">{{$page.props.errors}}</v-alert>
          </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name:'messages',
}
</script>

<style>

</style>