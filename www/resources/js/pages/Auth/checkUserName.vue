<template>
    <baselayout>
        <v-container>
            <v-layout align-center justify-center>
              <v-flex class='question-form text-xs-center'>
                  <div class="text-center"><h3>تاكيد اسم المستخدم</h3></div>
                  <v-card >
                    <v-card-text class="pt-4">
                      <v-form @submit.prevent="submit">
                        <v-text-field
                          v-model='form.username'
                          :outlined="true"
                          :rounded="true"
                          :dense="true"
                          :reverse="true"
                          type='text'
                          placeholder="ادخل اسم المستخدم"
                          counter
                          :rules="[rules.required]"
                        ></v-text-field>
                        <v-layout justify-center >
                            <v-btn type="submit" >تاكيد</v-btn>
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
    name:'checkUserName',
    components: { baselayout },
    data:()=>{
      return {
        form:{
          username:'',
        },
        rules: {
          required: value => !!value || '.مطلوب',
        },
      }
    },
    methods: {
      submit() {
          this.$inertia.post('/confirmation-answer', this.form)
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
