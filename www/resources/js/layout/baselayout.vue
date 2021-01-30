<template >
  <v-app id="inspire" right>
    <!-- navbar -->
     <v-app-bar app dir='rtl'>
      <v-app-bar-nav-icon v-if="$page.props.auth"  @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class='app-title'><h2>أرشيف سيارات الشرطة</h2> </v-toolbar-title>
    </v-app-bar>
    <!-- navbar -->
    <!-- sidenavbar -->
    <v-navigation-drawer v-if="$page.props.auth" v-model="drawer" app right>
       <v-list dense nav dir='rtl'>
         <!-- links -->
         <div v-for="item in items" :key="item.url">
           <inertia-link v-if="item.saftyQuestion === $page.props.auth.SaftyQuestion"  :href="item.url" as="button" type="button" class="sidenavbar-links">
            <v-list-item  link>
                <v-list-item-icon>
                  <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
                </v-list-item>
            </inertia-link>
         </div>
          <!-- links -->
          <v-divider></v-divider>
           <p>.Copyright &copy; {{getCurrentYear() - 1}} - {{getCurrentYear()}} Fatora	</p>All Rights Reserved
      </v-list>
    </v-navigation-drawer>
    <!-- sidenavbar -->
    <v-main>
      <!-- messages for the all app (success or error) -->
      <messages/>
      <slot> <!--  container for the all pages--></slot>
    </v-main>
  </v-app>
</template>

<script>
  import messages from '../components/messges';
  export default {
    name:'baselayout',
    components :{messages},
    data () {
      return {
        drawer: null,
        items: [
          { title: 'لوحه التحكم', icon: 'mdi-view-dashboard', url:'/dashboard', saftyQuestion:true },
          { title: 'الفئات', icon: 'mdi-google-classroom', url:'/person-classes', saftyQuestion:true },
          { title: 'الرتب', icon: 'mdi-chevron-triple-up ', url:'/ranks', saftyQuestion:true },
          { title: 'الادارات', icon: 'mdi-archive', url:'/management', saftyQuestion:true },
          { title: 'موديلات السيارات', icon: 'mdi-globe-model ', url:'/car-models', saftyQuestion:true },
          { title: 'انواع السيارات', icon: 'mdi-format-list-bulleted-type', url:'/car-types', saftyQuestion:true },
          { title: 'الالوان', icon: 'mdi-palette', url:'/colors', saftyQuestion:true },
          { title: 'المستخدمين', icon: 'mdi-account-group-outline', url:'/users', saftyQuestion:true },
          { title: 'تسجيل الخروج', icon: 'mdi-logout', url:'/logout', saftyQuestion:null },
        ],
        
      }
    },
    methods:{
      getCurrentYear:()=>{ let d = new Date(); return d.getFullYear(); }
    }
  }
</script>

<style >
.app-title{
  margin-right: 10px;
  font-family: 'Cairo', sans-serif;
}
.sidenavbar-links{
  width:100%
}
.text-right{
  text-align: right;
}
</style>