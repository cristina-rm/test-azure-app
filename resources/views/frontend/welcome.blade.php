<x-guest-layout>
    @section('template_title')
        {{ __('Home') }}
    @endsection

    <div class="w-full">
        @include('frontend.includes.navigation')
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-wrap my-4 pl-3">
{{--                <h3 class="font-normal uppercase">Home page</h3>--}}
            </div>

             <div class="bg-white overflow-hidden shadow-md sm:rounded-md p-6">
                 <h4 class="font-normal text-primary">Frontend content</h4>
             </div>
        </div>
    </div>
</x-guest-layout>
