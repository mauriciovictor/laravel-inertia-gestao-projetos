import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/move'
*/
export const item = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: item.url(args, options),
    method: 'put',
})

item.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}/items/move',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/move'
*/
item.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return item.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/move'
*/
item.put = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: item.url(args, options),
    method: 'put',
})

const move = {
    item: Object.assign(item, item),
}

export default move