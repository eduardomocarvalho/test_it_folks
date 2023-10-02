import { BaseService } from '../requester'

export class CommentaryService {
    constructor() {
      this.baseService = new BaseService()
      this.request = this.baseService.createRequest()
  
      this.endpoints = {
        commentaries_list: 'get-commentaries',
        commentary_save: 'save-commentary'
      }
    }

    requestGetCommentaries = async (id) => {
        let responseCommentaries = null
        try {
          const response = await this.request.get(`${this.endpoints.commentaries_list}/${id}`)
          if (response && response?.status === 200) {
            responseCommentaries = response.data
          }
        } catch (error) {}
        return responseCommentaries
    }

    requestSaveCommentary = async (body) => {
        let responseSaveCommentary = null
        try {
          const response = await this.request.post(`${this.endpoints.commentary_save}`, body)
          if (response && response?.status === 200) {
            responseSaveCommentary = true
          }
        } catch (error) {
            return error
        }
        return responseSaveCommentary
      }
}