<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{   
    public function dashboard(){
        return view('dashboard.index');
    }

    public function blog(){
        $entry = DB::table('blog')->get();

        return view('dashboard.blog', compact('entry'));
    }

    public function createblog(){
        return view('dashboard.create.blogcreate');
    }
    
    public function blogstore(Request $request){
        
        $request->validate([
            'title' => 'required|unique:blog',
            'category' => 'required',
            'creator' => 'required',
        ],
        [
            'title.required' => 'Title is required',
            'title.unique' => 'Title is already used',
            'category.required' => 'Entry category is required',
            'creator.email' => 'Entry creator is required',
        ]);

        DB::table('blog')->insert([
            'title' => $request->title,
            'category' => $request->category,
            'creator' => $request->creator,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.blog');
    }

    public function blogedit($id){
        $member = DB::table('blog')->find($id);
        $title = 'Blog Edit';

        return view('dashboard.update.blogupdate', compact('member', 'title'));
    }

    public function blogupdate(Request $request, $id){
        $member = DB::table('blog')->find($id);

        $request->validate([
            'title' => 'required|unique:blog',
            'category' => 'required',
            'creator' => 'required',
        ],
        [
            'title.required' => 'Title is required',
            'title.unique' => 'Title is already used',
            'category.required' => 'Entry category is required',
            'creator.email' => 'Entry creator is required',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'creator' => $request->creator,
            'updated_at' => now(),
        ];

        DB::table('blog')->where('id', $id)->update($data);

        return redirect()->route('dashboard.blog');
    }

    public function blogdelete($id){
        DB::table('blog')->where('id', $id)->delete();

        return redirect()->route('dashboard.blog');
    }

    public function user(){
        $user = DB::table('appuser')->get();

        return view('dashboard.user', compact('user'));
    }

    public function createuser(){
        return view('dashboard.create.usercreate');
    }

    public function userstore(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is invalid',
            'email.unique' => 'Email is already used',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'password_confirmation.required' => 'Password confirmation is required',
            'image.required' => 'Image is required',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be JPEG, PNG, JPG, GIF, or WEBP',
            'image.max' => 'Maximum image size is 16MB'
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/'), $imageName);

        DB::table('appuser')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.user');
    }

    public function useredit($id){
        $member = DB::table('appuser')->find($id);
        $title = 'User Edit';

        return view('dashboard.update.userupdate', compact('member', 'title'));
    }

    public function userupdate(Request $request, $id){
        $member = DB::table('appuser')->find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:appuser,email,' . $id,
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is invalid',
            'email.unique' => 'Email is already used',
            'password.confirmed' => 'Password does not match',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be JPEG, PNG, JPG, GIF, or WEBP',
            'image.max' => 'Maximum image size is 16MB'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/'), $imageName);
            $data['image'] = $imageName;
        }

        DB::table('appuser')->where('id', $id)->update($data);

        return redirect()->route('dashboard.user');
    }

    public function userdelete($id){
        DB::table('appuser')->where('id', $id)->delete();

        return redirect()->route('dashboard.user');
    }
}
