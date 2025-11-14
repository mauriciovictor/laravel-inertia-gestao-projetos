import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\UpdateItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/UpdateItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
const UpdateItemController = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateItemController.url(args, options),
    method: 'put',
})

UpdateItemController.definition = {
    methods: ["put"],
    url: '/projects/{project}/cards/{card}/items/{item}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\UpdateItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/UpdateItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
UpdateItemController.url = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions) => {
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

    return UpdateItemController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace('{item}', parsedArgs.item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\UpdateItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/UpdateItemController.php:17
* @route '/projects/{project}/cards/{card}/items/{item}'
*/
UpdateItemController.put = (args: { project: string | number, card: string | number, item: string | number } | [project: string | number, card: string | number, item: string | number ], options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateItemController.url(args, options),
    method: 'put',
})

export default UpdateItemController