<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index($id)
    {
    }

    public function sendReview(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'review' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
            'product_id' => 'required|exists:products,id', // Kiểm tra xem product_id có tồn tại trong bảng products không
        ]);

        // Nếu dữ liệu không hợp lệ, chuyển hướng lại với thông báo lỗi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo một đối tượng review và lưu vào cơ sở dữ liệu
        $review = Review::create([
            'review_comment' => $request->input('comment'),
            'review_star' => $request->input('review'),
            'product_id' => $request->input('product_id'),
            'user_id' => Auth::id(),
            'review_status' => 0,
        ]);

        // Chuyển hướng trở lại trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Đánh giá thành công');
    }
}
