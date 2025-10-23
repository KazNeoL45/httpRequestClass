<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Search by ID</h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div>
               <p>
                Order search by ID
               </p>     
            </div>
                <form action="{{ route('http-requests.search') }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-1">
                        <input
                            type="number"
                            name="id"
                            placeholder="Enter ID"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                            min="1"
                        >
                        @error('id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold transition"
                    >
                        Search
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <div>
               <p>
                Get client count
               </p>     
            </div>
                <form action="{{ route('http-requests.getClientCount') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="bg-purple-600 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition"
                    >
                        Get Client Count
                    </button>
                </form>
            </div>

                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <div>
               <p>
                get order status by ID
               </p>     
            </div>
                <form action="{{ route('http-requests.getStatus') }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-1">
                        <input
                            type="number"
                            name="id"
                            placeholder="Enter ID"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                            min="1"
                        >
                        @error('id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold transition"
                    >
                        Search
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Results</h2>

                @if($requests->count() > 0)
                    <div class="space-y-4">
                        @foreach($requests as $request)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">{{ $request->created_at->format('Y-m-d H:i:s') }}</p>
                                        <p class="text-blue-600 break-all">{{ $request->url }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $request->status_code >= 200 && $request->status_code < 300 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        Status: {{ $request->status_code }}
                                    </span>
                                </div>
                                <details class="mt-2">
                                    <summary class="cursor-pointer text-blue-500 hover:text-blue-700">View Response</summary>
                                    <pre class="mt-2 p-4 bg-gray-50 rounded overflow-x-auto text-sm">{{ Str::limit($request->response_body, 1000) }}</pre>
                                </details>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No results yet. Enter an ID to search!</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
