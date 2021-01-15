<template >
  <v-app id="inspire" right>
    <v-navigation-drawer
      v-model="drawer"
      app
      right
    >
      <!--  -->
    </v-navigation-drawer>

    <v-app-bar app right dir='rtl'>
      <v-app-bar-nav-icon  @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class='app-title'><h2>أرشيف سيارات الشرطة</h2> </v-toolbar-title>
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

<style >
.app-title{
  margin-right: 10px;
  font-family: 'Cairo', sans-serif;
}

</style>