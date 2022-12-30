<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { watch } from "@vue/runtime-core";

const props = defineProps({
    permissionWithGroup: Object,
    permissions: Object,
    all_group: Object,
    total_permissions: String,
    total_group: String,
});

const form = useForm({
    name: "",
    permissions: [],
    group_name: [],
    is_all_selected: false,
});

const allCheckSubmit = (e) => {
    if (e) {
        form.permissions = _.clone(props.permissions);
        form.group_name = _.clone(props.all_group);
    } else {
        form.permissions = [];
        form.group_name = [];
    }
};
watch(
    () => form.permissions,
    (permissions, old) => {
        let currentGroup = _.split(_.last(permissions), ".", 1)[0];
        if (old.length > permissions.length) {
            currentGroup = _.split(_.difference(old, permissions), ".", 1)[0];
        }

        let isCurrentGroupSelected = _.includes(form.group_name, currentGroup);
        let currentGroupPermissions = props.permissionWithGroup[currentGroup];
        let currentGroupSelectedPermissions = _.filter(
            permissions,
            function (item) {
                return item.indexOf(currentGroup) > -1;
            }
        );

        if (permissions.length == props.permissions.length) {
            form.is_all_selected = true;
            form.group_name = _.clone(props.all_group);
        } else {
            form.is_all_selected = false;
        }

        if (
            isCurrentGroupSelected &&
            currentGroupPermissions?.length !==
                currentGroupSelectedPermissions?.length
        ) {
            _.remove(form.group_name, (item) => item === currentGroup);
        } else if (
            !isCurrentGroupSelected &&
            currentGroupPermissions?.length ==
                currentGroupSelectedPermissions?.length
        ) {
            form.group_name.push(currentGroup);
        }
    }
);

const selectedGroup = (groupName) => {
    let selectedPermisssion = props.permissionWithGroup[groupName];

    if (!_.includes(form.group_name, groupName)) {
        form.group_name.push(groupName);
        _.forEach(selectedPermisssion, function (permission) {
            if (!_.includes(form.permissions, permission.name)) {
                form.permissions.push(permission.name);
            }
        });
    } else {
        _.remove(form.group_name, (item) => item === groupName);
        _.forEach(selectedPermisssion, function (permission) {
            _.remove(form.permissions, (item) => item === permission.name);
        });
    }

    if (form.group_name.length == props.total_group) {
        form.is_all_selected = true;
    } else {
        form.is_all_selected = false;
    }
};

const storeRole = () => {
    form.post(route("role.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                form.reset("name");
                nameInput.value.focus();
            }
            if (form.errors.permissions) {
                form.reset("permissions");
            }
        },
    });
};
</script>

<template>
    <section>
        <form @submit.prevent="storeRole" class="mt-6 space-y-6 p-3">
            <div class="flex gap-4 justify-center">
                <InputLabel
                    for="current_password"
                    value="Role Name :"
                    class="text-xl flex-none"
                />

                <div class="col-span-4 flex-auto">
                    <TextInput
                        id="name"
                        ref="nameInput"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="name"
                    />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
            </div>
            <div class="flex items-center gap-1 mb-5">
                <InputLabel
                    for="is_all_selected"
                    value="Select All"
                    class="text-2xl capitalize mr-2"
                />
                <input
                    type="checkbox"
                    id="is_all_selected"
                    v-model="form.is_all_selected"
                    class="checkbox w-5 h-5"
                    :checked="form.is_all_selected"
                    @change="allCheckSubmit(form.is_all_selected)"
                />
            </div>
            <div class="grid md:grid-cols-4 grid-cols-3 gap-5 pr-5 sm:pr-0">
                <div
                    v-for="(permissions, index) in permissionWithGroup"
                    :key="index"
                >
                    <div class="flex items-center gap-1 mb-5">
                        <input
                            type="checkbox"
                            id="group_name"
                            :value="form.group_name"
                            class="checkbox mr-1 w-5 h-5"
                            :checked="form.group_name.includes(index)"
                            @click="selectedGroup(index)"
                        />
                        <InputLabel
                            for="group_name"
                            :value="index"
                            class="text-xl capitalize"
                        />
                    </div>
                    <div
                        v-for="permission in permissions"
                        :key="permission.id"
                        class="flex"
                    >
                        <input
                            type="checkbox"
                            id="permissions"
                            :value="permission.name"
                            v-model="form.permissions"
                            class="checkbox mr-1"
                        />
                        <InputLabel
                            for="permissions"
                            :value="permission.name"
                        />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end pr-5 py-5">
                <PrimaryButton :disabled="form.processing"
                    >Submit</PrimaryButton
                >

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
