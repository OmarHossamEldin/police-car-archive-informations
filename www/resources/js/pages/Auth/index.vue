<template>
    <baselayout>
        <v-container>
            <v-layout align-center justify-center>
              <v-flex class='login-form text-xs-center'>
                  <div class="text-center"><h3>تسجيل الدخول</h3></div>
                  <v-card >
                    <v-card-text class="pt-4">
                      <v-form >
                        <v-text-field
                          label="ادخل اسم المستخدم"
                          v-model='userName'
                          :rules="[rules.required]"
                          counter
                        ></v-text-field>
                        <v-text-field
                          v-model='password'
                          :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                          :type="show ? 'text' : 'password'"
                          @click:append="show = !show"
                          label="ادخل كلمه المرور"
                          counter
                          :rules="[rules.required, rules.counter]"
                        ></v-text-field>
                        <v-layout justify-space-between >
                            <a href="">لقد نسيت كلمة المرور</a>
                            <v-btn  >دخول</v-btn>
                        </v-layout>
                      </v-form>
                </v-card-text>
                  </v-card>
              </v-flex>
            </v-layout>
        </v-container>
    </baselayout>
</template>

<script>
import baselayout from "../../layout/baselayout";
export default {
    components: { baselayout },
    data:()=>{
      return {
        show: false,
        userName:'',
        password:'',
        rules: {
          required: value => !!value || '.مطلوب',
          counter: value => value.length >=6 || '.ادخل ما لا يقل عن 6 احرف او ارقام',
        },
      }
    }
};
</script>

<style scoped>
.login-form{
  margin-top: 20%;
  max-width: 500px;
  font-family: 'Cairo', sans-serif;
}
</style>
