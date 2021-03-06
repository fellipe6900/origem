<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orcamento extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Impressao_m');
        $this->load->model('Impressao_formato_m');
        $this->load->model('Fotolito_m');
        $this->load->model('Acabamento_m');
        $this->load->model('Acabamento_2_m');
        $this->load->model('Faca_m');
        $this->load->model('Papel_m');
        $this->load->model('Empastamento_m');
//        $this->load->model('Laminacao_m');
        $this->load->model('Colagem_m');
        $this->load->model('Servico_m');
        $this->load->model('Orcamento_m');
        $this->load->helper('html');
        empty($_SESSION) ? session_start() : '';
        login_necessario();
    }

    public function index() {
        $data['lista_orcamento'] = array();
        $data['lista_orcamento'] = $this->Orcamento_m->listar_view();
        $this->load->view('Orcamento/lista', $data);
    }

    public function editar() {
        $id = $this->uri->segment(3);
        $_SESSION['orcamento'] = $this->Orcamento_m->get_orcamento($id);
        redirect(base_url('servico'), 'location');
    }

    public function pdf() {
        $id = $this->uri->segment(3);
        $data['orcamento'] = $this->Orcamento_m->get_orcamento($id);
        $this->load->view('Orcamento/pdf', $data);
    }

    public function status() {
        $id = $this->uri->segment(3);
        $status = $this->input->post('status');
        $retorno = $this->Orcamento_m->set_status($id, $status);
        redirect(base_url('Orcamento'), 'location');
    }

    public function excluir_todos_servicos() {
        unset(
                $_SESSION['papel'], $_SESSION['empastamento'], $_SESSION['impressao'], $_SESSION['acabamento'], $_SESSION['faca'], $_SESSION['servico'], $_SESSION['fotolito'], $_SESSION['acabamento_2'], $_SESSION['colagem']
        );
        redirect(base_url('orcamento'), 'location');
    }

    //intativo
    public function sucesso() {
        $id = $this->uri->segment(3);
        $data['orcamento_id'] = $this->uri->segment(3);
        $data['lista_orcamento'] = $this->Orcamento_m->listar_view();
        $this->load->view('Orcamento/lista', $data);
    }

}
