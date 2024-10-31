<x-layout :resources="['resources/css/reset.css', 'resources/css/app.css',
        'resources/js/post.js']" :isCanvasOn="false">
    <x-admin-header/>
    <x-post-form :isCreateForm="true"/>  
    <div class="projects"> 
        <div class="sec-content">
            <div class="tiles-container">
                @foreach($posts as $post)
                    <x-post-card :post="$post" :isEditMode="true"/>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>