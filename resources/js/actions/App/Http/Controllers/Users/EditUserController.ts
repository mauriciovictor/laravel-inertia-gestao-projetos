import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Users\EditUserController::__invoke
* @see app/Http/Controllers/Users/EditUserController.php:19
* @route '/users/{user}'
*/
const EditUserController = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditUserController.url(args, options),
    method: 'get',
})

EditUserController.definition = {
    methods: ["get","head"],
    url: '/users/{user}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Users\EditUserController::__invoke
* @see app/Http/Controllers/Users/EditUserController.php:19
* @route '/users/{user}'
*/
EditUserController.url = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: args.user,
    }

    return EditUserController.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Users\EditUserController::__invoke
* @see app/Http/Controllers/Users/EditUserController.php:19
* @route '/users/{user}'
*/
EditUserController.get = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditUserController.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Users\EditUserController::__invoke
* @see app/Http/Controllers/Users/EditUserController.php:19
* @route '/users/{user}'
*/
EditUserController.head = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: EditUserController.url(args, options),
    method: 'head',
})

export default EditUserController