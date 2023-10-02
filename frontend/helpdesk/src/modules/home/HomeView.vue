
<template>
  <my_loading v-if="loading" :txtLoading="'Wait ...'" />
  <my_popup :type="'defaut_confirm'" v-if="showPopup" :popupData="popupData" />
  <my_popup :type="'defaut_yes_no'" v-if="showPopupConfirm" :popupData="popupData" />
  <div class="headerBoxTickets">
    <text class="txtCountTickets">
      Tickets {{ actionStatus === 'add_ticket' ? '- New Ticket' : actionStatus === 'close_ticket' ? '- Close Ticket' : actionStatus === 'edit_ticket' ? '- Edit Ticket' :'' }}
    </text>
    <my_button v-if="actionStatus === 'list'" :type="'defaut_plus'" :onPress="() => handleAddTickets('add_ticket')"
      :txtBtn="'New'" />
  </div>
  <div v-if="actionStatus === 'list'" style="overflow-x: hidden;
    overflow-y: auto;width: 100%; height: 70%; margin-bottom: 30px;">
    <div v-if="tickets.length > 0" class="boxBodyTickets">
      <table style="width: 100%;">
        <thead style="background-color: #d6d8da">
          <tr>
            <th scope="col" class="styleThTickets">Actions</th>
            <th>
              Title
            </th>
            <th scope="col" class="styleThTickets">
              Description
            </th>
            <th scope="col" class="styleThTickets">
              Category
            </th>
            <th scope="col" class="styleThTickets">
                User name
            </th>
            <th scope="col" class="styleThTickets">
                Status
            </th>
          </tr>
        </thead>
        <tbody>
          <tr scope='row' v-for="(item, ix) in tickets" :key="ix" :class="ix % 2 === 0 ? 'styleTrTickets' : 'styleTrTicketsOne'">
            <td class="styleTdTickets">
              <div>
                <button @click="onChangeAction(item,'accept')" type="button">Accept</button>
                <button @click="onChangeAction(item,'edit')" type="button">Edit</button>
                <button @click="onChangeAction(item,'close')" type="button">Close</button>
                <button @click="onChangeAction(item,'cancel')" type="button">Cancel</button>
                <button @click="onChangeAction(item,'show_ticket')" type="button">Show Ticket</button>
                <button @click="onChangeAction(item,'add_comentary')" type="button">Add Comentary</button>
                <!--<select :id="`${ix}options_Tickets`" @change="onChangeAction($event)"
                  style="cursor: pointer; background-color: #ffffff; height: 30px; width: 60px; color: #1c9648; border-radius:  6px; border: 0.2px solid #1c9648; height: 30px;">
                  <option :value="`default*`">...</option>
                  <option :value="`edit*${item.id}`">Edit</option>
                  <option :value="`delete*${item.id}*${ix}options_Tickets`">Delete</option>
                </select>-->
              </div>
            </td>
            <td>
              <text class="styleTxtTdTickets">{{ item.title }}</text>
            </td>
            <td>
              <text class="styleTxtTdTickets">{{ item.description }}</text>
            </td>
            <td>
              <text class="styleTxtTdTickets">{{ item.category.name }}</text>
            </td>
            <td>
              <text class="styleTxtTdTickets">{{ item.user.name }}</text>
            </td>
            <td>
              <text class="styleTxtTdTickets">{{ item.status.name }}</text>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else class="boxNoTickets">
      <text style="color: gray; text-align: center; font-size: 22px;">
        {{ `${loading ? 'Loading ...' : "There aren't tickets yet!"}` }}</text>
    </div>
  </div>
  <div v-if="actionStatus === 'add_comentary'" class="boxBodyNewUser">
    <my_input :type_style="'fields_defaut'" :value="formDataCommentary.description"
      :onChange="(val) => handleInput(val, 'description')" :type="'text-area'" :label="'Description *'" :lenght="100"
      :inputError="errors[0] === true ? 'Preencha este campo!' : ''" />
      <br>
      <my_button :type="'defaut_border'" :onPress="() => handleSaveComentary()"
      :txtBtn="'Save'" :colorStyle="'green'" :disabled="blockNext" />
      <my_button :type="'defaut_border'" :onPress="() => handleAddTickets('list')" :txtBtn="'Cancel'"
      :colorStyle="'red'" />
  </div>

  <div v-if="actionStatus === 'close_ticket'" class="boxBodyNewUser">
    <my_input :type_style="'fields_defaut'" :value="formDataTicket.resolution"
      :onChange="(val) => handleInput(val, 'resolution')" :type="'text-area'" :label="'Resolution *'" :lenght="100"
      :inputError="errors[3] === true ? 'Preencha este campo!' : ''" />
      <br>
      <my_button :type="'defaut_border'" :onPress="() => handleSaveResolution()"
      :txtBtn="'Save'" :colorStyle="'green'" :disabled="blockNext" />
      <my_button :type="'defaut_border'" :onPress="() => handleAddTickets('list')" :txtBtn="'Cancel'"
      :colorStyle="'red'" />
  </div>
  <div v-if="actionStatus === 'add_ticket' || actionStatus === 'edit_ticket'" class="boxBodyNewUser">
    <my_input :type_style="'fields_defaut'" :value="formDataTicket.title"
      :onChange="(val) => handleInput(val, 'title')" :type="'text'" :label="'Title *'" :lenght="100"
      :inputError="errors[1] === true ? 'Preencha este campo!' : ''" />
    <br>
    
    <my_input :type_style="'fields_defaut'" :value="formDataTicket.description"
      :onChange="(val) => handleInput(val, 'description')" :type="'text'" :label="'Description *'" :lenght="100"
      :inputError="errors[0] === true ? 'Preencha este campo!' : ''" />
    <br>
    <select v-model="formDataTicket.category_id" @change="onChangeActionField($event)">
        <option :value="`Choose`">Choose the Category</option>
        <option v-for="it in list_categories" :key="it?.name" :value="`${it?.id}`">{{it?.name}}</option>
    </select>

    <br>
    <my_button :type="'defaut_border'" :onPress="() => handleSaveNewTicket(actionStatus)"
      :txtBtn="'Save'" :colorStyle="'green'" :disabled="blockNext" />
    <my_button :type="'defaut_border'" :onPress="() => handleAddTickets('list')" :txtBtn="'Cancel'"
      :colorStyle="'red'" />
  </div>
