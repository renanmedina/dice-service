<div style="min-width: 220px">
    <div class="grid grid-rows-4 grid-cols-1 items-center">
        <div class="mb-5 text-center">
            <h3 class="text-white text-4xl text-center">{{count($dices)}}xd{{$dices->getFaces()}}</h3>
        </div>

        <div class="flex flex-row justify-center gap-{{count($dices)}} text-white mb-3">
            @foreach ($dices as $dice)
                <div class="flex text-white w-10 h-10 bg-blue-500 text-center rounded items-center justify-center">
                    {{ $dice->getResult() }}
                </div>

                @if ($loop->index != count($dices)-1)
                    <span wire:if="" class="flex font-bold text-2lg text-center items-center">+</span>
                @endif
            @endforeach
        </div>

        <div class="flex-none border-t-2 pt-3 border-red-500">
            <h5 class="text-white text-lg">Total: {{$dices->totalResult()}}</h3>
        </div>

        <button type="button" class="flex-none bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" wire:click="roll">Relançar</button>
    </div>

    <div>
        @if (!empty($results_history))
            <div class="h-80 overflow-y-auto text-white pr-4">
                <span class="text-lg mb-5">Histórico de resultados: </span>
                @foreach ($results_history as $historyItem)
                <div class="block mb-4">
                    {{ $historyItem->readableTime() }}
                    <span class="block">
                        {{ $historyItem->dice_pattern }}: {{ $historyItem->total_result }} ({{ $historyItem->dicesValuesSumString() }})
                    </span>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
