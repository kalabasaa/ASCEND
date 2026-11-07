@php
    $paginator = $visits ?? null;
    $records = collect($paginator?->items() ?? [])->map(fn ($visit) => [
        'id' => $visit->id,
        'member' => $visit->member ? $visit->member->first_name.' '.$visit->member->last_name : 'Unknown',
        'member_code' => $visit->member?->member_id,
        'check_in' => $visit->check_in?->format('M d, Y g:i A'),
        'visit_date' => $visit->visit_date,
    ])->values()->all();
@endphp

<x-layouts::admin title="Visits" page="visits" :activity="true">
    <x-admin.resource
        title="Visits"
        description="Gym check-in history. Members check in once per day."
        noun="visit"
        :records="$records"
        :paginator="$paginator"
        :columns="['member' => 'Member', 'member_code' => 'Member ID', 'check_in' => 'Checked in']"
        :details="['member' => 'Member', 'member_code' => 'Member ID', 'check_in' => 'Checked in', 'visit_date' => 'Visit date']"
        param="visit"
    />
</x-layouts::admin>