</template>
<script>
import { MyButton, MyInput, MyLoading, MyPopup } from '../../components/index'
import { TicketsService } from '../../service/tickets-service/ticketsService'
import { CommentaryService } from '../../service/commentary-service/commentaryService'

export default {
    data() {
        return {
            loading: false,
            tickets: [],
            list_categories: [],
            showPopup: false,
            showPopupConfirm: false,
            ticketsService: new TicketsService,
            commentaryService: new CommentaryService,
            actionStatus: 'list',
            errors: [
                false,
                false,
            ],
            formDataCommentary: {
                description: '',
                id: '',
                ticket_id: ''
            },
            formDataTicket: {
                title: '',
                description: '',
                resolution: '',
                category_id: '',
                id: ''
            },
            popupData: {
                txtConfirm: '',
                txtCancel: '',
                title: '',
                description: '',
                pathIcon: '',
                pressOk: () => { },
                pressNo: () => { }
            },
        }
    },

    created() {
        this.handleGetTickets()
        this.handleGetCategories()
    },

    methods: {
        handleInput({ type, target }, it) {
            this.errors = [false, false, false, false]
            let val = target.value
            this.formDataTicket[it] = val
            if (it === 'description'){
                this.formDataCommentary[it] = val
            }
        },
        handleAddTickets(status) {
            if (status === 'add_ticket' || status === 'list') {
                this.handleCleanFields()
            }
            this.actionStatus = status
        },
        onChangeAction(item,type) {
            const id = Number(item.id)
            const ticket = this.tickets.find(item => item.id === id)

            if (type === 'add_comentary'){
                this.formDataCommentary.ticket_id = id
                this.actionStatus = 'add_comentary'
            }

            if (type === 'accept') {
                if (item.status.id !== 1){
                    this.handleModal(
                        'Error',
                        "You can't Accept this Ticket!"
                    )
                }else{
                    this.handleModalYesNo(
                        'Accept Ticket',
                        'Are you accept this Ticket?',
                        id,
                        'accept'
                    )
                    this.showPopupConfirm = true
                }
            }

            if (type === 'close') {
                if (item.status.id !== 1 && item.status.id !== 2){
                    this.handleModal(
                        'Error',
                        "You can't Close this Ticket!"
                    )
                }else{
                    this.formDataTicket.description = ticket?.description
                    this.formDataTicket.title = ticket?.title
                    this.formDataTicket.user_id = ticket?.user_id
                    this.formDataTicket.category_id = ticket?.category_id
                    this.formDataTicket.ticket_status_id = ticket?.ticket_status_id
                    this.formDataTicket.id = ticket?.id
                    this.actionStatus = 'close_ticket'
                }
            }

            if (type === 'cancel') {
                if (item.status.id === 4 || item.status.id === 3){
                    this.handleModal(
                        'Error',
                        "You can't cancel this Ticket!"
                    )
                }else{
                    this.handleModalYesNo(
                        'Cancel Ticket',
                        'Are you cancel this Ticket?',
                        id
                    )
                    this.showPopupConfirm = true
                }
            }

            if (type === 'edit') {
                this.formDataTicket.description = ticket?.description
                this.formDataTicket.title = ticket?.title
                this.formDataTicket.user_id = ticket?.user_id
                this.formDataTicket.category_id = ticket?.category_id
                this.formDataTicket.ticket_status_id = ticket?.ticket_status_id
                this.formDataTicket.id = ticket?.id
                this.actionStatus = 'edit_ticket'
            }
        },
        handleModalYesNo(title, description, id = null, type = "cancel") {
            this.popupData = {
                title,
                description,
                txtConfirm: 'Confirm',
                txtCancel: 'Cancel',
                pressOk: () => {
                    this.showPopupConfirm = false
                    if (type === "cancel"){
                        this.handleCancelTicket(id)
                    } else if (type === "accept") {
                        this.handleAcceptTicket(id)
                    }
                },
                pressNo: () => {
                this.showPopupConfirm = false
                }
            }
            this.showPopupConfirm = true
        },
        async handleAcceptTicket(id){
            this.loading = true
            const response = await this.ticketsService.requestAcceptTicket(id)
            this.loading = false
            if (response.success) {
                this.handleModal(
                'Sucess',
                'The Ticket was accept!',
                true
                )
            } else {
                this.handleModal(
                'Error!',
                `${response?.message ? response.message : 'We have a problem, try again!'}`
                )
            }
        },
        async handleCancelTicket(id){
            this.loading = true
            const response = await this.ticketsService.requestCancelTicket(id)
            this.loading = false
            if (response.success) {
                this.handleModal(
                'Sucess',
                'The Ticket was cancel!',
                true
                )
            } else {
                this.handleModal(
                'Error!',
                `${response?.message ? response.message : 'We have a problem, try again!'}`
                )
            }
        },
        async handleSaveComentary(){
            let verify = this.verifyFieldsCommentary()
            const body = {
                description: this.formDataCommentary.description,
                ticket_id: Number(this.formDataCommentary.ticket_id)
            }
            if (verify){
                this.loading = true
                const response = await this.commentaryService.requestSaveCommentary(body)
                this.loading = false
                if (response) {
                    this.handleModal(
                        'Save Commentary',
                        'The Commentary has save successfully.',
                        true
                    )
                } else {
                    this.handleModal(
                        'Error',
                        'Something is wrong.'
                    )
                }
            }
        },
        async handleSaveResolution(){
            const body = {
                description: this.formDataTicket.description,
                title: this.formDataTicket.title,
                category_id: Number(this.formDataTicket.category_id),
                ticket_status_id: 3,
                resolution: this.formDataTicket.resolution
            }
            this.loading = true
            const response = await this.ticketsService.requestCloseTicket(body, this.formDataTicket.id)
            this.loading = false
            if (response) {
                this.handleModal(
                    'Close ticket',
                    'The Ticket was closed successfully.',
                    true
                )
            } else {
                this.handleModal(
                    'Error',
                    'Something is wrong.'
                )
            }
            
        },
        async handleSaveNewTicket(action){
            const validFields = this.verifyFields()
            const body = {
                description: this.formDataTicket.description,
                title: this.formDataTicket.title,
                category_id: Number(this.formDataTicket.category_id),
                ticket_status_id: 1,
            }
            if (validFields && action === 'add_ticket') {
                this.loading = true
                const response = await this.ticketsService.requestSaveTicket(body)
                this.loading = false
                if (response) {
                    this.handleModal(
                        'New ticket',
                        'The Ticket was saved successfully.',
                        true
                )
                } else {
                    this.handleModal(
                        'Error',
                        'Something is wrong.'
                    )
                }
            }

            if (validFields && action === 'edit_ticket') {
                this.loading = true
                const response = await this.ticketsService.requestEditTicket(body, this.formDataTicket.id)
                this.loading = false
                if (response) {
                    this.handleModal(
                        'New ticket',
                        'The Ticket was saved successfully.',
                        true
                )
                } else {
                    this.handleModal(
                        'Error',
                        'Something is wrong.'
                    )
                }
            }
        },
        verifyFields() {
            const { description, title, category_id } = this.formDataTicket
            const list = [description, title, category_id]
            let ix = list.indexOf('')

            if (ix > -1) {
                this.errors[ix] = true
                return false
            }
            /*if (json_columns_type.length === 0) {
                this.errors[3] = true
                return false
            }*/
            return true
        },
        verifyFieldsCommentary() {
            const { description } = this.formDataCommentary
            const list = [description]
            let ix = list.indexOf('')

            if (ix > -1) {
                this.errors[ix] = true
                return false
            }
            /*if (json_columns_type.length === 0) {
                this.errors[3] = true
                return false
            }*/
            return true
        },
        handleCleanFields() {
            this.list_selected = []
            this.errors = [false, false]
            this.formDataTicket.description = ''
            this.formDataTicket.resolution = ''
            this.formDataTicket.category_id = ''
            this.formDataTicket.title = ''
            this.formDataTicket.id = ''
            this.formDataCommentary.ticket_id = ''
            this.formDataCommentary.description = ''
        },
        handleModal(title, description, success = false) {
            this.popupData = {
                title,
                description,
                pressOk: () => {
                if (success) {
                    this.handleAddTickets('list')
                    this.handleCleanFields()
                    this.handleGetTickets()
                }
                this.showPopup = false
                }
            }
            this.showPopup = true
        },
        onChangeActionField(e) {
            this.formDataTicket.category_id = e.target.value
        },
        async handleGetCategories() {
            this.loading = true
            const response = await this.ticketsService.requestGetCategories()
            console.log(response)
            this.loading = false
            if (response) {
                this.list_categories = response
            }
        },
        async handleGetTickets() {
            this.loading = true
            const response = await this.ticketsService.requestGetTickets()
            this.loading = false
            if (response) {
                this.tickets = response
                // this.formDataTickets.start_number = this.handleSequence(response.length)
            } else {
                this.handleModal(
                'Something is wrong',
                "We can't find the data."
                )
            }
        },
    },

    

    components: {
        my_button: MyButton,
        my_input: MyInput,
        my_loading: MyLoading,
        my_popup: MyPopup
    }
}
</script>
<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
.headerBoxTickets {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-direction: row;
  margin-top: 20px;
  margin-bottom: 20px;
}

