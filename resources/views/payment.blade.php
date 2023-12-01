<div class=" !z-10">
    <div class="py-5">
        <div wire:loading class="fixed inset-0 bg-gray-100 inline-block-center bg-opacity-80 overflow-none">
            <div class="flex items-center justify-center w-full h-full mx-auto">
                <div
                    class="w-20 h-20 ease-linear border-2 border-t-8 border-gray-300 rounded-full ml-3/6 mt-2/6 loader">
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4">
            <section class="mb-32 text-gray-800">
                <h2 class="text-3xl font-bold text-center mb-6">Monthly Pricing</h2>

                <p class="text-center mb-4 text-gray-500">
                    {{ __('Select a subscription that works for your Company.') }}
                </p>
                <div class="mx-auto max-w-md pb-12">
                    <label class="w-full flex justify-center pb-4 text-center text-gray-700 text-sm font-semibold">
                        Number of Months
                    </label>
                    <div class="flex justify-center flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                        <div class="flex items-center">
                            <a href="#" class="w-16 font-bold h-full flex items-center border border-black justify-center text-xl bg-primary" wire:click="decrement">-</a>
                            <input type="text" disabled class="w-16 text-center font-bold" wire:model="quantity"/>
                            <a href="#" class="w-16 font-bold h-full flex items-center border border-black justify-center text-xl bg-primary" wire:click="increment">+</a>
                        </div>
                    </div>
                </div>

                <div class="grid lg:grid-cols-4 gap-4 xl:gap-x-4">
                    @foreach(\App\Enums\PlanEnum::cases() as $index=>$plan)
                        <x-plan :plan=$plan :index=$index :quantity=$quantity></x-plan>
                    @endforeach
                </div>
            </section>
        </div>
        <style>
            .loader {
                border-top-color: #6366F1;
                -webkit-animation: spinner 1.5s linear infinite;
                animation: spinner 1.5s linear infinite;
            }
            @-webkit-keyframes spinner {
                0% {
                    -webkit-transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                }
            }
            @keyframes spinner {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

        </style>
    </div>
