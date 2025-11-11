import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\DeleteCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/DeleteCardController.php:19
* @route '/projects/{project}/cards/{card}'
*/
const DeleteCardController = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteCardController.url(args, options),
    method: 'delete',
})

DeleteCardController.definition = {
    methods: ["delete"],
    url: '/projects/{project}/cards/{card}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Projects\Cards\DeleteCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/DeleteCardController.php:19
* @route '/projects/{project}/cards/{card}'
*/
DeleteCardController.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return DeleteCardController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\DeleteCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/DeleteCardController.php:19
* @route '/projects/{project}/cards/{card}'
*/
DeleteCardController.delete = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteCardController.url(args, options),
    method: 'delete',
})

export default DeleteCardController