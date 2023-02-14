 
import { usePage } from "@inertiajs/vue3";
let page = usePage().props;
export default {
    data() {
        return {
            permissions: page?.auth?.user?.permissions,
            roles: page?.auth?.user?.roles,
        };
    },
    methods: {
        can(value) {
            let _return = false;
            let permissions = this.permissions;

            if (permissions.length == 0) {
                _return = false;
            }

            if (!Array.isArray(permissions)) {
                _return = false;
            }

            if (value.includes("|")) {
                value.split("|").forEach(function (item) {
                    if (permissions.includes(item.trim())) {
                        _return = true;
                    }
                });
            } else if (value.includes("&")) {
                _return = true;
                value.split("&").forEach(function (item) {
                    if (!permissions.includes(item.trim())) {
                        _return = false;
                    }
                });
            } else {
                _return = permissions.includes(value.trim());
            }

            return _return;
        },

        is(value) {
            let _return = false;
            let roles = this.roles;

            if (roles.length == 0) {
                _return = false;
            }

            if (!Array.isArray(roles)) {
                _return = false;
            }

            if (value.includes("|")) {
                value.split("|").forEach(function (item) {
                    if (roles.includes(item.trim())) {
                        _return = true;
                    }
                });
            } else if (value.includes("&")) {
                _return = true;
                value.split("&").forEach(function (item) {
                    if (!roles.includes(item.trim())) {
                        _return = false;
                    }
                });
            } else {
                _return = roles.includes(value.trim());
            }

            return _return;
        },
    },
};
 