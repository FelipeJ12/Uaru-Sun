<div>
    <button 
        wire:click="toggleSeguir" 
        class="px-4 py-2 rounded-lg text-black text-sm font-semibold transition 
               duration-300 ease-in-out 
               {{ $siguiendo ? 'bg-gray-500 hover:bg-gray-600' : 'bg-blue-500 hover:bg-blue-600' }}">
        {{ $siguiendo ? 'Siguiendo' : 'Seguir' }}
    </button>
</div>

