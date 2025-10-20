import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PerfilController::openToComboBox
* @see app/Http/Controllers/PerfilController.php:84
* @route '/roles/open-combo-box'
*/
export const openToComboBox = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: openToComboBox.url(options),
    method: 'get',
})

openToComboBox.definition = {
    methods: ["get","head"],
    url: '/roles/open-combo-box',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PerfilController::openToComboBox
* @see app/Http/Controllers/PerfilController.php:84
* @route '/roles/open-combo-box'
*/
openToComboBox.url = (options?: RouteQueryOptions) => {
    return openToComboBox.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::openToComboBox
* @see app/Http/Controllers/PerfilController.php:84
* @route '/roles/open-combo-box'
*/
openToComboBox.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: openToComboBox.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PerfilController::openToComboBox
* @see app/Http/Controllers/PerfilController.php:84
* @route '/roles/open-combo-box'
*/
openToComboBox.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: openToComboBox.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PerfilController::index
* @see app/Http/Controllers/PerfilController.php:31
* @route '/roles'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/roles',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PerfilController::index
* @see app/Http/Controllers/PerfilController.php:31
* @route '/roles'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::index
* @see app/Http/Controllers/PerfilController.php:31
* @route '/roles'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PerfilController::index
* @see app/Http/Controllers/PerfilController.php:31
* @route '/roles'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PerfilController::create
* @see app/Http/Controllers/PerfilController.php:65
* @route '/roles/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/roles/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PerfilController::create
* @see app/Http/Controllers/PerfilController.php:65
* @route '/roles/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::create
* @see app/Http/Controllers/PerfilController.php:65
* @route '/roles/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PerfilController::create
* @see app/Http/Controllers/PerfilController.php:65
* @route '/roles/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PerfilController::store
* @see app/Http/Controllers/PerfilController.php:71
* @route '/roles'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/roles',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PerfilController::store
* @see app/Http/Controllers/PerfilController.php:71
* @route '/roles'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::store
* @see app/Http/Controllers/PerfilController.php:71
* @route '/roles'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PerfilController::edit
* @see app/Http/Controllers/PerfilController.php:47
* @route '/roles/{role}/edit'
*/
export const edit = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/roles/{role}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PerfilController::edit
* @see app/Http/Controllers/PerfilController.php:47
* @route '/roles/{role}/edit'
*/
edit.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: args.role,
    }

    return edit.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::edit
* @see app/Http/Controllers/PerfilController.php:47
* @route '/roles/{role}/edit'
*/
edit.get = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PerfilController::edit
* @see app/Http/Controllers/PerfilController.php:47
* @route '/roles/{role}/edit'
*/
edit.head = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PerfilController::update
* @see app/Http/Controllers/PerfilController.php:54
* @route '/roles/{role}'
*/
export const update = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\PerfilController::update
* @see app/Http/Controllers/PerfilController.php:54
* @route '/roles/{role}'
*/
update.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: args.role,
    }

    return update.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::update
* @see app/Http/Controllers/PerfilController.php:54
* @route '/roles/{role}'
*/
update.put = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\PerfilController::update
* @see app/Http/Controllers/PerfilController.php:54
* @route '/roles/{role}'
*/
update.patch = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\PerfilController::destroy
* @see app/Http/Controllers/PerfilController.php:78
* @route '/roles/{role}'
*/
export const destroy = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/roles/{role}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\PerfilController::destroy
* @see app/Http/Controllers/PerfilController.php:78
* @route '/roles/{role}'
*/
destroy.url = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { role: args }
    }

    if (Array.isArray(args)) {
        args = {
            role: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        role: args.role,
    }

    return destroy.definition.url
            .replace('{role}', parsedArgs.role.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PerfilController::destroy
* @see app/Http/Controllers/PerfilController.php:78
* @route '/roles/{role}'
*/
destroy.delete = (args: { role: string | number } | [role: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const PerfilController = { openToComboBox, index, create, store, edit, update, destroy }

export default PerfilController