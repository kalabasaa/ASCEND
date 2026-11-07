@php
    $paginator = $members ?? null;
    $userOptions = collect($users ?? [])->mapWithKeys(fn ($user) => [$user->id => $user->username])->all();
    $records = collect($paginator?->items() ?? [])->map(function ($member) {
        $latest = $member->subscriptions->sortByDesc('end_date')->first();

        return [
            'id' => $member->id,
            'member_id' => $member->member_id,
            'first_name' => $member->first_name,
            'last_name' => $member->last_name,
            'name' => $member->first_name.' '.$member->last_name,
            'phone' => $member->phone,
            'address' => $member->address,
            'gender' => $member->gender,
            'user_id' => $member->user_id,
            'status' => $latest?->status ?? 'none',
            'joined' => $member->created_at?->format('M d, Y'),
        ];
    })->values()->all();
@endphp

<x-layouts::admin title="Members" page="members" :activity="true">
    <x-admin.resource
        title="Members"
        description="Member profiles and membership status."
        noun="member"
        :records="$records"
        :paginator="$paginator"
        :columns="['name' => 'Name', 'member_id' => 'Member ID', 'phone' => 'Phone', 'status' => 'Membership']"
        :badges="['status']"
        filter-key="status"
        :details="['member_id' => 'Member ID', 'name' => 'Name', 'phone' => 'Phone', 'gender' => 'Gender', 'address' => 'Address', 'user_id' => 'Linked user ID', 'status' => 'Membership', 'joined' => 'Joined']"
        store="admin.members.store"
        update="admin.members.update"
        destroy="admin.members.destroy"
        param="member"
    >
        <x-slot:fields>
            <x-field name="first_name" label="First name" required />
            <x-field name="last_name" label="Last name" required />
            <x-field name="phone" label="Phone" type="tel" />
            <x-field name="gender" label="Gender" type="select" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" />
            <x-field name="address" label="Address" type="textarea" />
            <x-field name="user_id" label="Linked user" type="relation" :options="$userOptions" hint="Optional. Links this profile to a login account." />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>