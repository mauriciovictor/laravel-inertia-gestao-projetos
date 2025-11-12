import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:19
* @route '/projects/{project}/cards/{card}/items'
*/
const CreateCardItemController = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: CreateCardItemController.url(args, options),
    method: 'post',
})

CreateCardItemController.definition = {
    methods: ["post"],
    url: '/projects/{project}/cards/{card}/items',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:19
* @route '/projects/{project}/cards/{card}/items'
*/
CreateCardItemController.url = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions) => {
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

    return CreateCardItemController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace('{card}', parsedArgs.card.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\Items\CreateCardItemController::__invoke
* @see app/Http/Controllers/Projects/Cards/Items/CreateCardItemController.php:19
* @route '/projects/{project}/cards/{card}/items'
*/
CreateCardItemController.post = (args: { project: string | number, card: string | number } | [project: string | number, card: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: CreateCardItemController.url(args, options),
    method: 'post',
})

export default CreateCardItemController