import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\UpdateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/UpdateCardController.php:18
* @route '/projects/{project}/cards/{card}'
*/
const UpdateCardController = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateCardController.url(args, options),
    method: 'put',
})

UpdateCardController.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\UpdateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/UpdateCardController.php:18
* @route '/projects/{project}/cards/{card}'
*/
UpdateCardController.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return UpdateCardController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\UpdateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/UpdateCardController.php:18
* @route '/projects/{project}/cards/{card}'
*/
UpdateCardController.put = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateCardController.url(args, options),
    method: 'put',
})

export default UpdateCardController