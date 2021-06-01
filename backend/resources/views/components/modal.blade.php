<div x-data="{open: false}">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    {{-- モーダルを表示するボタン --}}
    <button type="button" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3" @click="open = true">Lineでログイン</button>
    {{-- 表示されるモーダルウィンドウ --}}
    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open">
        <div class="rounded-lg relative w-1/2 h-1/2  flex items-center justify-center bg-white shadow-xl">
            <button type="button" @click="open = false" class="absolute top-5 right-10">&#x2169;</button>
            {{ $slot }}
        </div>
    </div>
</div>