<!DOCTYPE html>
<html lang="pt-br">
    <?php $this->load->view('_include/head', ['titulo' => 'Impressão Cartão']); ?>
    <?php $this->load->view('_include/dataTable', ['controler' => 'impressao_cartao']); ?>
    <body>
        <?php $this->load->view('_include/menu'); ?>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Impressão Cartão</h3>
                </div>
                <div class="panel-body">
                    <?php $this->load->view('_include/mensagem_crud'); ?>
                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-default inserir" href="<?= base_url('impressao_cartao/form') ?>"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3 btn-group">
                            <a id="editar" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                            <a id="deletar" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Deletar</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="hidden">ID</th>
                                        <th>Nome</th>
                                        <th>Formato</th>
                                        <th>Descrição</th>
                                        <th>Valor_100</th>
                                        <th>Valor_500</th>
                                        <th>Valor_1000</th>
                                    </tr>
                                </thead>
                                <tbody id="fbody">
                                    <?php foreach ($impressao_cartao as $key => $value) { ?>
                                        <tr>
                                            <td class="hidden"><?= $value->id ?></td>
                                            <td><?= $value->nome ?></td>
                                            <td><?= $value->impressao_formato->altura . 'x' . $value->impressao_formato->largura ?></td>
                                            <td><?= $value->descricao ?></td>
                                            <td>R$ <?= number_format($value->valor_100, 2, ',', '.') ?></td>
                                            <td>R$ <?= number_format($value->valor_500, 2, ',', '.') ?></td>
                                            <td>R$ <?= number_format($value->valor_1000, 2, ',', '.') ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <ul class="pager" id="">
                                                <?php (!empty($paginacao)) ? print $paginacao : ''; ?>
                                            </ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('_include/footer'); ?>
        </div>
    </body>
</html>
