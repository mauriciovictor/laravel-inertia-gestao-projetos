import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
import change from './change'
import move from './move'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:20
* @route '/projects/{project}/cards/{card}/items'
*/
export const store = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/projects/{project}/cards/{card}/items',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:20
* @route '/projects/{project}/cards/{card}/items'
*/
store.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            project: args[0],
            card: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
        card: args.card,
    }

    return store.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:20
* @route '/projects/{project}/cards/{card}/items'
*/
store.post = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Projects\Cards\Items\UpdateItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/UpdateItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
export const update = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}/items/{item}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\UpdateItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/UpdateItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
update.url = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            project: args[0],
            card: args[1],
            item: args[2],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
        card: args.card,
        item: args.item,
    }

    return update.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace('{item}', parsedArgs.item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\UpdateItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/UpdateItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
update.put = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Projects\Cards\Items\DeleteCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
export const destroy = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/projects/{project}/cards/{card}/items/{item}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\DeleteCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
destroy.url = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            project: args[0],
            card: args[1],
            item: args[2],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
        card: args.card,
        item: args.item,
    }

    return destroy.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace('{item}', parsedArgs.item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\DeleteCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
destroy.delete = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const items = {
    change: Object.assign(change, change),
    move: Object.assign(move, move),
    store: Object.assign(store, store),
    update: Object.assign(update, update),
    destroy: Object.assign(destroy, destroy),
}

export default items