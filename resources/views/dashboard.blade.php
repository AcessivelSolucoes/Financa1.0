<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold mb-4">
                        @if(auth()->user()->role == 'user')
                        Suas Dívidas
                        @else
                        Dívidas Cadastradas
                        @endif
                    </h2>

                    @if(auth()->user()->role == 'user')
                    <!-- Exibe as dívidas se o usuário for "user" -->
                    @if($dividas->isEmpty())
                    <p>Você não possui dívidas cadastradas.</p>
                    @else
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-4">Valor (R$)</th>
                                <th class="py-4">Data de Vencimento</th>
                                <th class="py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dividas as $divida)
                            <tr class="border-b">
                                <td class="py-2">{{ number_format($divida->valor, 2, ',', '.') }}</td>
                                <td class="py-2">{{ \Carbon\Carbon::parse($divida->vencimento)->format('d/m/Y') }}</td>
                                <td class="py-2">
                                    @if ($divida->status === 'pago')
                                    <span class="text-green-500 font-semibold">Pago</span>
                                    @else
                                    <span class="text-red-500 font-semibold">Pendente</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 flex">
                        <x-primary-button>
                            {{ __('Pagar') }}
                        </x-primary-button>
                    </div>
                    @endif
                    @else
                    <!-- Exibe para admins que não há dívidas ativas -->
                    <p>Você não possui dívidas ativas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>