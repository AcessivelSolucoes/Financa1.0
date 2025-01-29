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

                    <!-- O Formulário do Cliente -->
                    <form action="{{ route('usuario.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Nome -->
                            <div>
                                <x-input-label for="name" :value="__('Nome')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- CPF -->
                            <div>
                                <x-input-label for="cpf" :value="__('CPF')" />
                                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf"
                                    :value="old('cpf')" required autocomplete="cpf" />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Telefone  Opcional-->
                        <div class="grid grid-cols-2 gap-4 mt-4">

                            <div>
                                <x-input-label for="telefone" :value="__('Telefone')" />
                                <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone"
                                    :value="old('telefone')" placeholder="Opcional" autocomplete="telefone" />
                                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                            </div>

                            <!-- Celular -->
                            <div>
                                <x-input-label for="celular" :value="__('Celular')" />
                                <x-text-input id="celular" class="block mt-1 w-full" type="text" name="celular"
                                    :value="old('celular')" required autocomplete="celular" />
                                <x-input-error :messages="$errors->get('celular')" class="mt-2" />
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Endereço e CEP -->
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="cep" :value="__('CEP')" />
                                <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep"
                                    :value="old('cep')" required onblur="buscarEnderecoPorCEP(this.value)" />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Endereço')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                    :value="old('address')" required />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Bairro, Localidade, Estado -->
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="bairro" :value="__('Bairro')" />
                                <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro"
                                    :value="old('bairro')" required />
                                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="localidade" :value="__('Localidade')" />
                                <x-text-input id="localidade" class="block mt-1 w-full" type="text" name="localidade"
                                    :value="old('localidade')" required />
                                <x-input-error :messages="$errors->get('localidade')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Informações do veiculo -->
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="placa" :value="__('Placa')" />
                                <x-text-input id="placa" class="block mt-1 w-full" type="text" name="placa"
                                    :value="old('placa')" required />
                                <x-input-error :messages="$errors->get('placa')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="modelo" :value="__('Modelo')" />
                                <x-text-input id="modelo" class="block mt-1 w-full" type="text" name="modelo"
                                    :value="old('modelo')" required />
                                <x-input-error :messages="$errors->get('modelo')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="ano" :value="__('Ano')" />
                                <x-text-input id="ano" class="block mt-1 w-full" type="text" name="ano"
                                    :value="old('ano')" required />
                                <x-input-error :messages="$errors->get('ano')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="cor" :value="__('Cor')" />
                                <x-text-input id="cor" class="block mt-1 w-full" type="text" name="cor"
                                    :value="old('cor')" required />
                                <x-input-error :messages="$errors->get('cor')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Senha')" />
                            <div class="flex items-center gap-4">
                                <!-- Campo de senha -->
                                <x-text-input id="password" class="block mt-1 w-3/4" type="text" name="password"
                                    :value="old('password')" required />

                                <!-- Botão para gerar senha -->
                                <button type="button" onclick="generatePassword()"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2">
                                    {{ __('Gerar Senha') }}
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>


                        <!-- Nível de Acesso (Role) -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Nível de Acesso')" />
                            <select id="role" name="role"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Cadastrar Cliente') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function buscarEnderecoPorCEP(cep) {
            // Remove caracteres não numéricos do CEP
            cep = cep.replace(/\D/g, '');

            // Verifica se o CEP tem 8 dígitos
            if (cep.length !== 8) {
                alert('CEP inválido');
                return;
            }

            // Faz a requisição à API do ViaCEP
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado');
                        return;
                    }

                    // Preenche os campos de endereço com os dados retornados
                    document.getElementById('address').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('localidade').value = data.localidade;
                    // O campo de estado pode ser preenchido com data.uf se necessário
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    alert('Erro ao buscar o CEP');
                });
        }

        function generatePassword() {
            const length = 8; // Tamanho da senha
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // Caracteres possíveis
            let password = "";
            for (let i = 0, n = charset.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * n));
            }
            document.getElementById('password').value = password; // Preenche o campo com a senha gerada
        }
    </script>
</x-app-layout>