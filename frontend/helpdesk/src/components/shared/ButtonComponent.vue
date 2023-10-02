<template>
  <div v-if="type === 'defaut_login'" class="wrapperButton">
    <button id="btn_login" class="btnStyle" @click="onPress" :disabled="disabled">
      <text class="txtButton">{{ txtBtn }}</text>
    </button>
  </div>

  <button v-if="type === 'defaut_text'" class="btnText" @click="onPress" :disabled="disabled">
    <text style="padding-bottom: 6px; color:#4d94ff">{{ txtBtn }}</text>
  </button>

  <button v-if="type === 'defaut_blue'" class="dfBlue" @click="onPress" :disabled="disabled">
    <text style="padding-bottom: 6px; color:#fff">{{ txtBtn }}</text>
  </button>

  <button v-if="type === 'defaut_red'" style="
      border-radius: 10px; 
      width: 90px;
      border-style: none; 
      background-color: #e00f0f;
      padding-inline: 20px;
      padding-block: 12px;
    " @click="onPress" :disabled="disabled">
    <text style="padding-bottom: 6px; color:#fff">{{ txtBtn }}</text>
  </button>

  <button v-if="type === 'defaut_green'" style="
      width: 90px;
      border-radius: 10px; 
      border-style: none; 
      background-color: #1c9648;
      padding-inline: 20px;
      padding-block: 12px;
    " @click="onPress" :disabled="disabled">
    <text style="padding-bottom: 6px; color:#fff">{{ txtBtn }}</text>
  </button>

  <button v-if="type === 'defaut_icon'" class="btnText" @click="onPress" :disabled="disabled">
    <img style="width: 20px; height: 20px;" :src="require(`@/assets/${pathIcon}`)" />
  </button>

  <button v-if="type === 'defaut_plus'" class="btnPlus" @click="onPress" :disabled="disabled">
    <div class="boxBtnPlus">
      <text style=" color: #fff;">{{ txtBtn }}</text>
      <text style="margin-left: 3px; margin-top: -3px; font-size: 26px; color: #fff;">+</text>
    </div>
  </button>

  <div style="display: flex; width: max-content; flex-direction: row; border: 0.2px solid rgb(217, 214, 214);"
    v-if="type === 'defaut_pagination'">
    <button :class="btnPagination.disableBack ? 'btnTextDisabled' : 'btnText'" @click="btnPagination.pressBack"
      :disabled="btnPagination.disableBack">
      <div class="boxBtnPlus">
        <text style=" color: #918e8e;">{{ btnPagination.txtBack }}</text>
      </div>
    </button>
    <div style="padding: 5px; background-color: #1c9648;">
      <text style="color: #fff">{{ btnPagination.page }}</text>
    </div>
    <button :class="btnPagination.disableNext ? 'btnTextDisabled' : 'btnText'" @click="btnPagination.pressNext"
      :disabled="btnPagination.disableNext">
      <div class="boxBtnPlus">
        <text style=" color: #918e8e;">{{ btnPagination.txtNext }}</text>
      </div>
    </button>
  </div>

  <button id="btn_border" v-if="type === 'defaut_border'" class="btn" @click="onPress" :disabled="disabled">
    <div v-if="colorStyle === 'red'" class="boxBtnBorderRed">
      <text style="padding: 8px; color: #e00f0f;">{{ txtBtn }}</text>
    </div>
    <div v-if="colorStyle === 'green'" class="boxBtnBorderGreen">
      <text style="padding: 8px; color: #145434;">{{ txtBtn }}</text>
    </div>
    <div v-if="colorStyle === 'gray'" class="boxBtnBorder">
      <text style="padding: 8px; color: #918e8e;">{{ txtBtn }}</text>
    </div>
  </button>
</template>

<script>
export default {
  data() {
  },

  props: ['onPress', 'disabled', 'txtBtn', 'type', 'pathIcon', 'hireText', 'btnPagination', 'colorStyle'],

  watch: {
    disabled: {
      handler(val, oldVal) {
        if (val) {
          document.getElementById('btn_login').style["opacity"] = '0.5'
        } else {
          document.getElementById('btn_login').style["opacity"] = '1'
        }
      }
    }
  },

  mounted() {
  },

  methods: {
  }
}

</script>

<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
.wrapperButton {
  display: flex;
  flex-direction: row;
  width: 100%;
}

.boxBtnMenu {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.btnStyle {
  cursor: pointer;
  background: #1c9648;
  justify-content: center;
  align-items: center;
  border-style: none;
  border-radius: 4px;
  height: 40px;
  width: 100%;
}
.btnStyle:hover {
  height: 41px;
  background-color: #3eab42
}
.btnStyle:active {
  box-shadow: 0 1px 4px rgb(0 0 0 / 0.2);
  transform: translateY(4px);
}

.txtButton {
  color: #fff
}

.txtButtonMenu {
  color: #918e8e;
  padding-left: 14px;
}

.btnText {
  cursor: pointer;
  border-style: none;
  background-color: transparent;
}
.btnText:active {
  box-shadow: 0 5px rgb(200, 198, 198);
  transform: translateY(4px);
}

.dfBlue {
  cursor: pointer;
  border-radius: 10px; 
  border-style: none; 
  background-color: #4d94ff;
  padding-inline: 20px;
  padding-block: 12px;
}
.dfBlue:hover {background-color: #88b2f1}
.dfBlue:active {
  box-shadow: 0 5px rgb(200, 198, 198);
  transform: translateY(4px);
}

.boxBtnBorder {
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 0.2px solid gray;
  border-radius: 6px;
  height: 30px;
}
.boxBtnBorder:hover {background-color: #cfcfcf}
.boxBtnBorder:active {
  box-shadow: 0 5px rgb(200, 198, 198);
  transform: translateY(4px);
}

.boxBtnBorderRed {
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 0.2px solid #e00f0f;
  border-radius: 6px;
  height: 30px;
}
.boxBtnBorderRed:hover {
  background-color: #fcebeb;
  border: 1px solid #e00f0f;
}
.boxBtnBorderRed:active {
  box-shadow: 0 1px 4px rgb(0 0 0 / 0.2);
}

.boxBtnBorderGreen {
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 0.2px solid #145434;
  border-radius: 6px;
  height: 30px;
}
.boxBtnBorderGreen:hover {
  border: 1px solid #145434;
  background-color: #effdf6
}
.boxBtnBorderGreen:active {
  box-shadow: 0 5px rgb(200, 198, 198);
  transform: translateY(4px);
}

.btnTextDisabled {
  cursor: pointer;
  border-style: none;
  background-color: transparent;
  opacity: 0.5;
}
.btnTextDisabled:hover {background-color: #eaf6f0}
.btnTextDisabled:active {
  box-shadow: 0 5px #c8c6c6;
  transform: translateY(4px);
}

.btnPlus {
  cursor: pointer;
  align-content: center;
  padding-inline: 12px;
  border-radius: 22px;
  border-style: none;
  background-color: #2222d6;
}
.btnPlus:hover {
  width: 75px;
  background-color: #4747fb
}
.btnPlus:active {
  box-shadow: 0 5px #c8c6c6;
  transform: translateY(4px);
}

.boxBtnPlus {
  align-items: center;
  justify-content: center;
  display: flex;
}

</style>
