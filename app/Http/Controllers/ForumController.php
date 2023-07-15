<?php

namespace App\Http\Controllers;

use Error;
use App\Models\User;
use App\Models\ForumDoc;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use function Deployer\timestamp;
use Illuminate\Cache\RedisStore;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.forum', [
            'title' => 'Forum',
            'title_page' => 'Forum',
            'active' => 'Forum',
            'name' => auth()->user()->name,
            'posts' => ForumPost::with('author')->where('is_delete', '0')->latest('updated_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create-forum', [
            'title' => 'Forum',
            'active' => 'Forum',
            'title_page' => 'Create Post Forum',
            'name' => auth()->user()->name
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required'
        ]);

        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['is_delete'] = '0';

        ForumPost::create($validatedData);

        $lastIdForum = DB::table('forum_posts')
                            ->select('id')
                            ->where('created_by', '=', auth()->user()->id)
                            ->orderByDesc('id')
                            ->limit(1)
                            ->get();

        if($request->dokumens){
            $request->validate([
                'dokumens.*' => 'nullable'
            ]);

            foreach($request->dokumens as $key => $value){
                ForumDoc::create([
                    'file_name' => $value->getClientOriginalName(),
                    'file_path' => $value->store('dokumen-forum'),
                    'forum_id' => $lastIdForum[0]->id
                ]);
            }
        }
    
        return redirect('/dashboard/forum')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ForumPost $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForumPost $forum)
    {
        if($forum->author->id !== auth()->user()->id) {
            abort(403);
       }

       $forum_file = ForumDoc::where('forum_id', $forum->id)->get();

        return view('dashboard.edit-forum', [
            'title' => 'Edit Post',
            'title_page' => 'Forum / My Post / Edit',
            'active' => 'Forum',
            'name' => auth()->user()->name, 
            'forum' => $forum,
            'files' =>$forum_file
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ForumPost $forum)
    {
        $rules = [
            'body' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['created_by'] = auth()->user()->id;

        ForumPost::where('id', $forum->id)
                ->update($validatedData);

        if($request->dokumens){
            $request->validate([
                'dokumens.*' => 'nullable'
            ]);

            foreach($request->dokumens as $key => $value){
                ForumDoc::create([
                    'file_name' => $value->getClientOriginalName(),
                    'file_path' => $value->store('dokumen-forum'),
                    'forum_id' => $forum->id
                ]);
            }
        }
        return redirect('/dashboard/forum')->with('success', 'Post has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ForumPost $forum)
    {
        
        return redirect('/dashboard/forum')->with('success', 'Post has bee Deleted!');
    }

    public function myPost(){
        return view('dashboard.mypost',[
            'title' => 'My Forum Post',
            'title_page' => 'Forum / My Post',
            'active' => 'Forum',
            'name' => auth()->user()->name,
            'posts' => ForumPost::where('created_by', auth()->user()->id)->where('is_delete', '0')->latest('updated_at')->get()
        ]);
    }

    public function deleted($forum){

    //     if($forum->author->id !== auth()->user()->id) {
    //         abort(403);
    //    }

        $postingan = ForumPost::find($forum);
        $postingan['is_delete'] = '1';

        $postingan->update();
        return redirect('/dashboard/forum')->with('success', 'Post has been updated!');
    }

    public function detailPost($id){
        $forum = ForumPost::find($id);
        $forum_file = ForumDoc::where('forum_id', $forum->id)->get();
        
        return view('dashboard.detail-forum',[
            'title' => 'Forum',
            'active' => 'Forum',
            'title_page' => 'Forum / Detail',
            'post' => $forum,
            'files' => $forum_file
        ]);
    }

    public function downloadFile($fileId){
        $file = ForumDoc::find($fileId);
        $path = public_path('storage/' . $file->file_path);
        
        if (file_exists($path)) {
            return response()->download($path, $file->file_name);
        }

        abort(404, 'File not found');
    }

    public function deleteFile($id){
        $file = ForumDoc::findOrFail($id);
        $publicPath = public_path('storage/' . $file->file_path);
        $storagePath = storage_path('app/public/' . $file->file_path);

        if(file_exists($publicPath)){
            unlink($publicPath);
        }
        
        if (Storage::exists($storagePath)) {
            Storage::delete($storagePath);
        }
        $file->delete();

        return redirect()->back()->with('success', 'File Delete Successfully.');
    }

    public function updatePost(Request $request, $forum){
        $rules = [
            'body' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['created_by'] = auth()->user()->id;

        ForumPost::where('id', $forum)
                ->update($validatedData);

        if($request->dokumens){
            $request->validate([
                'dokumens.*' => 'nullable'
            ]);

            foreach($request->dokumens as $key => $value){
                ForumDoc::create([
                    'file_name' => $value->getClientOriginalName(),
                    'file_path' => $value->store('dokumen-forum'),
                    'forum_id' => $forum
                ]);
            }
        }
        return redirect('/dashboard/forum')->with('success', 'Post has been updated!');
    }
}
