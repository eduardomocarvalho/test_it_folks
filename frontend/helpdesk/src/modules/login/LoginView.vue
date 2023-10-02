<template>
  <div class="wrapper">
    <div class="bodyPage">

      <my_loading v-if="loading" :txtLoading="'Aguarde ...'" />
      <my_popup :type="'defaut_confirm'" v-if="showPopup" :popupData="popupData" />

      <div class="content">

        <div class="boxHead">
          <text class="txtHeadColumn">PHP TEST IT FOLKS</text>
        </div>

        <div class="boxInputLogin">
          <my_input :type_style="'fields_defaut'" :value="formData.email" :onChange="(val) => handleInput(val, 'email')"
            :type="'text'" :label="'email'" :placeholder="'Informe seu e-mail'"
            :inputError="errors.email ? 'o campo e-mail é obrigatório' : ''" />

          <br>

          <my_input :type_style="'fields_defaut'" :value="formData.password"
            :onChange="(val) => handleInput(val, 'password')" :type="'password'" :label="'Senha'"
            :inputError="errors.password ? 'o campo senha é obrigatório' : ''" />
          <br>

          <input type="checkbox" id="login_remember" name="login_remember" :value="rememberPass"
            :onchange="(val) => handleInput(val, 'rememberPass')" />
          <text class="txtRemember">Lembrar</text>
          <br><br>
          <div style="display: flex; flex-direction: row;">
            <captcha_component style="display: flex" :value="formData.captcha" chars="12345" @getCode="getCaptchaCode"
              @isValid="checkValidCaptcha" />
          </div>
          <br>
          <my_input :type_style="'fields_defaut'" :value="captcha" :onChange="(val) => handleInput(val, 'captchaInput')"
            :type="'text'" :label="'Captcha'" :placeholder="'informe o captcha'"
            :inputError="errors.captcha ? 'o código captcha não confere' : ''" />
          <br>
          <my_button :type="'defaut_login'" :txtBtn="'Entrar'" :disabled="loading || block" :onPress="pressLogin" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueClientRecaptcha from 'vue-client-recaptcha'
import { initialStore } from '../../store/initial-store/initialStore'
import { MyButton, MyInput, MyLoading, MyPopup } from '../../components'
import { LoginService } from '../../service/login-service/loginService'

export default {
  name: 'login',
  data() {
    return {
      showPopup: false,
      popupData: {
        title: '',
        description: '',
        pathIcon: '',
        pressOk: () => { }
      },
      errors: {
        email: false,
        password: false,
        captcha: false
      },
      emailErro: true,
      loginService: new LoginService,
      loading: false,
      block: false,
      forgotPass: false,
      rememberPass: false,
      formData: {
        email: '',
        password: '',
        captcha: '',
        captchaInput: '',
      },
      title: initialStore.getters.title
    }
  },

  created() {
    this.getUserAccess()
  },

  watch: {
    rememberPass(newVal, oldVal) {
      if (newVal === false) {
        setTimeout(() => {
          this.removeUserAccess()
        }, 100)
      }
    }
  },

  methods: {
    handleInput({ type, target }, it) {
      this.errors.email = false
      this.errors.password = false
      this.errors.captcha = false

      if (it === 'rememberPass') {
        this.rememberPass = target.checked
      } else {
        this.formData[it] = target.value
      }
    },

    async pressLogin() {
      const body = {
        email: this.formData.email,
        password: this.formData.password
      }
      const validCaptcha = (this.formData.captchaInput !== '' && this.formData.captchaInput === this.formData.captcha)

      if (!validCaptcha) {
        this.errors.captcha = true
        return
      }
      if (body.email === '') {
        this.errors.email = true
        return
      }
      if (body.password === '') {
        this.errors.password = true
        return
      }

      if (this.rememberPass) {
        this.saveUserAccess(body.email, body.password)
      }

      this.loading = true
      const response = await this.loginService.requestLoin(body)
      console.log(response)
      this.loading = false
      if (response) {
        initialStore.commit('setUser', response.user)
        initialStore.commit('setAuthToken', response.token)
        this.$router.push({ path: '/home' })
      } else {
        this.popupData = {
          title: 'Erro No Acesso',
          description: 'Por favor, Verifique os dados informados ou tente novamente mais tarde!',
          pathIcon: 'icons/error-icon.png',
          pressOk: () => {
            this.showPopup = false
          }
        }
        this.showPopup = true
      }
    },

    getCaptchaCode(val) {
      this.formData.captcha = val
    },
    checkValidCaptcha(val) {
      return val
    },

    saveUserAccess(email, pass) {
      localStorage.setItem('email', email)
      localStorage.setItem('password', pass)
    },

    getUserAccess() {
      const hasemail = localStorage.getItem('email')
      const pass = localStorage.getItem('password')

      if (hasemail) {
        this.formData.email = hasemail
        this.formData.password = pass
        setTimeout(() => {
          this.rememberPass = true
          let check = document.getElementById('login_remember')
          check.checked = true
        }, 200)
      }
    },

    removeUserAccess() {
      const hasemail = localStorage.getItem('email')
      const hasPass = localStorage.getItem('password')
      if (hasemail && hasPass) {
        this.formData.email = ''
        this.formData.password = ''
        localStorage.removeItem('email')
        localStorage.removeItem('password')
      }
    }
  },

  components: {
    my_input: MyInput,
    my_button: MyButton,
    my_loading: MyLoading,
    my_popup: MyPopup,
    captcha_component: VueClientRecaptcha
  }
}
</script>

<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
.wrapper {
  height: 100vh;
  flex-direction: column;
}

.bodyPage {
  flex-direction: row;
  display: flex;
  height: 92%;
}

.boxHead {
  display: flex;
  flex-direction: row;
  width: fit-content;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 40px;
}

.leftContent {
  background-image: url("../../assets/images/back-img.png");
  background-repeat: no-repeat;
  background-color: #145434;
  padding-inline: 30px;
  padding-top: 40px;
  display: flex;
  justify-content: space-between;
  flex-direction: column;
  width: 54%;
}

.content {
  justify-content: center;
  align-items: center;
  display: flex;
  flex-direction: column;
  width: 70%;
  padding-inline: 20%;
}

.boxInputLogin {
  width: 100%;
}

.boxInputLoginPadding {
  width: 80%;
}

.bottomPage {
  padding: 6px;
  background: #0F482F;
  height: 7%;
  width: 100%;
}

.boxGotPass {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.txtOpac {
  font-family: 'sans-serif';
  color: #bfbfbf
}

.txtRecoverpass {
  font-size: 18px;
  font-family: 'sans-serif';
  color: #918e8e
}

.txtRemember {
  font-weight: bold;
  font-size: 13px;
  font-family: 'sans-serif';
  color: #7c7a7a
}

.txtTitle {
  font-family: 'sans-serif';
  color: #fff
}

.txtHead {
  font-family: 'sans-serif';
  font-size: 43px;
}

.txtHeadColumn {
  font-family: 'sans-serif';
  font-size: 14px;
  align-self: flex-end;
}

.txtRadioLogin {
  color: rgb(144, 144, 144);
  font-size: 12px;
  margin-bottom: 6px;
  text-align: left;
}
</style>
