import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
import move from './move'
import change from './change'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:19
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
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:19
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
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:19
* @route '/projects/{project}/cards/{card}/items'
*/
store.post = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Projects\Cards\Items\DeleteCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:16
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
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:16
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
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
destroy.delete = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const items = {
    store: Object.assign(store, store),
    move: Object.assign(move, move),
    change: Object.assign(change, change),
    destroy: Object.assign(destroy, destroy),
}

export default items