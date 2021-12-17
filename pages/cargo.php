<?php require_once dirname(__DIR__).'/components/header.php'; ?>
    
    
    <table class="table crud">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
                use App\Model\CargoDAO;
                $cargoDao = new CargoDAO();
            ?>
            <?php foreach ($cargoDao->read() as $cargo): ?>
            <tr>
                <td><?= $cargo['id'] ?></td>
                <td><?= $cargo['nome'] ?></td>
                <td><?= $cargo['descricao'] ?></td>
                <td><i class="bi bi-pencil-square" id_aux="<?= $cargo['id'] ?>"></i></td>
                <td><i class="bi bi-trash-fill" id_aux="<?= $cargo['id'] ?>"></i></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cadastrar">Cadastrar Cargo</button>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="editar">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="container">
                    <h1 class="display-5">Cargo</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="hidden" id="id-edit" value="">
                        <input type="text" id="nome-edit" class="form-control" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" id="descricao-edit" class="form-control" value="" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="editar()">Editar</button>
                    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="cadastrar">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="container">
                    <h1 class="display-5">Cargo</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" id="descricao" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="inserir()">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="excluir">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="p-text"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="btn-excluir" value=""/>
                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Excluir</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        function inserir()
        {
            const type = "cargo";
            const nome = $("#nome").val();
            const desc = $("#descricao").val();
            const obj = {
                type, nome, desc
            };
            $.ajax({
                url: '<?= SITE_URL ?>pages/ajax/inserir.php',
                type: 'POST',
                data: obj,
                beforeSend: function(){
                    $(".btn.btn-primary").prop('disabled', true).text("Cadastrando...");
                },
                success: function(result){
                    alert(result.msg);
                    $(".btn.btn-primary").prop('disabled', false).text("Cadastrar");
                },
                dataType: 'json'
            });
        }

        function editar()
        {
            const type = "cargo";
            const id = $("#id-edit").val();
            const nome = $("#nome-edit").val();
            const desc = $("#descricao-edit").val();
            const obj = {
                type, nome, desc, id
            };
            $.ajax({
                url: '<?= SITE_URL ?>pages/ajax/editar.php',
                type: 'POST',
                data: obj,
                beforeSend: function(){
                    $(".btn.btn-primary").prop('disabled', true).text("Editando...");
                },
                success: function(result){
                    if(result.error){
                        alert(result.msg_error);
                    }else{
                        alert(result.msg);
                    }
                    window.location.reload();
                },
                dataType: 'json'
            });
            
        }

        function excluir(id, type)
        {
            const obj = {
                id, type
            };
            $.ajax({
                url: '<?= SITE_URL ?>pages/ajax/excluir.php',
                type: 'POST',
                data: obj,
                beforeSend: function(){
                    $(".btn.btn-danger").prop('disabled', true).text("Excluindo...");
                },
                success: function(result){
                    setTimeout(function() {
                        $('#excluir').hide();
                        if(result.error){
                            alert(result.msg_error);
                        }else{
                            alert(result.msg);
                        }
                    }, 3000);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                },
                dataType: 'json'
            });
            
        }

        $('.btn.btn-danger').on('click', function(){
            const type = 'cargo';
            const id_aux = $('#btn-excluir').val();
            excluir(id_aux, type);
        });

        $('.bi.bi-trash-fill').on('click', function(){
            const id_aux = $(this).attr('id_aux');
            $('#btn-excluir').val(id_aux);
            document.getElementById('p-text').innerHTML = "Deseja excluir o id " + id_aux + "?";
            $('#excluir').show();
        });

        $('.bi.bi-pencil-square').on('click', function(){
            const id_aux = $(this).attr('id_aux');
            const type = 'cargo';
            const obj = {
                id_aux, type
            };
            $.ajax({
                url: '<?= SITE_URL ?>pages/ajax/carregar-edit.php',
                type: 'POST',
                data: obj,
                success: function(result){
                    $('#id-edit').val(result[0].id);
                    $('#nome-edit').val(result[0].nome);
                    $('#descricao-edit').val(result[0].descricao);
                },
                dataType: 'json'
            });
            $('#editar').show();
            
        });

        $('.btn-close').on('click', function(){
            $('#excluir').hide();
            $('#editar').hide();
            
        });

        $('.close').on('click', function(){
            $('#excluir').hide();
            $('#editar').hide();
        });
    </script>

<?php require_once dirname(__DIR__).'/components/footer.php'; ?>