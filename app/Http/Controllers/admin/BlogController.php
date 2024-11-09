<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Blog;
use App\Http\Requests\admin\AddBlogRequest;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Requests\admin\UpdateBlogRequest;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blog_list()
    {
        $blogs = Blog::all();
        return view('admin/blog/blog_list', compact('blogs'));
    }

    public function blog_add_form()
    {
        return view('admin/blog/blog_add');
    }

    public function blog_add(AddBlogRequest $request)
    {
        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            $image = time() . '_' . $request->file('image')->getClientOriginalName();
            $data['image'] = $image;
        }
        try {
            $new_blog = new Blog();
            $new_blog->title = $data['title'];
            $new_blog->image = $data['image'];
            $new_blog->description = $data['description'];
            $new_blog->content = $data['content'];
            $new_blog->save();
            if (!is_dir(public_path('/admin/blog/' . $new_blog->id))) {
                mkdir(public_path('/admin/blog/' . $new_blog->id));
            }
            if ($request->hasFile('image')) {
                $request->file('image')->move(public_path('/admin/blog/' . $new_blog->id), $image);
            }
            return redirect('/admin/blog_list')->with('success', __('Thêm thành công'));
        } catch (Exception $th) {
            return redirect('/admin/blog_list')->withErrors('Thêm thất bại');
        }
    }

    public function blog_update_form($blog_id)
    {
        $blog = Blog::findOrFail($blog_id);
        return view('admin/blog/blog_update', compact('blog'));
    }

    public function blog_update(UpdateBlogRequest $request, $blog_id)
    {
        $old_blog = Blog::findOrFail($blog_id);
        $old_image = $old_blog->image ?? '';
        $data = $request->except(['image']);
        if($request->hasFile('image'))
        {
            $new_image = time().'_'.$request->file('image')->getClientOriginalName();
            $data['image'] = $new_image;
        }
        if($old_blog->update($data))
        {
            if($request->hasFile('image'))
            {
                if($old_image != '' && file_exists(public_path('admin/blog/'.$blog_id.'/'.$old_image)))
                {
                    unlink(public_path('admin/blog/'.$blog_id.'/'.$old_image));
                }
                $request->file('image')->move(public_path('admin/blog/'.$blog_id), $new_image);
            }
            return redirect('/admin/blog_list')->with('success', __('Cập nhật thành công'));
        }
        else
        {
            return redirect('/admin/blog_list')->withErrors('Cập nhật thất bại');
        }
    }

    public function blog_delete($blog_id)
    {
        if(Blog::where('id',$blog_id)->delete())
        {
            if(is_dir(public_path('admin/blog/'.$blog_id)))
            {
                File::deleteDirectory(public_path('admin/blog/'.$blog_id));
            }
            return redirect('/admin/blog_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('/admin/blog_list')->withErrors('Xóa thất bại');
        }
    }
}
