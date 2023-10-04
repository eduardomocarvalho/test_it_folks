<template>
  <div :class="row ? 'wrapperInputRow' : 'wrapperInput'">
    <div :class="row ? 'boxInputLabelRow' : 'boxInputLabel'">
      <label>{{ label }}</label>
      <my_button v-if="labelRight !== undefined" :type="'defaut_text'" :onPress="clickForgot" :txtBtn="labelRight" />
    </div>

    <!-- <div style="margin-left: 40px">

    </div> -->
    <div style="width: 100%;">
      <select  id="profile_options" name="profile_options" v-if="type_style === 'select_profiles'"
        @change="onChangeSelect" class="inputStyle">
        <option value="profile*0"></option>
        <option value="profile*1">Administrador</option>
        <option value="profile*2">Gestor</option>
        <option value="profile*3">Analista</option>
        <option value="profile*4">Estagiário</option>
      </select>

      <select id="fields_options" name="fields_options" v-if="type_style === 'fields_options'" @change="onChangeSelect"
        class="inputStyle">
        <option value="default"></option>
        <option value="field*1">Date</option>
        <option value="field*2">Varchar</option>
        <option value="field*3">Integer</option>
        <option value="field*4">Lista</option>
      </select>

      <textarea v-if="type_style === 'text-area'" class="inputStyle form-control" @input="onChange" @change="onChange"
        :value="value" :placeholder="placeholder" :type="type" :v-mask="mask" :maxlength="lenght" :max="lenght" :min="1"
        :disabled="disabled" />

      <input v-if="type_style === 'fields_defaut'" class="inputStyle form-control" @input="onChange" @change="onChange"
        :value="value" :placeholder="placeholder" :type="type" :v-mask="mask" :maxlength="lenght" :max="lenght" :min="1"
        :disabled="disabled" />
      <text style="color: #ff1a1a; font-size: 14px;" v-if="inputError !== ''">{{ inputError }}</text>
    </div>
  </div>
</template>

<script>
import MyButton from './ButtonComponent.vue'
export default {
  props: ['type_style', 'onChangeSelect', 'label', 'type', 'placeholder', 'onChange', 'value', 'lenght', 'mask', 'labelRight', 'clickForgot', 'inputError', 'disabled', 'row'],

  methods: {
  },

  data() {
    return {
    }
  },

  components: {
    my_button: MyButton
  }
}
</script>

<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
.wrapperInputRow {
  align-items: center;
  display: flex;
  flex-direction: row;
  width: 100%;
}

.wrapperInput {
  display: flex;
  flex-direction: column;
  width: 100%;
}

.txtLabel {
  font-weight: bold;
  color: rgb(95, 92, 92);
  font-size: 12px;
  margin-bottom: 6px;
  text-align: left;
}

.inputStyle {
  cursor: pointer;
  width: 98%;
  height: 30px;
  border-color: rgb(217, 214, 214);
  border-radius: 2px;
  border-width: 0.2px;
  border-style: solid;
}

.boxInputLabelRow {
  width: 150px;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

.boxInputLabel {
  display: flex;
  justify-content: space-between;
  flex-direction: row;
}

::placeholder {
  color: rgb(169, 168, 168);
  padding-left: 20px;
}
</style>