.boxTicketsAdd {
  margin-top: 6px;
  align-items: center;
  width: 100%;
  display: flex;
  justify-content: space-between;
  flex-direction: row
}

.boxInputItemP {
  overflow-x: hidden;
  overflow-y: auto;
  width: 47%;
  height: 120px;
  padding-block: 3px;
  display: flex;
  flex-direction: row;
  border: 0.2px solid #d9d6d6;
  flex-wrap: wrap;
}

.boxInputContentP {
  height: 24px;
  margin-left: 5px;
  background-color: #d9d6d6;
  border-radius: 3px;
  border: 0.2px solid #b4b0b0;
}

.boxRemoveItem {
  height: 25px;
  margin-left: 5px;
  background-color: #d9d6d6;
  display: flex;
  flex-direction: row;
  border-radius: 3px;
  border: 0.2px solid #b4b0b0;
  align-items: center;
}

.boxBodyTickets {
  width: 100%;
  margin-bottom: 30px;
}

.boxBodyNewUser {
  width: 70%;
}

.styleThTickets {
  color: gray;
  padding-block: 12px;
  text-align: center;
}

.styleTrTickets {
  background-color: rgb(238, 230, 230);
  text-align: center;
  padding-block: 12px;
}

.styleTrTicketsOne {
  text-align: center;
  padding-block: 12px;
}

.styleTdTickets {
  height: 36px;
  text-align: center;
}

.txtCountTickets {
  font-weight: bold;
  font-family:  sans-serif;
  color: gray;
  font-size: 18px
}

.bottomTicketstyle {
  width: 100%;
  flex-direction: row;
  display: flex;
  justify-content: flex-end
}

.styleTxtTdTickets {
  font-family:  sans-serif;
  color: rgb(164, 163, 163);
  font-size: 16px
}

.custom-select select {
  display: none;
}

.boxNoTickets {
  display: flex;
  height: 30%;
  width: 100%;
  justify-content: center;
  align-items: center;
}
</style>