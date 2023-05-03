<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Paylasim;
use App\Models\PaylasimPhoto;
use App\Models\PaylasimTranslation;
use App\Models\SiteLanguage;
use App\Models\User;
use DateTime;
use Google\Service\Iam\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('posts index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $posts = Paylasim::all();
        return view('backend.posts.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('posts create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.posts.create');
    }

    public function store(Request $request)
    {

        abort_if(Gate::denies('posts create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $langCodes = SiteLanguage::where('status', 1)->get();
        $paylasim = new Paylasim();
        if ($request->hasFile('photo')) {
            $paylasim->photo = upload('posts/'.date('dmY'), $request->file('photo'));
        }
        $paylasim->category_id = $request->category;
        $paylasim->user_id = auth()->user()->id;
        if (Auth::user()->hasDirectPermission('confirm-post')) {
            $paylasim->admin_status = 1;
            $paylasim->admin_id = Auth::user()->id;
        } else {
            $paylasim->admin_status = 0;
            $paylasim->admin_id = 0;
        }
        $paylasim->status = 1;
        $paylasim->view_count = 0;
        $paylasim->save();
        foreach ($langCodes as $lc) {
            $trans = new PaylasimTranslation();
            $trans->title = $request->title[$lc->code];
            $trans->content = $request->content1[$lc->code];
            $trans->description = $request->meta_description[$lc->code];
            $trans->keywords = $request->meta_keywords[$lc->code];
            $trans->locale = $lc->code;
            $trans->paylasim_id = $paylasim->id;
            $trans->save();
        }
        if (!Auth::user()->hasDirectPermission('confirm-post')) {
            $admins = User::all();
            foreach ($admins as $admin) {
                if ($admin->hasDirectPermission('confirm-post')) {
                    $data = [
                        'admin_name' => $admin->name,
                        'writer_name' => Auth::user()->name,
                        'post_id' => $paylasim->id,
                    ];
                    Mail::send('backend.mail.index', $data, function ($message) use ($admin) {
                        $message->to($admin->email);
                        $message->subject('Yeni paylaşım var!');
                    });
                }
            }
        }
        alert()->success(__('messages.success'));
        return redirect()->route('backend.posts.index');
    }

    public function delPost($id)
    {
        abort_if(Gate::denies('posts delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Paylasim::find($id)->photo);
            Paylasim::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function pendingPost()
    {
        abort_if(Gate::denies('confirm-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pendingPosts = Paylasim::where('admin_status', 0)->get();
        return view('backend.posts.pendings', get_defined_vars());
    }

    public function pendingPostId($id)
    {
        abort_if(Gate::denies('confirm-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pendingPost = Paylasim::find($id);
        if ($pendingPost->admin_status != 0) {
            return redirect()->route('backend.pendingPost');
        }
        return view('backend.posts.confirm', get_defined_vars());
    }

    public function ppost($id)
    {
        abort_if(Gate::denies('confirm-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $post = Paylasim::find($id);
        $releatedPosts = Paylasim::where('category_id',$post->category_id)->take(4)->where('id','!=',$post->id)->orderBy('created_at','desc')->get();
        return view('frontend.posts.index', get_defined_vars());
    }

    public function approvePost($id)
    {
        abort_if(Gate::denies('confirm-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Paylasim::find($id)->update([
                'admin_status' => 1,
                'admin_id' => Auth::user()->id
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('backend.posts.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.posts.index');
        }
    }

    public function update(Request $request, Paylasim $post)
    {
        abort_if(Gate::denies('posts edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $post) {
                if ($request->hasFile('photo')) {
                    $post->photo = upload('posts/'.date('dmY'), $request->file('photo'));
                }
                if (Auth::user()->hasDirectPermission('confirm-post')) {
                    $post->admin_status = 1;
                } else {
                    $post->admin_status = 0;
                }
                $post->category_id = $request->category;
                foreach (active_langs() as $lang) {
                    $post->translate($lang->code)->title = $request->title[$lang->code];
                    $post->translate($lang->code)->content = $request->content1[$lang->code];
                    $post->translate($lang->code)->keywords = $request->meta_keywords[$lang->code];
                    $post->translate($lang->code)->description = $request->meta_description[$lang->code];
                }
                $post->save();
            });
            if (!Auth::user()->hasDirectPermission('confirm-post')) {
                $admins = User::all();
                foreach ($admins as $admin) {
                    if ($admin->hasDirectPermission('confirm-post')) {
                        $data = [
                            'admin_name' => $admin->name,
                            'writer_name' => Auth::user()->name,
                            'post_id' => $post->id,
                        ];
                        Mail::send('backend.mail.change', $data, function ($message) use ($admin) {
                            $message->to($admin->email);
                            $message->subject('Yeni dəyişiklik var!');
                        });
                    }
                }
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.posts.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.posts.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('posts edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $post = Paylasim::find($id);
        return view('backend.posts.edit', get_defined_vars());
    }

    public function postStatus($id)
    {
        abort_if(Gate::denies('posts edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = Paylasim::where('id', $id)->value('status');
        if ($status == 1) {
            Paylasim::where('id', $id)->update(['status' => 0]);
        } else {
            Paylasim::where('id', $id)->update(['status' => 1]);
        }
        alert()->success(__('messages.success'));
        return redirect()->route('backend.posts.edit', $id);
    }
}
