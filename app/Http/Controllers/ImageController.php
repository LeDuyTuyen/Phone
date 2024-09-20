<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;

final class ImageController extends Controller
{
    public function upload(Request $request, Product $product_id)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $uploadedFile = $request->file('image');
            $cloudImage   = Cloudinary::upload($uploadedFile->getRealPath(), ['folder' => 'product']);
            $path         = $cloudImage->getSecurePath();
            $publicId     = $cloudImage->getPublicId();

            $image = Image::create([
                'public_id'  => $publicId,
                'path'       => $path,
                'product_id' => $product_id,
            ]);

            $uploadedFile->close();

            return response()->json($image, 201);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        return response()->json(['url' => $uploadedFileUrl]);
    }
}
