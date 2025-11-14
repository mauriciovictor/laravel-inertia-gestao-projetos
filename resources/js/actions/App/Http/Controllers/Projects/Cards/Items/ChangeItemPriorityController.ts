import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeItemPriorityController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.php:18
* @route '/projects/{project}/cards/{card}/items/priority'
*/
const ChangeItemPriorityController = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: ChangeItemPriorityController.url(args, options),
    method: 'put',
})

ChangeItemPriorityController.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}/items/priority',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeItemPriorityController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.php:18
* @route '/projects/{project}/cards/{card}/items/priority'
*/
ChangeItemPriorityController.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return ChangeItemPriorityController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeItemPriorityController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.php:18
* @route '/projects/{project}/cards/{card}/items/priority'
*/
ChangeItemPriorityController.put = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: ChangeItemPriorityController.url(args, options),
    method: 'put',
})

export default ChangeItemPriorityController