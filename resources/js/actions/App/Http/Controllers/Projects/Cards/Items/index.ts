import ChangeItemPriorityController from './ChangeItemPriorityController'
import CreateCardItemController from './CreateCardItemController'
import UpdateItemController from './UpdateItemController'
import ChangeCardItemController from './ChangeCardItemController'
import DeleteCardItemController from './DeleteCardItemController'

const Items = {
    ChangeItemPriorityController: Object.assign(ChangeItemPriorityController, ChangeItemPriorityController),
    CreateCardItemController: Object.assign(CreateCardItemController, CreateCardItemController),
    UpdateItemController: Object.assign(UpdateItemController, UpdateItemController),
    ChangeCardItemController: Object.assign(ChangeCardItemController, ChangeCardItemController),
    DeleteCardItemController: Object.assign(DeleteCardItemController, DeleteCardItemController),
}

export default Items