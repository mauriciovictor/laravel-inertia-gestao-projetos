import { usePage } from '@inertiajs/vue3'

export function usePermissionAction() {
    const page = usePage()
    const actions = page.props.auth.user.permissions.features

    const hasPermissionAction = (feature, action) => actions[feature][action]

    return { hasPermissionAction, actions }
}
