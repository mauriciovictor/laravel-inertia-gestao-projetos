import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
import items from './items'
/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
export const index = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(args, options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/projects/{project}/cards',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
index.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { project: args }
    }

    if (Array.isArray(args)) {
        args = {
            project: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
    }

    return index.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
index.get = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Projects\Cards\ListByProjectController::__invoke
* @see app/Http/Controllers/Projects/Cards/ListByProjectController.php:16
* @route '/projects/{project}/cards'
*/
index.head = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Projects\Cards\CreateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/CreateCardController.php:17
* @route '/projects/{project}/cards'
*/
export const store = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/projects/{project}/cards',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Projects\Cards\CreateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/CreateCardController.php:17
* @route '/projects/{project}/cards'
*/
store.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { project: args }
    }

    if (Array.isArray(args)) {
        args = {
            project: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
    }

    return store.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\CreateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/CreateCardController.php:17
* @route '/projects/{project}/cards'
*/
store.post = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Projects\Cards\UpdateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/UpdateCardController.php:18
* @route '/projects/{project}/cards/{card}'
*/
export const update = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\UpdateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/UpdateCardController.php:18
* @route '/projects/{project}/cards/{card}'
*/
update.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\UpdateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/UpdateCardController.php:18
* @route '/projects/{project}/cards/{card}'
*/
update.put = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Projects\Cards\DeleteCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/DeleteCardController.php:19
* @route '/projects/{project}/cards/{card}'
*/
export const destroy = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/projects/{project}/cards/{card}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Projects\Cards\DeleteCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/DeleteCardController.php:19
* @route '/projects/{project}/cards/{card}'
*/
destroy.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\DeleteCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/DeleteCardController.php:19
* @route '/projects/{project}/cards/{card}'
*/
destroy.delete = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const cards = {
    index: Object.assign(index, index),
    store: Object.assign(store, store),
    update: Object.assign(update, update),
    destroy: Object.assign(destroy, destroy),
    items: Object.assign(items, items),
}

export default cards