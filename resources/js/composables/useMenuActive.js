import { usePage } from '@inertiajs/vue3'

export function useMenuActive() {
    const page = usePage()
    const menus = page.props.auth.user.permissions.menus
    const hasMenuPermission = (item) => menus[item]

    return { hasMenuPermission, menus }
}
