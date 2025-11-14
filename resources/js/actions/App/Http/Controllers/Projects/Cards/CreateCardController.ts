import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Projects\Cards\CreateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/CreateCardController.php:18
* @route '/projects/{project}/cards'
*/
const CreateCardController = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: CreateCardController.url(args, options),
    method: 'post',
})

CreateCardController.definition = {
    methods: ["post"],
    url: '/projects/{project}/cards',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Projects\Cards\CreateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/CreateCardController.php:18
* @route '/projects/{project}/cards'
*/
CreateCardController.url = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { project: args }
    }

    if (Array.isArray(args)) {
        args = {
            project: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        project: args.project,
    }

    return CreateCardController.definition.url
            .replace('{project}', parsedArgs.project.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Projects\Cards\CreateCardController::__invoke
* @see app/Http/Controllers/Projects/Cards/CreateCardController.php:18
* @route '/projects/{project}/cards'
*/
CreateCardController.post = (args: { project: string | number } | [project: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: CreateCardController.url(args, options),
    method: 'post',
})

export default CreateCardController