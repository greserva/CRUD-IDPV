<?php require_once dirname(__DIR__).'/components/header.php'; ?>

    <table class="table crud">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Centro de Custo</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
                use App\Model\CentroDeCustoDAO; 
                $centro_de_custo = new CentroDeCustoDAO();
                use App\Model\DepartamentoDAO;
                $departamentoDao = new DepartamentoDAO();
            ?>
            <?php foreach ($departamentoDao->read() as $departamento): ?>
            <tr>
                <td><?= $departamento['id'] ?></td>
                <td><?= $departamento['nome'] ?></td>
                <td><?= $departamento['centro_de_custo_nome'] ?></td>
                <td><i class="bi bi-pencil-square" id_aux="<?= $departamento['id'] ?>"></i></td>
                <td><i class="bi bi-trash-fill" id_aux="<?= $departamento['id'] ?>"></i></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cadastrar">Cadastrar Departamento</button>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="cadastrar">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <h1 class="display-5">Departamento</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="centro_de_custo" class="form-label">Centro de Custo</label>
                    <select class="form-select" aria-label="Default select example" required>
                        <option selected disabled>Selecione seu centro de custo</option>
                        <?php foreach ($centro_de_custo->read() as $centro): ?>
                            <option value="<?= $centro['id'] ?>"><?= $centro['nome'] ?> </option>
                        <?php endforeach; ?>
                    </select>
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

    <div class="modal" tabindex="-1" id="editar">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <h1 class="display-5">Departamento</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="hidden" id="id-edit">
                    <input type="text" id="nome-edit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="centro_de_custo" class="form-label">Centro de Custo</label>
                    <select class="form-select" aria-label="Default select example" required id="centro_de_custoid-edit">
                        <option selected disabled>Selecione seu centro de custo</option>
                        <?php foreach ($centro_de_custo->read() as $centro): ?>
                            <option value="<?= $centro['id'] ?>"><?= $centro['nome'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" onclick="editar()">Editar</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        function inserir(){
            const type = "departamento";
            const nome = $("#nome").val();
            const centro_de_custo_id = $(".form-select").val();
            const obj = {
                type, nome, centro_de_custo_id
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
            const type = "departamento";
            const id = $("#id-edit").val();
            const nome = $("#nome-edit").val();
            const centro_de_custo_id = $("#centro_de_custoid-edit").val();
            const obj = {
                type, nome, centro_de_custo_id, id
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
            const type = 'departamento';
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
            const type = 'departamento';
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
                    $('#centro_de_custoid-edit').val(result[0].centro_de_custo_id);
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