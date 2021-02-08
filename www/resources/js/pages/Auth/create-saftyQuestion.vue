<template>
    <baselayout>
        <v-container>
            <v-layout align-center justify-center>
              <v-flex class='question-form text-xs-center'>
                  <div class="text-center"><h3>سؤال الامان</h3></div>
                  <v-card >
                    <v-card-text class="pt-4">
                      <v-form @submit.prevent="submit">
                          <h3 class="text-right">{{saftyQuestion}}</h3>
                        <v-divider></v-divider>
                        <v-text-field
                          v-model='form.answer'
                          :outlined="true"
                          :rounded="true"
                          :dense="true"
                          :reverse="true"
                          type='text'
                          placeholder="ادخل اجابة السؤال"
                          counter
                          :rules="[rules.required]"
                        ></v-text-field>
                        <v-layout justify-center >
                            <v-btn type="submit" >تسجيل الاجابة</v-btn>
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
    name:'create-saftyQuestion',
    components: { baselayout },
    props: ["saftyInfo"],
    data:()=>{
      return {
        form:{
          key: null,
          answer:'',
        },
        rules: {
          required: value => !!value || '.مطلوب',
        },
      }
    },
    methods: {
      submit() {
          this.$inertia.post('/safetyQuestion', this.form)
      },

    },
    computed:{
      saftyQuestion: {
        get(){
          this.form.key = this.saftyInfo.key;
          return this.saftyInfo.questions[this.saftyInfo.key];
        }
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
