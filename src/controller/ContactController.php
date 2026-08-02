<?php

class ContactController extends Controller
{
    private NavigationService $navigationService;
    private $contact;

    public function __construct()
    {
        $this->navigationService = new NavigationService();
        $this->contact = require __DIR__ . '/../config/contact.php';
    }

    public function index()
    {
        $email = $this->contact['email'];
        $number = $this->contact['number'];
        $navItems = $this->navigationService->getHeaderItems('contact');
        $this->view('contact', compact('navItems', 'email', 'number'));
    }

    public function form()
    {
        $navItems = $this->navigationService->getHeaderItems('contact');
        try {
            $response = [
                'type' => 'success',
                'message' => 'Mensagem enviada com sucesso!'
            ];
        } catch (Error $e) {
            $response = [
                'type' => 'error',
                'message' => 'Não foi possível enviar sua mensagem.'
            ];
        }
        $this->view('contact', compact('navItems', 'response'));
    }
}