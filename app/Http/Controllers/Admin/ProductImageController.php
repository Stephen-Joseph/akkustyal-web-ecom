<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Product\DeleteProductImageAction;
use App\Actions\Product\SetPrimaryProductImageAction;
use App\Actions\Product\UploadProductImageAction;
use App\Enums\ImageRole;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class ProductImageController extends Controller
{
    /**
     * Store a newly uploaded image file or register an external image URL for a product.
     */
    public function store(
        Request $request,
        Product $product,
        UploadProductImageAction $uploadProductImageAction
    ): RedirectResponse {
        $validated = $request->validate([
            'image_file' => ['nullable', 'file', 'image', 'mimes:jpeg,png,webp,gif,svg,avif', 'max:10240'],
            'image_url' => ['nullable', 'url', 'max:2000'],
            'image_role' => ['required', new Enum(ImageRole::class)],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
            'variant_id' => [
                'nullable',
                'uuid',
                Rule::exists('product_variants', 'id')->where('product_id', $product->id),
            ],
            'is_primary' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (! $request->hasFile('image_file') && empty($validated['image_url'])) {
            throw ValidationException::withMessages([
                'image_file' => 'Please either upload an image file or provide an external image URL.',
            ]);
        }

        $data = [
            'image_role' => $validated['image_role'],
            'alt_text' => $validated['alt_text'] ?? null,
            'caption' => $validated['caption'] ?? null,
            'variant_id' => $validated['variant_id'] ?? null,
            'cdn_url' => $validated['image_url'] ?? null,
            'is_primary' => $request->boolean('is_primary'),
            'sort_order' => isset($validated['sort_order']) ? (int) $validated['sort_order'] : null,
        ];

        $uploadProductImageAction->execute($product, $data, $request->file('image_file'));

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Product image added successfully.');
    }

    /**
     * Set a specific product image as the primary image.
     */
    public function setPrimary(
        Product $product,
        ProductImage $productImage,
        SetPrimaryProductImageAction $setPrimaryProductImageAction
    ): RedirectResponse {
        if ($productImage->product_id !== $product->id) {
            abort(404, 'Image assignment not found for this product.');
        }

        $setPrimaryProductImageAction->execute($product, $productImage);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Primary image updated successfully.');
    }

    /**
     * Remove an image from the product.
     */
    public function destroy(
        Product $product,
        ProductImage $productImage,
        DeleteProductImageAction $deleteProductImageAction
    ): RedirectResponse {
        if ($productImage->product_id !== $product->id) {
            abort(404, 'Image assignment not found for this product.');
        }

        $deleteProductImageAction->execute($product, $productImage);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Product image removed successfully.');
    }
}
