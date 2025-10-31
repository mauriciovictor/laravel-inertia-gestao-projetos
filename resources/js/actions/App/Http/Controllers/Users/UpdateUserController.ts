import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Users\UpdateUserController::__invoke
* @see app/Http/Controllers/Users/UpdateUserController.php:17
* @route '/users/{user}'
*/
const UpdateUserController = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateUserController.url(args, options),
    method: 'put',
})

UpdateUserController.definition = {
    methods: ["put"],
    url: '/users/{user}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Users\UpdateUserController::__invoke
* @see app/Http/Controllers/Users/UpdateUserController.php:17
* @route '/users/{user}'
*/
UpdateUserController.url = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return UpdateUserController.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Users\UpdateUserController::__invoke
* @see app/Http/Controllers/Users/UpdateUserController.php:17
* @route '/users/{user}'
*/
UpdateUserController.put = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: UpdateUserController.url(args, options),
    method: 'put',
})

export default UpdateUserController