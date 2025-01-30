<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold mb-4">Enviar Contratos para Usuários</h2>

                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="overflow-x-auto max-w-full">
                        <table class="min-w-full bg-white table-auto border-separate border-spacing-2">
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 text-left text-sm font-semibold">Nome</th>
                                    <th class="py-4 px-6 text-left text-sm font-semibold">E-mail</th>
                                    <th class="py-4 px-6 text-left text-sm font-semibold">Status do Contrato</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="py-4 px-6 text-sm">{{ $user->name }}</td>
                                    <td class="py-4 px-6 text-sm">{{ $user->email }}</td>
                                    <td class="py-4 px-6 text-sm">
                                        @if($user->contract_status == 'signed')
                                        <span class="text-green-500 font-semibold">Assinado</span>
                                        @else
                                        <span class="text-yellow-500 font-semibold">Pendente</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <form action="{{ route('contrato.enviar', $user->id) }}" method="POST">
                                            @csrf
                                            <x-secondary-button class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2">
                                                {{ __('Enviar Contrato') }}
                                            </x-secondary-button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Nenhum usuário disponível.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>