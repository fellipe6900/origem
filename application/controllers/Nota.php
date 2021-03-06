<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Nota_m');
        empty($_SESSION) ? session_start() : '';
        login_necessario();
    }

    public function index() {
        $data['nota'] = $this->Nota_m->listar();
        $this->load->view('Nota/lista', $data);
    }

    public function form() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $data['acao'] = 'inserir';

            $this->load->view('nota/form', $data);
        } else {
            $nota = $this->Nota_m->listar($id);

            $data['nota'] = $nota[0];
            $data['acao'] = 'editar';
            $data['id'] = $id;

            $this->load->view('nota/form', $data);
        }
    }

    public function inserir() {
        $nota = new Nota_m();
        $nota->id = null;
        $nota->nome = $this->input->post('nome');
        $nota->descricao = $this->input->post('descricao');
        $nota->valor = $this->input->post('valor');

        $id = $this->Nota_m->inserir($nota);
        if (!empty($id)) {
            redirect(base_url('nota/?type=sucesso'), 'location');
        } else {
            redirect(base_url('nota/?type=erro'), 'location');
        }
    }

    public function editar() {
        $nota = new Nota_m();
        $nota->id = $this->input->post('id');
        ;
        $nota->nome = $this->input->post('nome');
        $nota->descricao = $this->input->post('descricao');
        $nota->valor = $this->input->post('valor');

        if ($this->Nota_m->editar($nota)) {
            redirect(base_url('nota/?type=sucesso'), 'location');
        } else {
            redirect(base_url('nota/?type=erro'), 'location');
        }
    }

    public function deletar() {
        $id = $this->uri->segment(3);

        if ($this->Nota_m->deletar($id)) {
            redirect(base_url('nota/?type=sucesso'), 'location');
        } else {
            redirect(base_url('nota/?type=erro'), 'location');
        }
    }

}
