<template>
    <div class="panel-body">
        <vue-form-generator :schema="schema" :model="model" :options="formOptions"></vue-form-generator>
    </div>
</template>

<script>
import Vue from 'vue'
import VueFormGenerator from 'vue-form-generator'
import 'vue-form-generator/dist/vfg.css'

Vue.use(VueFormGenerator)
export default {
    name: 'dasdasd',
    props: ['model', 'schema', 'formOptions'],
    data () {
        return {
            schema: schema,
            model: model,
            formOptions: formOptions
        }
    }
}
</script>