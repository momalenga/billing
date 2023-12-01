@props(['plan', 'index','quantity'=>1,'showButton'=>true])
<div class="mb-4 lg:mb-0">
    <div class="block rounded-lg shadow-lg bg-white {{ $index==1 ? 'border-2 border-primary':'' }} h-full">
        <div class="p-6 border-b border-gray-300 text-center">
            <div class="text-primary font-black text-2xl">
                {{$plan->value}}
            </div>
            <p class="uppercase my-8 text-sm">
                <strong>{{ $plan->tagline() }}</strong>
            </p>
            <h3 class="text-2xl mb-2 mt-4">
                <strong>@money($plan->price()*$quantity)</strong>
            </h3>
            @if($showButton)
                <x-jet-button>
                    <a href="#" wire:click='buy("{{ $plan->value }}")'> {{__('Buy Now')}} </a>
                </x-jet-button>
            @endif
        </div>
        <div class="p-6">
            <ol class="list-inside">
                @foreach($plan->features() as $feature)
                    <li class="mb-4 flex items-center">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                             class="text-green-600 w-4 h-4 mr-2" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                            </path>
                        </svg>{{$feature}}
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
