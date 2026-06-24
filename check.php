<?php
$product = App\Models\Product::withoutGlobalScope('tenant')->first();
echo "Product ID: " . $product->id . "\n";
echo "Product Tenant ID: " . $product->tenant_id . "\n";
echo "Product Category ID: " . $product->category_id . "\n";
$category = App\Models\Category::withoutGlobalScope('tenant')->find($product->category_id);
if ($category) {
    echo "Category exists. Category Tenant ID: " . $category->tenant_id . "\n";
} else {
    echo "Category does NOT exist.\n";
}
