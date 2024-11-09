<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Blog;
use App\Models\member\Rate;
use App\Models\User;
use App\Models\member\Comment;

class BlogController extends Controller
{
    public function blog_list()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->paginate(3);
        return view('member/blog/blog_list', compact('blogs'));
    }

    public function blog_detail($blog_id)
    {
        // Hiển thị blog_detail
        $blog = Blog::findOrFail($blog_id);
        // Thực hiện previous,next
        $current_updated = $blog->updated_at;
        $max_updated = $min_updated = $current_updated;
        foreach (Blog::all() as $key => $value) {
            if ($value->updated_at > $max_updated) {
                $max_updated = $value->updated_at;
            }
            if ($value->updated_at < $min_updated) {
                $min_updated = $value->updated_at;
            }
        }
        $id_max_updated = Blog::where('updated_at', $max_updated)->first()->id;
        $id_min_updated = Blog::where('updated_at', $min_updated)->first()->id;
        if ($current_updated >= $max_updated) {
            $id_previous = $id_max_updated;
        } else {
            $id_previous = Blog::where('updated_at', '>', $current_updated)->orderBy('updated_at', 'asc')->first()->id;
        }
        if ($current_updated <= $min_updated) {
            $id_next = $id_min_updated;
        } else {
            $id_next = Blog::where('updated_at', '<', $current_updated)->orderBy('updated_at', 'desc')->first()->id;
        }
        // tính rate
        $rates = Rate::where('blog_id', $blog_id)->get();
        $count_rate = count($rates);
        if ($count_rate == 0) {
            $avg = "Chưa có lượt đánh giá";
        } else {
            $sum = 0;
            foreach ($rates as $key => $value) {
                $sum += $value->rate;
            }
            $avg = round($sum / $count_rate);
        }
        // bình luận
        $count_comment = count(Comment::where('blog_id', $blog_id)->get());
        $comments = Comment::where('blog_id', $blog_id)->where('level', 0)->orderBy('updated_at', 'desc')->get();
        return view('member/blog/blog_detail', compact('blog', 'id_max_updated', 'id_min_updated', 'id_previous', 'id_next', 'count_rate', 'avg', 'comments', 'count_comment'));
    }

    public function blog_detail_rate()
    {
        $new_rate = new Rate();
        $new_rate->blog_id = $_POST['blog_id'];
        $new_rate->user_id = $_POST['user_id'];
        $new_rate->rate = $_POST['rate'];
        $new_rate->save();
        $count_rate = count(Rate::where('blog_id', $_POST['blog_id'])->get());
        return response()->json([
            'blog_id' => $new_rate->blog_id,
            'user_id' => $new_rate->user_id,
            'rate' => $new_rate->rate,
            'count_rate' => $count_rate,
        ]);
    }

    public function blog_detail_comment()
    {
        $name_user = User::findOrFail($_POST['user_id'])->name;
        $avatar_user = User::findOrFail($_POST['user_id'])->avatar ?? '';
        $new_comment = new Comment();
        $new_comment->blog_id = $_POST['blog_id'];
        $new_comment->user_id = $_POST['user_id'];
        $new_comment->comment = $_POST['comment'];
        $new_comment->level = $_POST['level'];
        $new_comment->save();
        $count_comment = count(Comment::where('blog_id', $_POST['blog_id'])->get());
        return response()->json([
            'comment_id' => $new_comment->id,
            'blog_id' => $new_comment->blog_id,
            'user_id' => $new_comment->user_id,
            'name_user' => $name_user,
            'avatar_user' => $avatar_user,
            'comment' => $new_comment->comment,
            'level' => $new_comment->level,
            'time' => $new_comment->updated_at->format('H:i'),
            'day' => $new_comment->updated_at->format('M d, y'),
            'count_comment' => $count_comment,
        ]);
    }

    public function blog_detail_replay()
    {
        $name_user = User::findOrFail($_POST['user_id'])->name;
        $avatar_user = User::findOrFail($_POST['user_id'])->avatar ?? '';
        $new_replay = new Comment();
        $new_replay->blog_id = $_POST['blog_id'];
        $new_replay->user_id = $_POST['user_id'];
        $new_replay->comment = $_POST['replay'];
        $new_replay->level = $_POST['level'];
        $new_replay->save();
        $count_comment = count(Comment::where('blog_id',$_POST['blog_id'])->get());
        return response()->json([
            'replay_id' => $new_replay->id,
            'blog_id' => $new_replay->blog_id,
            'user_id' => $new_replay->user_id,
            'name_user' => $name_user,
            'avatar_user' => $avatar_user,
            'replay' => $new_replay->comment,
            'level' => $new_replay->level,
            'time' => $new_replay->updated_at->format('H:i'),
            'day' => $new_replay->updated_at->format('M d, y'),
            'count_comment' => $count_comment,
        ]);
    }
}
