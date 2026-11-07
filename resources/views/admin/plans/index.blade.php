@php
    $paginator = $plans ?? null;
    $trainerOptions = collect($trainers ?? [])->mapWithKeys(fn ($trainer) => [$trainer->id => $trainer->first_name.' '.$trainer->last_name])->all();
    $records = collect($paginator?->items() ?? [])->map(fn ($plan) => [
        'id' => $plan->id,
        'name' => $plan->name,
        'description' => $plan->description,
        'duration_days' => $plan->duration_days,
        'duration_label' => $plan->duration_days.' days',
        'price' => $plan->price,
        'price_label' => '₱'.number_format($plan->price, 2),
        'trainer_id' => $plan->trainer_id,
        'trainer' => $plan->trainer ? $plan->trainer->first_name.' '.$plan->trainer->last_name : 'Unassigned',
        'status' => $plan->status,
    ])->values()->all();
@endphp

<x-layouts::admin title="Membership Plans" page="plans" :activity="true">
    <x-admin.resource
        title="Membership Plans"
        description="Plans members can subscribe to."
        noun="plan"
        :records="$records"
        :paginator="$paginator"
        :columns="['name' => 'Plan', 'price_label' => 'Price', 'duration_label' => 'Duration', 'trainer' => 'Trainer', 'status' => 'Status']"
        :badges="['status']"
        filter-key="status"
        :details="['name' => 'Plan', 'description' => 'Description', 'price_label' => 'Price', 'duration_label' => 'Duration', 'trainer' => 'Trainer', 'status' => 'Status']"
        store="admin.plans.store"
        update="admin.plans.update"
        destroy="admin.plans.destroy"
        param="plan"
    >
        <x-slot:fields>
            <x-field name="name" label="Plan name" required />
            <x-field name="description" label="Description" type="textarea" />
            <x-field name="duration_days" label="Duration (days)" type="number" min="1" required />
            <x-field name="price" label="Price (₱)" type="number" min="0" step="0.01" required />
            <x-field name="trainer_id" label="Trainer" type="relation" :options="$trainerOptions" hint="Optional." />
            <x-field name="status" label="Status" type="select" :options="['active' => 'Active', 'inactive' => 'Inactive']" default="active" required />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>