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
                            type: 'bar', // Tipo de gráfico (bar, line, etc)
                            data: {
                                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'], // Mês ou período
                                datasets: [{
                                        label: 'Ganhos',
                                        data: [1200, 1900, 3000, 500, 2000], // Valores de ganhos
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Cor de fundo
                                        borderColor: 'rgba(75, 192, 192, 1)', // Cor da borda
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Pagamentos',
                                        data: [800, 1200, 1500, 300, 1200], // Valores de pagamentos
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Cor de fundo
                                        borderColor: 'rgba(255, 99, 132, 1)', // Cor da borda
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>