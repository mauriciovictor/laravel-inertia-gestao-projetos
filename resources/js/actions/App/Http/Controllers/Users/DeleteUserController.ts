import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Users\DeleteUserController::__invoke
* @see app/Http/Controllers/Users/DeleteUserController.php:16
* @route '/users/{user}'
*/
const DeleteUserController = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteUserController.url(args, options),
    method: 'delete',
})

DeleteUserController.definition = {
    methods: ["delete"],
    url: '/users/{user}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Users\DeleteUserController::__invoke
* @see app/Http/Controllers/Users/DeleteUserController.php:16
* @route '/users/{user}'
*/
DeleteUserController.url = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return DeleteUserController.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Users\DeleteUserController::__invoke
* @see app/Http/Controllers/Users/DeleteUserController.php:16
* @route '/users/{user}'
*/
DeleteUserController.delete = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: DeleteUserController.url(args, options),
    method: 'delete',
})

export default DeleteUserController