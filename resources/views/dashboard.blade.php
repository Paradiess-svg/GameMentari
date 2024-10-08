<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <p>Level 1 - 1st Grade</p>
                        <a href="{{ route('1stgrade-1') }}" onclick="startGame()">START</a>
                    </div>
                    <div>
                        <p>Level 2 - 2nd Grade</p>
                        <a href="{{ route('2ndgrade-1') }}" onclick="startGame()">START</a>
                    </div>
                    <div>
                        <p>Level 3 - 3rd Grade</p>
                        <a href="{{ route('3rdgrade-1') }}" onclick="startGame()">START</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
