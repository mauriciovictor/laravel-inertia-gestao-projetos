import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/move'
*/
const ChangeCardItemController = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: ChangeCardItemController.url(args, options),
    method: 'put',
})

ChangeCardItemController.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}/items/move',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/move'
*/
ChangeCardItemController.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return ChangeCardItemController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\ChangeCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/move'
*/
ChangeCardItemController.put = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: ChangeCardItemController.url(args, options),
    method: 'put',
})

export default ChangeCardItemController