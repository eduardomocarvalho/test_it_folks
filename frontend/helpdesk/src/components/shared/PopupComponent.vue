<template>
  <div class="wrapperPopup">
    <div class="bodyPopup">
      <div class="boxContentPopup" v-if="type === 'defaut_confirm'">
        <div class="boxTxtPopup">
          <text style="margin-bottom: 20px; font-size: 26px; color: #333333; text-align: center;">{{
              popupData.title
          }}</text>
          <text style="font-size: 18px; color: #808080; text-align: center;">
            {{ popupData.description }}</text>
        </div>
        <my_button :type="'defaut_blue'" :txtBtn="'OK'" :onPress="popupData.pressOk" />
      </div>

      <div class="boxContentPopup" v-if="type === 'defaut_yes_no'">
        <div class="boxTxtPopup">
          <text v-if="popupData.showTitleOne"
            style="margin-bottom: 20px; font-size: 26px; color: #000000; text-align: center;">{{
                popupData.titleOne
            }}</text>
          <text style="margin-bottom: 20px; font-size: 24px; color: #333333; text-align: center;">{{
              popupData.title
          }}</text>
          <text style="white-space: pre-line; font-size: 18px; color: #808080; text-align: center;">{{
              popupData.description
          }}</text>
          <div v-if="popupData.feedback"
            style="padding: 10px; display: flex; width: max-content; border-radius: 12px; height: 120px; outline: none; border: 1px solid #333333">
            <textarea id="txtAreaFeedback" autofocus cols="40" rows="5" style=" outline: none; border-style: none;"
              type="text" placeholder="Motivo do Retorno:" @input="popupData.handleInput"></textarea>
          </div>
        </div>
        <div style=" width: 100%; display: flex; flex-direction: row;  justify-content: center">
          <my_button :type="'defaut_green'" :txtBtn="popupData.txtConfirm" :onPress="popupData.pressOk" />
          <div style="width: 16px;"></div>
          <my_button :type="'defaut_red'" :txtBtn="popupData.txtCancel" :onPress="popupData.pressNo" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MyButton from './ButtonComponent.vue'

export default {
  props: ['type', 'popupData'],
  components: {
    my_button: MyButton
  },

  mounted() {
    this.setFocus()
  },

  methods: {
    setFocus() {
      let a = document.getElementById('txtAreaFeedback')
      if (a) {
        a.focus()
      }
    }
  }
}
</script>

<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
.wrapperPopup {
  flex-direction: column;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(100, 100, 100, 0.5);
  position: absolute;
  top: 0px;
  left: 0px;
  right: 0px;
  bottom: 0px;
}

.bodyPopup {
  flex-direction: column;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f3f3f3;
  border-radius: 16px;
  width: 25%;
  height: 44%;
  padding-inline: 40px;
}

.boxContentPopup {
  height: 100%;
  flex-direction: column;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.boxTxtPopup {
  flex-direction: column;
  display: flex;
  align-items: center;
}
</style>
