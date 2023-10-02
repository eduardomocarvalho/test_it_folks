import { BaseService } from '../requester'

export class TicketsService {
    constructor() {
      this.baseService = new BaseService()
      this.request = this.baseService.createRequest()
  
      this.endpoints = {
        tickets_list: 'get-tickets',
        categories_list: 'get-categories',
        send_ticket: 'send-ticket',
        cancel_ticket: 'cancel-ticket',
        close_ticket: 'close-ticket',
        accept_ticket: 'accept-ticket',
      }
    }

    requestGetTickets = async () => {
        let responseTickets = null
        try {
          const response = await this.request.get(`${this.endpoints.tickets_list}`)
          if (response && response?.status === 200) {
            responseTickets = response.data
          }
        } catch (error) {}
        return responseTickets
    }

    requestCancelTicket = async (id) => {
      let responseTickets = null
      try {
        const response = await this.request.put(`${this.endpoints.cancel_ticket}/${id}`)
        if (response && response?.status === 200) {
          responseTickets = response.data
        }
      } catch (error) {}
      return responseTickets
    }

    requestCloseTicket = async (body,id) => {
      let responseTickets = null
      try {
        const response = await this.request.put(`${this.endpoints.close_ticket}/${id}`,body)
        if (response && response?.status === 200) {
          responseTickets = response.data
        }
      } catch (error) {}
      return responseTickets
    }

  requestAcceptTicket = async (id) => {
    let responseTickets = null
    try {
      const response = await this.request.put(`${this.endpoints.accept_ticket}/${id}`)
      if (response && response?.status === 200) {
        responseTickets = response.data
      }
    } catch (error) {}
    return responseTickets
}

    requestGetCategories = async () => {
        let responseCategories = null
        try {
          const response = await this.request.get(`${this.endpoints.categories_list}`)
          if (response && response?.status === 200) {
            responseCategories = response.data
          }
        } catch (error) {}
        return responseCategories
    }

    requestSaveTicket = async (body) => {
        let responseSaveTicket = null
        try {
          const response = await this.request.post(`${this.endpoints.send_ticket}`, body)
          if (response && response?.status === 200) {
            responseSaveTicket = true
          }
        } catch (error) {
            return error
        }
        return responseSaveTicket
      }

      requestEditTicket = async (body, id) => {
        let responseSaveTicket = null
        try {
          const response = await this.request.put(`${this.endpoints.send_ticket}/${id}`, body)
          if (response && response?.status === 200) {
            responseSaveTicket = true
          }
        } catch (error) {
            return error
        }
        return responseSaveTicket
      }
}