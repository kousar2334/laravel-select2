<style>
    .select2-container--classic .select2-selection--single {
        min-height: 42px !important;
        background-color: #fff !important;
        border: 1px solid #d1d5db !important;
    }

    .select2-container--classic .select2-selection--single .select2-selection__clear {
        display: none !important;
    }

    .select2-selection__arrow {
        display: none !important;
    }

    .select2-container--classic .select2-selection--single .select2-selection__rendered {
        color: #444;
        height: 100% !important;
        margin-top: 6px !important;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Add New Product') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                </p>
                            </header>

                            <form method="post" action="#" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="password"
                                        class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->updatePassword->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="category" :value="__('Select Category')" />
                                    <select class="mt-1 block w-full select-category" name="category">
                                        <option>Select Category</option>
                                    </select>
                                    <x-input-error :messages="$errors->updatePassword->get('category')" class="mt-2" />
                                </div>



                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'password-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select-category').select2({
        theme: "classic",
        allowClear: true,
        ajax: {
            url: '{{ route('category.options') }}',
            dataType: 'json',
            method: "GET",
            delay: 250,
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }

    });
</script>
