<template >
  <v-app id="inspire" right>
    <v-navigation-drawer
      v-model="drawer"
      app
      right
    >
      <!--  -->
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title> accounting-system</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <!--  container for the all pages-->
       <slot></slot>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    name:'baselayout',
    data: () => ({ drawer: null }),
  }
</script>