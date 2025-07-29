<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;

class AppController extends Controller
{   
    public function dashboard(){
        return view('dashboard.index');
    }

    public function blog(){
        $blog = Blog::orderBy('id', 'asc')->get();

        return view('dashboard.blog', compact('blog'));
    }

    public function createblog(){
        $category = Category::all();
        $user = User::all();

        return view('dashboard.create.blogcreate', compact('category', 'user'));
    }
    
    public function blogstore(Request $request){
        
        $request->validate([
            'title' => 'required|string|max:255|unique:blog',
            'description' => 'required|string',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'creator_id' => ['required', Rule::exists('users', 'id')],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
        ],
        [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max:255' => 'Maximum title length is 255 characters',
            'title.unique' => 'Title is already used',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Selected category is invalid',
            'creator_id.required' => 'Creator is required',
            'creator_id.exists' => 'Selected creator is invalid',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be JPEG, PNG, JPG, GIF, or WEBP',
            'image.max' => 'Maximum image size is 16MB',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/'), $imageName);
            $data['image'] = $imageName;
        } else {
            $imageName = 'Laravellogo.png';
        }

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'creator_id' => $request->creator_id,
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.blog');
    }

    public function blogedit(Blog $blog){
        $category = Category::all();
        $user = User::all();
        $title = 'Blog Edit';

        return view('dashboard.update.blogupdate', compact('blog', 'category', 'title', 'user',));
    }

    public function blogupdate(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('blog')->ignore($blog->id)],
            'description' => 'required|string',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'creator_id' => ['required', Rule::exists('users', 'id')],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
        ], [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max:255' => 'Maximum title length is 255 characters',
            'title.unique' => 'Title is already used',
            'description.required' => 'Description is required',
            'category_id.required' => 'Category is required',
            'creator_id.required' => 'Creator is required',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be JPEG, PNG, JPG, GIF, or WEBP',
            'image.max' => 'Maximum image size is 16MB',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'creator_id' => $request->creator_id,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/'), $imageName);

            $data['image'] = $imageName;
        }

        $blog->update($data);

        return redirect()->route('dashboard.blog');
    }


    public function blogdelete(Blog $blog){
        $blog->delete();

        return redirect()->route('dashboard.blog');
    }

    public function user(){
        $user = User::orderBy('id', 'asc')->get();

        return view('dashboard.user', compact('user'));
    }

    public function createuser(){
        $user = User::all();

        return view('dashboard.create.usercreate', compact('user'));
    }

    public function userstore(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is invalid',
            'email.unique' => 'Email is already used',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'password_confirmation.required' => 'Password confirmation is required',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be JPEG, PNG, JPG, GIF, or WEBP',
            'image.max' => 'Maximum image size is 16MB',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/'), $imageName);
            $data['image'] = $imageName;
        } else {
            $imageName = 'Laravellogo.png';
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.user');
    }

    public function useredit(User $user){
        $title = 'User Edit';

        return view('dashboard.update.userupdate', compact('user', 'title'));
    }

    public function userupdate(Request $request, User $user){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
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
            'image.max' => 'Maximum image size is 16MB',
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
        } else {
            $data['image'] = $user->image;
        }
        

        $user->update($data);

        return redirect()->route('dashboard.user');
    }

    public function userdelete(User $user){
        $user->delete();

        return redirect()->route('dashboard.user');
    }

    public function category(){
        $category = Category::orderBy('id', 'asc')->get();

        return view('dashboard.category', compact('category'));
    }

    public function createcategory(){
        $category = Category::all();

        return view('dashboard.create.categorycreate', compact('category'));
    }

    public function categorystore(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ],
        [
            'name.required' => 'Title is required',
            'name.string' => 'Title must be a string',
            'name.max:255' => 'Maximum title length is 255 characters',
            'name.unique' => 'Title is already used',
        ]);

        Category::create([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.category');
    }

    public function categoryedit(Category $category){
        $title = 'Category Edit';

        return view('dashboard.update.categoryupdate', compact('category', 'title'));
    }

    public function categoryupdate(Request $request, Category $category){
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ],
        [
            'name.required' => 'Title is required',
            'name.string' => 'Title must be a string',
            'name.max:255' => 'Maximum title length is 255 characters',
            'name.unique' => 'Title is already used',
        ]);

        $category->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.category');
    }

    public function categorydelete(Category $category){
        $category->delete();

        return redirect()->route('dashboard.category');
    }
}
