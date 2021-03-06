<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fotolito extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Fotolito_m');
        $this->load->model('Impressao_formato_m');
        empty($_SESSION) ? session_start() : '';
        login_necessario();
    }

    public function index() {
        $data['fotolito'] = $this->Fotolito_m->listar();
        $this->load->view('fotolito/lista', $data);
    }

    public function form() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $impressao_formato_lista = $this->Impressao_formato_m->listar();
            $data['acao'] = 'inserir';
            $data['impressao_formato'] = $impressao_formato_lista;
            $this->load->view('fotolito/form', $data);
        } else {
            $fotolito = $this->Fotolito_m->listar($id);
            $impressao_formato_lista = $this->Impressao_formato_m->listar();

            $data['fotolito'] = $fotolito[0];
            $data['impressao_formato'] = $impressao_formato_lista;
            $data['acao'] = 'editar';
            $data['id'] = $id;

            $this->load->view('fotolito/form', $data);
        }
    }

    public function inserir() {
        $fotolito = new Fotolito_m();
        $fotolito->id = null;
        $fotolito->impressao_formato = $this->input->post('impressao_formato');
        $fotolito->descricao = $this->input->post('descricao');
        $fotolito->valor = $this->input->post('valor');

        $this->form_validation->set_message('is_unique', 'Esta área já está cadastrada no sistema');
        $this->form_validation->set_rules('impressao_formato', 'Impressão formato', 'trim|required|is_unique[fotolito.impressao_formato]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->Fotolito_m->inserir($fotolito);
            if (!empty($id)) {
                redirect(base_url('fotolito/?type=sucesso'), 'location');
            } else {
                redirect(base_url('fotolito/?type=erro'), 'location');
            }
        } else {
            $impressao_formato_lista = $this->Impressao_formato_m->listar();
            $data['acao'] = 'inserir';
            $data['impressao_formato'] = $impressao_formato_lista;
            $this->load->view('fotolito/form', $data);
        }
    }

    public function editar() {
        $fotolito = new Fotolito_m();
        $fotolito->id = $this->input->post('id');
        $fotolito->impressao_formato = $this->input->post('impressao_formato');
        $fotolito->descricao = $this->input->post('descricao');
        $fotolito->valor = $this->input->post('valor');

        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('impressao_formato', 'Impressão formato', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if ($this->Fotolito_m->editar($fotolito)) {
                redirect(base_url('fotolito/?type=sucesso'), 'location');
            } else {
                redirect(base_url('fotolito/?type=erro'), 'location');
            }
        } else {
            $impressao_formato_lista = $this->Impressao_formato_m->listar();
            $data['acao'] = 'inserir';
            $data['impressao_formato'] = $impressao_formato_lista;
            $this->load->view("fotolito/form", $data);
        }
    }

    public function deletar() {
        $id = $this->uri->segment(3);

        if ($this->Fotolito_m->deletar($id)) {
            redirect(base_url('fotolito/?type=sucesso'), 'location');
        } else {
            redirect(base_url('fotolito/?type=erro'), 'location');
        }
    }

}
