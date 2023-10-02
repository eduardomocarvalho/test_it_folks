import { BaseService } from '../requester'

export class LoginService {
  constructor() {
    this.baseService = new BaseService()
    this.request = this.baseService.createRequest()

    this.endpoints = {
      login: 'login',
      recover_password: 'recover-password',
      recover_password_save: 'send-change-password'
    }
  }

  requestLoin = async (body) => {
    let responseUser = null
    try {
      const response = await this.request.post(`${this.endpoints.login}`, body)
      if (response && response?.status === 201) {
        responseUser = response.data
      }
    } catch (error) {}
    return responseUser
  }

  requestResetPasswordToken = async (cpf) => {
    const body = {
      cpf: cpf
    }
    let responseSendCode = false
    try {
      const response = await this.request.post(`${this.endpoints.recover_password}`, body)
      if (response && response?.status === 200) {
        responseSendCode = true
      }
    } catch (error) { }
    return responseSendCode
  }

  requestResetPasswordSave = async (body) => {
    let responSaveNewPassword = false
    try {
      const response = await this.request.post(`${this.endpoints.recover_password_save}`, body)
      if (response && response?.status === 200) {
        responSaveNewPassword = true
      }
    } catch (error) { }
    return responSaveNewPassword
  }
}