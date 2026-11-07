@php
    $paginator = $trainers ?? null;
    $records = collect($paginator?->items() ?? [])->map(fn ($trainer) => [
        'id' => $trainer->id,
        'first_name' => $trainer->first_name,
        'last_name' => $trainer->last_name,
        'name' => $trainer->first_name.' '.$trainer->last_name,
        'specialization' => $trainer->specialization,
        'phone' => $trainer->phone,
        'email' => $trainer->email,
        'status' => $trainer->status,
    ])->values()->all();
@endphp

<x-layouts::admin title="Trainers" page="trainers" :activity="true">
    <x-admin.resource
        title="Trainers"
        description="Trainer profiles and specializations."
        noun="trainer"
        :records="$records"
        :paginator="$paginator"
        :columns="['name' => 'Name', 'specialization' => 'Specialization', 'phone' => 'Phone', 'status' => 'Status']"
        :badges="['status']"
        filter-key="status"
        :details="['name' => 'Name', 'specialization' => 'Specialization', 'phone' => 'Phone', 'email' => 'Email', 'status' => 'Status']"
        store="admin.trainers.store"
        update="admin.trainers.update"
        destroy="admin.trainers.destroy"
        param="trainer"
    >
        <x-slot:fields>
            <x-field name="first_name" label="First name" required />
            <x-field name="last_name" label="Last name" required />
            <x-field name="specialization" label="Specialization" />
            <x-field name="phone" label="Phone" type="tel" />
            <x-field name="email" label="Email" type="email" />
            <x-field name="status" label="Status" type="select" :options="['active' => 'Active', 'inactive' => 'Inactive']" default="active" required />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>