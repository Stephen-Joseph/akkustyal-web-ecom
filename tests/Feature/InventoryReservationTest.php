<?php

use App\Actions\Inventory\ReserveInventoryAction;
use App\Actions\Inventory\ReleaseInventoryAction;
use App\Actions\Inventory\UpdateInventoryLevelAction;
use App\Models\InventoryLevel;
use App\Models\ProductVariant;
use App\Models\Warehouse;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can update an inventory level for a variant in a warehouse', function (): void {
    $variant = ProductVariant::factory()->create();
    $warehouse = Warehouse::factory()->create(['priority' => 1, 'is_active' => true]);

    $action = app(UpdateInventoryLevelAction::class);

    $level = $action->execute($variant, $warehouse, [
        'quantity_on_hand' => 50,
        'quantity_reserved' => 0,
        'low_stock_threshold' => 5,
        'bin_location' => 'A1-R2-S3',
    ]);

    expect($level->quantity_on_hand)->toBe(50)
        ->and($level->quantity_available)->toBe(50)
        ->and($level->bin_location)->toBe('A1-R2-S3');
});

it('can reserve inventory from the highest-priority warehouse', function (): void {
    $variant = ProductVariant::factory()->create();
    $warehouse = Warehouse::factory()->create(['priority' => 1, 'is_active' => true]);

    InventoryLevel::create([
        'warehouse_id' => $warehouse->id,
        'variant_id' => $variant->id,
        'quantity_on_hand' => 20,
        'quantity_reserved' => 0,
        'low_stock_threshold' => 5,
    ]);

    $action = app(ReserveInventoryAction::class);
    $level = $action->execute($variant, 5);

    expect($level->quantity_reserved)->toBe(5)
        ->and($level->quantity_available)->toBe(15);
});

it('throws a validation exception when reserving more than available stock', function (): void {
    $variant = ProductVariant::factory()->create();
    $warehouse = Warehouse::factory()->create(['priority' => 1, 'is_active' => true]);

    InventoryLevel::create([
        'warehouse_id' => $warehouse->id,
        'variant_id' => $variant->id,
        'quantity_on_hand' => 3,
        'quantity_reserved' => 0,
        'low_stock_threshold' => 5,
    ]);

    $action = app(ReserveInventoryAction::class);

    expect(fn () => $action->execute($variant, 10))
        ->toThrow(\Illuminate\Validation\ValidationException::class);
});

it('can release previously reserved inventory', function (): void {
    $variant = ProductVariant::factory()->create();
    $warehouse = Warehouse::factory()->create(['priority' => 1, 'is_active' => true]);

    InventoryLevel::create([
        'warehouse_id' => $warehouse->id,
        'variant_id' => $variant->id,
        'quantity_on_hand' => 20,
        'quantity_reserved' => 10,
        'low_stock_threshold' => 5,
    ]);

    $action = app(ReleaseInventoryAction::class);
    $level = $action->execute($variant, 5, $warehouse);

    expect($level->quantity_reserved)->toBe(5)
        ->and($level->quantity_available)->toBe(15);
});

it('clamps release to prevent negative reservations', function (): void {
    $variant = ProductVariant::factory()->create();
    $warehouse = Warehouse::factory()->create(['priority' => 1, 'is_active' => true]);

    InventoryLevel::create([
        'warehouse_id' => $warehouse->id,
        'variant_id' => $variant->id,
        'quantity_on_hand' => 20,
        'quantity_reserved' => 2,
        'low_stock_threshold' => 5,
    ]);

    $action = app(ReleaseInventoryAction::class);
    // Attempt to release more than currently reserved
    $level = $action->execute($variant, 100, $warehouse);

    expect($level->quantity_reserved)->toBe(0)
        ->and($level->quantity_available)->toBe(20);
});
