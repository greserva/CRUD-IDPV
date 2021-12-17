<?php require_once dirname(__DIR__).'/components/header.php'; ?>

    <table class="table crud">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    use App\Model\UsuarioDAO;
                    use App\Model\DepartamentoDAO;
                    use App\Model\CargoDao;
                    $cargo = new CargoDao();
                    $departamento = new DepartamentoDAO();
                    $usuarioDao = new UsuarioDAO();
                    
                ?>
                <?php foreach ($usuarioDao->read() as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nome'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= $usuario['data_de_nascimento'] ?></td>
                    <td><?= $usuario['cpf'] ?></td>
                    <td><?= $usuario['nome_cargo'] ?></td>
                    <td><?= $usuario['nome_departamento'] ?></td>
                    <td><i class="bi bi-pencil-square" id_aux="<?= $usuario['id'] ?>"></i></td>
                    <td><i class="bi bi-trash-fill" id_aux="<?= $usuario['id'] ?>"></i></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cadastrar">Cadastrar Usuário</button>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="cadastrar">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="container">
                    <h1 class="display-5">Usuário</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" id="data_de_nascimento" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" class="form-control" required maxlength="14">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" id="senha" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select class="form-select cargo" aria-label="Default select example" required>
                            <option selected disabled>Selecione o cargo</option>
                            <?php foreach ($cargo->read() as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-select departamento" aria-label="Default select example" required>
                            <option selected disabled>Selecione o departamento</option>
                            <?php foreach ($departamento->read() as $d): ?>
                                <option value="<?= $d['id'] ?>"><?= $d['nome'] ?></option>
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
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="container">
                    <h1 class="display-5">Usuario</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="hidden" id="id-edit" value="">
                        <input type="text" id="nome-edit" class="form-control" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email-edit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" id="data_de_nascimento-edit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf-edit" class="form-control" required maxlength="14">
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select class="form-select cargo" id="cargoid-edit" aria-label="Default select example" required>
                            <option selected disabled>Selecione o cargo</option>
                            <?php foreach ($cargo->read() as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-select departamento" id="departamentoid-edit" aria-label="Default select example" required>
                            <option selected disabled>Selecione o departamento</option>
                            <?php foreach ($departamento->read() as $d): ?>
                                <option value="<?= $d['id'] ?>"><?= $d['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="editar()">Editar</button>
                    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
        });

        function inserir()
        {
            const type = "usuario";
            const nome = $("#nome").val();
            const cargo_id = $(".form-select.cargo").val();
            const departamento_id = $(".form-select.departamento").val();
            const cpf = $("#cpf").val().replace(".", "").replace(".", "").replace("-", "");
            const email = $('#email').val();
            const senha = $('#senha').val();
            const data_de_nascimento = $('#data_de_nascimento').val();
            const obj = {
                type, nome, cpf, email, data_de_nascimento, cargo_id, departamento_id, senha
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
            const type = "usuario";
            const id = $("#id-edit").val();
            const nome = $("#nome-edit").val();
            const email = $("#email-edit").val();
            const data_de_nascimento = $("#data_de_nascimento-edit").val();
            const cpf = $("#cpf-edit").val();
            const cargo_id = $("#cargoid-edit").val();
            const departamento = $("#departamentoid-edit").val();
            const obj = {
                type, nome, email, id, data_de_nascimento, 
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
                    console.log(result);
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
            const type = 'usuario';
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
            const type = 'usuario';
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
                    $('#email-edit').val(result[0].email);
                    $('#data_de_nascimento-edit').val(result[0].data_de_nascimento);
                    $('#cpf-edit').val(result[0].cpf);
                    $('#cargoid-edit').val(result[0].cargo_id);
                    $('#departamentoid-edit').val(result[0].departamento_id);
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