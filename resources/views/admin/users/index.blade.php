@php
    $paginator = $users ?? null;
    $records = collect($paginator?->items() ?? [])->map(fn ($user) => [
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email,
        'role' => $user->role,
        'member' => $user->member ? $user->member->first_name.' '.$user->member->last_name : 'Not linked',
        'joined' => $user->created_at?->format('M d, Y'),
    ])->values()->all();
@endphp

<x-layouts::admin title="Users" page="users" :activity="true">
    <x-admin.resource
        title="Users"
        description="Manage account access and roles."
        noun="user"
        :records="$records"
        :paginator="$paginator"
        :columns="['username' => 'Username', 'email' => 'Email', 'role' => 'Role', 'member' => 'Member profile']"
        :badges="['role']"
        filter-key="role"
        :details="['username' => 'Username', 'email' => 'Email', 'role' => 'Role', 'member' => 'Member profile', 'joined' => 'Registered']"
        update="admin.users.update"
        destroy="admin.users.destroy"
        param="user"
    >
        <x-slot:fields>
            <x-field name="role" label="Role" type="select" :options="['user' => 'Member', 'admin' => 'Admin']" default="user" required />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>