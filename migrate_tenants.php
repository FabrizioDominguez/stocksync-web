<?php
$users = App\Models\User::whereNull('tenant_id')->get();
foreach($users as $user) {
    $tenant = App\Models\Tenant::create([
        'name' => 'Tienda de ' . $user->name,
        'slug' => \Illuminate\Support\Str::slug($user->name) . '-' . substr(uniqid(), -4),
        'whatsapp_number' => '59170000000',
    ]);
    $user->update(['tenant_id' => $tenant->id]);
    echo 'Migrated user: ' . $user->name . "\n";
}

$tenant = App\Models\Tenant::first();
if ($tenant) {
    // Disable global scope for category and product to allow updating null tenant_ids
    App\Models\Category::withoutGlobalScope('tenant')->whereNull('tenant_id')->update(['tenant_id' => $tenant->id]);
    App\Models\Product::withoutGlobalScope('tenant')->whereNull('tenant_id')->update(['tenant_id' => $tenant->id]);
    echo "Migrated products and categories.\n";
}
