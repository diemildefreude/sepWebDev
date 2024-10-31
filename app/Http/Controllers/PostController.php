<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }
    public function store(Request $request)
    {
        $simpleFields = $request->validate
        ([
            'title' => ['required', 'max:255'],
            'subtitle' => ['required', 'max:255'],
            'live_url' => ['required', 'max:255'],
            'code_url' => ['required', 'max:255'],
        ]);

        $request->validate
        ([
            'tech_stack' => ['nullable', 'json'],
            'features' => ['nullable', 'json'],
            'desktop_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
            'laptop_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
            'tablet_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
            'phone_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
        ]);

        $pathD = storeImage($request, 'desktop_img');
        $pathL = storeImage($request, 'laptop_img');
        $pathT = storeImage($request, 'tablet_img');
        $pathP = storeImage($request, 'phone_img');

        $techStackArray = json_decode($request->input('tech_stack'), true);
        $featuresArray = json_decode($request->input('features'), true);
        $cleanedTech = json_encode(cleanArray($techStackArray));
        $cleanedFeat = json_encode(cleanArray($featuresArray));

        $fields = 
        [ 
            ...$simpleFields, 
            'tech_stack' => $cleanedTech,             
            'features' => $cleanedFeat,
            'desktop_img' => $pathD,
            'laptop_img' => $pathL,
            'tablet_img' => $pathT,
            'phone_img' => $pathP
        ]; 

        Post::create($fields);
        return back()->with('success', 'the post has been added');
    }

    public function update(Request $request, Post $post)
    {
        $simpleFields = $request->validate
        ([
            'title' => ['required', 'max:255'],
            'subtitle' => ['required', 'max:255'],
            'live_url' => ['required', 'max:255'],
            'code_url' => ['required', 'max:255'],
        ]);

        $request->validate
        ([
            'tech_stack' => ['nullable', 'json'],
            'features' => ['nullable', 'json'],
            'desktop_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
            'laptop_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
            'tablet_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
            'phone_img' => ['nullable', 'file', 
                'mimes:webp,jpg,jpeg,png'],
        ]);

        $pathD = storeImage($request, 'desktop_img', $post);
        $pathL = storeImage($request, 'laptop_img', $post);
        $pathT = storeImage($request, 'tablet_img', $post);
        $pathP = storeImage($request, 'phone_img', $post);

        $techStackArray = json_decode($request->input('tech_stack'), true);
        $featuresArray = json_decode($request->input('features'), true);
        $cleanedTech = json_encode(cleanArray($techStackArray));
        $cleanedFeat = json_encode(cleanArray($featuresArray));

        $fields = 
        [ 
            ...$simpleFields, 
            'tech_stack' => $cleanedTech,             
            'features' => $cleanedFeat,
            'desktop_img' => $pathD,
            'laptop_img' => $pathL,
            'tablet_img' => $pathT,
            'phone_img' => $pathP
        ]; 

        $post->update($fields);
        return redirect()->route('dashboard')->with('success', 'post modified');
    } 
    public function destroy(Post $post)
    {

        deleteImage($post->desktop_img);
        deleteImage($post->laptop_img);
        deleteImage($post->phone_img);
        deleteImage($post->tablet_img);
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'post deleted');
    }
}

function deleteImage($path)
{
    if($path)
    {
        Storage::disk('public')->delete($path);
    }
}

function storeImage($request, $field, $post=null)
{
    if($request->hasFile($field))
    {
        if($post && $post[$field])
        {
            Storage::disk('public')->delete($post[$field]);
        }
        return Storage::disk('public')->put('images/uploaded/', $request[$field]);
    }
    if($post)
    {
        return $post[$field];
    }
    return null;
}
function cleanArray($arr)
{
    return array_filter($arr, function ($s)
    {
        return trim($s) !== "";
    });
}