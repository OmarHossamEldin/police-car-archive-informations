<template>
    <baselayout>
        <v-container>
            <v-layout align-center justify-center>
              <v-flex class='question-form text-xs-center'>
                  <div class="text-center"><h3>إعادة كلمة المرور</h3></div>
                  <v-card >
                    <v-card-text class="pt-4">
                      <v-form @submit.prevent="submit">
                        <v-text-field
                          v-model='form.password'
                          :outlined="true"
                          :rounded="true"
                          :dense="true"
                          :reverse="true"
                          type='text'
                          placeholder="ادخل كلمة المرور"
                          counter
                          :rules="[rules.required]"
                        ></v-text-field>
                        <v-text-field
                          v-model='form.password_confirmation'
                          :outlined="true"
                          :rounded="true"
                          :dense="true"
                          :reverse="true"
                          type='text'
                          placeholder="تاكيد كلمة المرور"
                          counter
                          :rules="[rules.required]"
                        ></v-text-field>
                        <v-layout justify-center >
                            <v-btn type="submit" >استعادة كلمة المرور</v-btn>
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
    name:'resetPassword',
    components: { baselayout },
    props: ["user"],
    data:()=>{
      return {
        form:{
          password:'',
          password_confirmation:'',
        },
        rules: {
            required: value => !!value || '.مطلوب', 
        },
      }
    },
    methods: {
        submit(){
          this.$inertia.post(`/reset-password/${this.user}`, this.form)
        },

    }
};
</script>

<style scoped>
.question-form{
  margin-top: 20%;
  max-width: 500px;
  font-family: 'Cairo', sans-serif;
}

</style>
