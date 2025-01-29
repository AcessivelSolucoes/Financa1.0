<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Aumentando o tamanho do formulário -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mx-auto w-full max-w-6xl">
                <!-- max-w-6xl para aumentar o tamanho -->
                <div class="max-w-full mx-auto"> <!-- max-w-full para garantir que ocupe o tamanho total possível -->

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('divida.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Cliente -->
                            <div>
                                <x-input-label for="cliente_id" :value="__('Cliente')" />
                                <select id="cliente_id" name="cliente_id" class="block mt-1 w-full" required>
                                    <option value="">Selecione o Cliente</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('cliente_id')" class="mt-2" />
                            </div>

                            <!-- Valor -->
                            <div>
                                <x-input-label for="valor" :value="__('Valor da Dívida')" />
                                <x-text-input id="valor" class="block mt-1 w-full" type="number" name="valor" required min="0" />
                                <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                            </div>

                            <!-- Vencimento -->
                            <div>
                                <x-input-label for="vencimento" :value="__('Data de Vencimento')" />
                                <x-text-input id="vencimento" class="block mt-1 w-full" type="date" name="vencimento" required />
                                <x-input-error :messages="$errors->get('vencimento')" class="mt-2" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Cadastrar Dívida') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>