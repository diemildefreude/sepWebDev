<x-layout :resources="['resources/css/reset.css', 'resources/css/app.css',
        'resources/js/post.js']" :isCanvasOn="false">
    <x-admin-header/>
    <x-post-form :isCreateForm="false" :post="$post"/>  
</x-layout>