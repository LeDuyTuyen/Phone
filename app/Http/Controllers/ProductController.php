<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $products = Product::get();

            return response()->json(ProductResource::collection($products));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $product = Product::create($request->only(['name', 'description', 'category_id']));
            if ($request->hasFile('image')) {
                $uploadedFiles = $request->file('image');
                foreach ($uploadedFiles as $uploadedFile) {

                    $cloudImage = Cloudinary::upload($uploadedFile->getRealPath(), ['folder' => 'product']);

                    Image::create([
                        'path'       => $cloudImage->getSecurePath(),
                        'public_id'  => $cloudImage->getPublicId(),
                        'product_id' => $product->id,
                    ]);
                }
            }

            return response()->json(
                [
                    'message' => 'Product created successfully',
                    'product' => new ProductResource($product)],
                201
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        // dd($request->toArray());
        try {
            $product->update($request->only(['name', 'description', 'category_id']));
            if ($request->hasFile('image')) {
                $uploadedFiles = $request->file('image');

                if ( ! empty($uploadedFiles)) {
                    foreach ($uploadedFiles as $uploadedFile) {
                        if ($uploadedFile) { // Kiểm tra file có hợp lệ hay không
                            $cloudImage = Cloudinary::upload($uploadedFile->getRealPath(), ['folder' => 'product']);

                            Image::create([
                                'path'       => $cloudImage->getSecurePath(),
                                'public_id'  => $cloudImage->getPublicId(),
                                'product_id' => $product->id,
                            ]);
                        }
                    }
                }
            }

            return response()->json(
                [
                    'message' => 'Product updated successfully',
                    'product' => new ProductResource($product),
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Product $product): JsonResponse
    {
        try {
            if ($product->image) {
                foreach ($product->image as $image) {
                    Cloudinary::destroy($image->public_id);
                    $image->delete();
                }
            }
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeImage(Product $product, Image $image): JsonResponse
    {
        try {
            if ($image->product_id !== $product->id) {
                return response()->json(['error' => 'Ảnh không thuộc sản phẩm này.'], 403);
            }

            $publicId = $image->public_id;
            if ($publicId) {
                Cloudinary::destroy($image->public_id);
            } else {
                return response()->json(['error' => 'Không tìm thấy public_id của ảnh.'], 404);
            }

            $image->delete();

            return response()->json(['message' => 'Xóa ảnh thành công.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra khi xóa ảnh.', 'message' => $e->getMessage()], 500);
        }
    }
}
