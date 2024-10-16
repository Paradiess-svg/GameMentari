<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <p class="text-xl font-semibold text-gray-400">Admin</p>
            <p class="text-3xl font-bold text-text">- Leaderboard</p>
            <div class="bg-white shadow-lg rounded-lg mt-10">
                <div class="p-6 text-text">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xl font-semibold">
                                <th>No</th>
                                <th>Name</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th class="text-red-700">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="text-lg text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->score }}</td>
                                    <td class="py-1">
                                        @if ($user->status == 'N')
                                            <span class="text-white bg-red-400 font-bold rounded-full py-1 px-3">Unfinished</span>
                                        @else
                                            <span class="text-white bg-green-400 font-bold rounded-full py-1 px-3">Finished</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('admin.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <form class="absolute bottom-5 right-5" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-button text-white text-2xl font-bold px-6 py-2 rounded-full">Quit</button>
            </form>
        </div>
    </div>
</x-app-layout>
