<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold mb-4">Relatório de Ganhos</h2>

                    <div class="flex justify-center mb-6">
                        <!-- Canvas para o gráfico -->
                        <canvas id="graficoPagamentos" width="400" height="200"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        // Dados do gráfico (Exemplo de ganhos e pagamentos)
                        const ctx = document.getElementById('graficoPagamentos').getContext('2d');
                        const graficoPagamentos = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
                                datasets: [{
                                        label: 'Ganhos',
                                        data: [1200, 1900, 3000, 500, 2000],
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Pagamentos',
                                        data: [800, 1200, 1500, 300, 1200],
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>

                    <h2 class="text-xl font-bold mt-8 mb-4">Gerenciamento de Informações</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Seção Dívidas -->
                        <div class="w-full">
                            @if($dividas->isEmpty())
                            <p>Você não possui dívidas cadastradas.</p>
                            @else
                            <div class="overflow-x-auto max-w-full">
                                <table class="min-w-full bg-white table-auto border-separate border-spacing-2">
                                    <thead>
                                        <tr>
                                            <th class="py-4 px-6 text-left text-sm font-semibold">Cliente</th>
                                            <th class="py-4 px-6 text-left text-sm font-semibold">Valor (R$)</th>
                                            <th class="py-4 px-6 text-left text-sm font-semibold">Data de Vencimento</th>
                                            <th class="py-4 px-6 text-left text-sm font-semibold">Status</th>
                                            <th class="py-4 px-6 text-center text-sm font-semibold">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dividas as $divida)
                                        <tr class="border-b hover:bg-gray-100">
                                            <td class="py-4 px-6 text-sm">{{ $divida->user->name }}</td>
                                            <td class="py-4 px-6 text-sm">{{ number_format($divida->valor, 2, ',', '.') }}</td>
                                            <td class="py-4 px-6 text-sm">{{ \Carbon\Carbon::parse($divida->vencimento)->format('d/m/Y') }}</td>
                                            <td class="py-4 px-6 text-sm">
                                                <div class="flex items-center space-x-2">
                                                    @if ($divida->status === 'pago')
                                                    <span class="text-green-500 font-semibold text-xs sm:text-sm">Pago</span>
                                                    @else
                                                    <span class="text-red-500 font-semibold text-xs sm:text-sm">Pendente</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <form action="{{ route('divida.arquivar', $divida) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <x-secondary-button class="px-4 py-2">
                                                        {{ __('Arquivar') }}
                                                    </x-secondary-button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            <!-- Seção Contratos -->
                            <div class="w-full">
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold">Contratos em Aberto</h3>
                                    <div class="bg-white p-4 mt-2 shadow-lg rounded-lg">
                                        <p class="font-semibold">Contrato: Teodozio</p>
                                        <p>Status da assinatura: <span class="text-red-500 font-semibold">Pendente</span></p>
                                    </div>
                                    <div class="bg-white p-4 mt-2 shadow-lg rounded-lg">
                                        <p class="font-semibold">Contrato: Leonardo</p>
                                        <p>Status da assinatura: <span class="text-red-500 font-semibold">Pendente</span></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>