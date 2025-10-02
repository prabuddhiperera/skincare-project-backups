<?php
// namespace App\Http\Controllers;

// use App\Models\MongoReview;
// use Illuminate\Http\Request;

// class MongoReviewController extends Controller
// {
//     // CREATE
//     public function store(Request $request)
//     {
//         $review = MongoReview::create([
//             'product_id' => $request->product_id,
//             'user_id'    => $request->user_id,
//             'comment'    => $request->comment,
//             'rating'     => $request->rating,
//         ]);

//         return response()->json($review);
//     }

//     // READ
//     public function index()
//     {
//         return MongoReview::all();
//     }

//     // UPDATE
//     public function update(Request $request, $id)
//     {
//         $review = MongoReview::find($id);
//         $review->update($request->only(['comment', 'rating']));
//         return response()->json($review);
//     }

//     // DELETE
//     public function destroy($id)
//     {
//         MongoReview::find($id)->delete();
//         return response()->json(['message' => 'Review deleted']);
//     }
// }
