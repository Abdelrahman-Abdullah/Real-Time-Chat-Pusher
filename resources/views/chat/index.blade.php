@props(['users'])
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100">
<div class="flex flex-col items-center mt-4 " >
    <h1 class="text-4xl my-8">
        Users
    </h1>
    <div class=" w-3/6 text-center bg-white ">
        <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="bg-white  dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 {{$loop->last ? '' : 'border-b' }}">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div>
                            <div class="text-base font-semibold">{{$user->name}}</div>
                            <div class="font-normal text-gray-500">{{$user->email}}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if(\Illuminate\Support\Facades\Cache::has('user-online'.$user->id))
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Online
                            @else
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> Offline
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if(\Illuminate\Support\Facades\Cache::has('user-online'.$user->id))
                            <a href="/chat/{{$user->id}}"  class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chat With</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
