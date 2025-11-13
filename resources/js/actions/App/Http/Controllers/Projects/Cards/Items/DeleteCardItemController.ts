import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\DeleteCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
const DeleteCardItemController = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteCardItemController.url(args, options),
    method: 'delete',
})

DeleteCardItemController.definition = {
    methods: ["delete"],
    url: '/projects/{project}/cards/{card}/items/{item}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\DeleteCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.php:16
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
DeleteCardItemController.url = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions) => {
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

    return DeleteCardItemController.definition.url
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
DeleteCardItemController.delete = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteCardItemController.url(args, options),
    method: 'delete',
})

export default DeleteCardItemController