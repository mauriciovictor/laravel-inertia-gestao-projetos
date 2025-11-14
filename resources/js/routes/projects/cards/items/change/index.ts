import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeItemPriorityController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.php:18
* @route '/projects/{project}/cards/{card}/items/priority'
*/
export const priority = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: priority.url(args, options),
    method: 'put',
})

priority.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}/items/priority',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeItemPriorityController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.php:18
* @route '/projects/{project}/cards/{card}/items/priority'
*/
priority.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return priority.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeItemPriorityController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.php:18
* @route '/projects/{project}/cards/{card}/items/priority'
*/
priority.put = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: priority.url(args, options),
    method: 'put',
})

const change = {
    priority: Object.assign(priority, priority),
}

export default change