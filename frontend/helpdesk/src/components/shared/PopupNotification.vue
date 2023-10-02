<template>
  <div class="wrapperNotification">
    <div v-if="type === 'defaut_notification'" class="bodyNotification">
      <div class="boxCloseNotification">
        <img style="margin-right: 20px; width: 40px; height: 40px;"
          :src="require(`@/assets/${popupNotification.pathIcon}`)" />
        <text style="font-weight: bold; white-space: pre-line; font-size: 18px; color: #808080; text-align: center;">
          {{ popupNotification.message }}
        </text>
      </div>
      <button @click="popupNotification.click"
        style=" width: 20px; height: 20px; border-style: none; background-color: transparent;">
        <div style="background-color: #ffffff; border-radius: 10px; width: 20px; height: 20px;;">
          <text style="font-weight: bold; font-size: 18px;">x</text>
        </div>
      </button>
    </div>
  </div>
</template>

<script>
import MyButton from './ButtonComponent.vue'

export default {
  props: ['type', 'popupNotification'],
  components: {
    my_button: MyButton
  }
}
</script>

<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
.wrapperNotification {
  flex-direction: column;
  display: flex;
  align-items: center;
  justify-content: top;
  background-color: transparent;
  position: absolute;
  top: 20px;
  left: 0px;
  right: 0px;
  bottom: 0px;
}

.bodyNotification {
  flex-direction: row;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f5f3ca;
  border-radius: 22px;
  width: 25%;
  height: 70px;
  padding-inline: 18px;
}

.boxCloseNotification {
  width: 100%;
  flex-direction: row;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
