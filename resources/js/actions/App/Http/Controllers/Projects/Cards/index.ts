import ListByProjectController from './ListByProjectController'
import CreateCardController from './CreateCardController'
import UpdateCardController from './UpdateCardController'
import DeleteCardController from './DeleteCardController'
import Items from './Items'

const Cards = {
    ListByProjectController: Object.assign(ListByProjectController, ListByProjectController),
    CreateCardController: Object.assign(CreateCardController, CreateCardController),
    UpdateCardController: Object.assign(UpdateCardController, UpdateCardController),
    DeleteCardController: Object.assign(DeleteCardController, DeleteCardController),
    Items: Object.assign(Items, Items),
}

export default Cards