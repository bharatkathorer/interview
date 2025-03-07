<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import {Button} from '@/components/ui/button';
import {Input} from '@/components/ui/input';
import {Label} from '@/components/ui/label';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import {LoaderCircle} from 'lucide-vue-next';
import {computed} from "vue";

const users: any = computed(() => usePage().props?.users ?? [])
defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    name: '',
    date_of_birth: '',
    id: null,
});

const submit = () => {
    if (form?.id) {
        form.put(route('users.update', form.id), {
            onSuccess: () => {
                form.reset();
                alert('User added successfully');
            }
        });
    } else {
        form.post(route('users.index'), {
            onSuccess: () => {
                form.reset();
                alert('User update successfully');
            }
        });
    }

};

const handleEdit = (item: any) => {
    form.id = item.id;
    form.name = item.name;
    form.email = item.email;
    form.date_of_birth = item.date_of_birth;

}

const handleDeleteItem = (item: any) => {

    if (confirm('Are you sure delete this user') == true) {
        router.delete(route('users.destroy', item.id), {
            onSuccess: () => {
                form.reset();
                alert('User delete successfully');
            }
        });
    }
}
</script>

<template>
    <Head title="Log in"/>


    <div class="p-10">
        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="form.errors.email"/>
                </div>
                <div class="grid gap-2">
                    <Label for="name">User Name</Label>
                    <Input
                        id="name"

                        required
                        autofocus
                        v-model="form.name"
                        placeholder="enter name"
                    />
                    <InputError :message="form.errors.name"/>
                </div>
                <div class="grid gap-2">
                    <Label for="date_of_birth">Enter Date of birth</Label>
                    <Input
                        id="date_of_birth"
                        type="date"
                        required
                        autofocus
                        v-model="form.date_of_birth"
                        placeholder="enter date_of_birth"
                    />
                    <InputError :message="form.errors.date_of_birth"/>
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>

                    </div>
                    <Input
                        id="password"
                        type="password"

                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password"/>
                </div>

                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin"/>
                    {{ form.id ? ' Update user' : ' Add user' }}
                </Button>
            </div>
        </form>
        <div>
            <div class="grid mt-10">
                <table>
                    <thead>
                    <tr>
                        <th class="text-left font-semibold capitalize">name</th>
                        <th class="text-left font-semibold capitalize">email</th>
                        <th class="text-left font-semibold capitalize">date of birth</th>
                        <th class="text-left font-semibold capitalize">actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item) in users" :key="item">
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            {{ item.email }}
                        </td>
                        <td>
                            {{ item.date_of_birth }}
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <Button @click="handleEdit(item)">
                                    Edit
                                </Button>
                                <Button @click="handleDeleteItem(item)">
                                    delete
                                </Button>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
