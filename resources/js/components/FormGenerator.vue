<template>
    <div class="panel-body">
        <vue-form-generator :schema="config.schema" :model="config.model" :options="config.formOptions">

        </vue-form-generator>
        <input type="button" v-on:click="submit" v-on:change="$emit('change', $event.target.checked)" value=submit>
        <div>
            <div v-html="result.html"></div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import VueFormGenerator from 'vue-form-generator'
import 'vue-form-generator/dist/vfg.css'

var form = Vue.use(VueFormGenerator);
    export default {
        props: ['config', 'controller', 'result'],
        methods: {
            submit: function() {
                let controllerCall = eval("window."+this.controller);
                var result = controllerCall.submit(this);
                console.log(result);
            }
}

}
</script>