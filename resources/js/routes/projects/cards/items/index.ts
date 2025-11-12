import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
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

const items = {
    store: Object.assign(store, store),
}

export default items