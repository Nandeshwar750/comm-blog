@include('layouts.app')

@section('content')
    
<body class="bg-gray-100">
        <main class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-4">Welcome to My Simple Blog</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                        <p class="text-gray-600">{{ Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p>&copy; 2023 My Simple Blog. All rights reserved.</p>
                </div>
                <div>
                    <a href="#" class="hover:text-gray-300 mx-3">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-300 mx-3">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>