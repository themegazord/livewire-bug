<form wire:submit="validaDados" class="form-cadastro-endereco">
    <div class="container-form-input-endereco">
        <label for="cadastro-endereco-cep">Insira seu CEP:</label>
        <input type="text" name="cadastro-endereco-cep" id="cadastro-endereco-cep" wire:model.live="endereco.cep">
    </div>
    <div class="container-form-input-endereco">
        <div class="sub-container-form-input-endereco">
            <label for="cadastro-endereco-rua">Rua:</label>
            <input type="text" name="cadastro-endereco-rua" id="cadastro-endereco-rua" wire:model.live="endereco.rua" disabled>
        </div>
        <div class="sub-container-form-input-endereco">
            <label for="cadastro-endereco-numero">Nº:</label>
            <input type="text" name="cadastro-endereco-numero" id="cadastro-endereco-numero" wire:model.live="endereco.numero">
        </div>
    </div>
    <div class="container-form-input-endereco">
        <label for="cadastro-endereco-complemento">Complemento:</label>
        <input type="text" name="cadastro-endereco-complemento" id="cadastro-endereco-complemento" wire:model.live="endereco.complemento">
    </div>
    <div class="container-form-input-endereco">
        <div class="sub-container-form-input-endereco">
            <label for="cadastro-endereco-bairro">Bairro:</label>
            <input type="text" name="cadastro-endereco-bairro" id="cadastro-endereco-bairro" wire:model.live="endereco.bairro" disabled>
        </div>
        <div class="sub-container-form-input-endereco">
            <label for="cadastro-endereco-zona-distrito">Zona/Distrito</label>
            <input type="text" name="cadastro-endereco-zona-distrito" id="cadastro-endereco-zona-distrito" wire:model.live="endereco.zona_distrito">
        </div>
    </div>
    <div class="container-form-input-endereco">
        <div class="sub-container-form-input-endereco">
            <label for="cadastro-endereco-cidade">Cidade:</label>
            <input type="text" name="cadastro-endereco-cidade" id="cadastro-endereco-cidade" wire:model.live="endereco.cidade" disabled>
        </div>
        <div class="sub-container-form-input-endereco">
            <label for="cadastro-endereco-uf">UF:</label>
            <input type="text" name="cadastro-endereco-uf" id="cadastro-endereco-uf" wire:model.live="endereco.up" disabled>
        </div>
    </div>
    <div class="container-botoes-cadastro-endereco">
        <button type="submit">SALVAR ENDEREÇO<i class="fa-regular fa-circle-check"></i></button>
        <button type="button">VOLTAR</button>
    </div>
</form>
@script
<script>
    // Mascara CEP
    $('#cadastro-endereco-cep').mask('00.000-000');
    // function limpa campos

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('cadastro-endereco-rua').value = ('')
        document.getElementById('cadastro-endereco-bairro').value = ('')
        document.getElementById('cadastro-endereco-cidade').value = ('')
        document.getElementById('cadastro-endereco-uf').value = ('')
    }


    // Defina a função de callback globalmente
    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('cadastro-endereco-rua').value = (conteudo.logradouro);
            document.getElementById('cadastro-endereco-bairro').value = (conteudo.bairro);
            document.getElementById('cadastro-endereco-cidade').value = (conteudo.localidade);
            document.getElementById('cadastro-endereco-uf').value = (conteudo.uf);
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado");
        }
    }

    document.getElementById('cadastro-endereco-cep').addEventListener('blur', function() {
        const cepLimpo = document.getElementById('cadastro-endereco-cep').value.replace(/\D/g, '');
        if (cepLimpo != "") {
            const validaCep = /^[0-9]{8}$/;
            if (validaCep.test(cepLimpo)) {
                document.getElementById('cadastro-endereco-rua').value = '...';
                document.getElementById('cadastro-endereco-bairro').value = '...';
                document.getElementById('cadastro-endereco-cidade').value = '...';
                document.getElementById('cadastro-endereco-uf').value = '...';

                // Adicione o callback ao escopo global para que seja acessível
                window.meu_callback = meu_callback;

                let script = document.createElement('script');
                script.src = 'https://viacep.com.br/ws/' + cepLimpo + '/json/?callback=meu_callback';

                document.body.appendChild(script);
            } else {
                // CEP é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            // CEP sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
</script>
@endscript
