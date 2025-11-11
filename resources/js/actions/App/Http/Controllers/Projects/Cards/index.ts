import ListByProjectController from './ListByProjectController'
import CreateCardController from './CreateCardController'
import UpdateCardController from './UpdateCardController'
import DeleteCardController from './DeleteCardController'

const Cards = {
    ListByProjectController: Object.assign(ListByProjectController, ListByProjectController),
    CreateCardController: Object.assign(CreateCardController, CreateCardController),
    UpdateCardController: Object.assign(UpdateCardController, UpdateCardController),
    DeleteCardController: Object.assign(DeleteCardController, DeleteCardController),
}

export default Cards