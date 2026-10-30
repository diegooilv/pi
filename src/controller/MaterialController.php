<?php

class MaterialController extends Controller
{
    private AuthService $authService;
    private NavigationService $navigationService;
    private MaterialService $materialService;
    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->navigationService = new NavigationService();
        $this->materialService = new MaterialService();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $page = max(0, (int) ($_GET['page'] ?? 0));
        $perPage = 10;
        $totalPages = (int) ceil($this->materialService->getNumberOfMaterials() / $perPage);
        $materials = $this->materialService->getMaterials($perPage, $page * $perPage);
        $navItems = $this->navigationService->getHeaderItems('materials');
        $this->view('materials', compact('navItems', 'materials', 'page', 'totalPages'));
    }

    public function create()
    {
        $this->authService->requireLogin();
        $navItems = $this->navigationService->getHeaderItems('materials');
        $categories = $this->categories();
        $errors = $_SESSION['material_errors'] ?? [];
        $old = $_SESSION['material_old'] ?? [];
        unset($_SESSION['material_errors'], $_SESSION['material_old']);
        $this->view('createMaterial', compact('navItems', 'categories', 'errors', 'old'));
    }

    public function createForm()
    {
        $this->authService->requireLogin();
        CsrfService::check();
        $errors = $this->validate($_POST);
        if ($errors) {
            $_SESSION['material_errors'] = $errors;
            $_SESSION['material_old'] = $_POST;
            header('Location: /material/create');
            exit;
        }
        $id = $this->materialService->createMaterial((int) $_SESSION['auth']['id'], $_POST, $_FILES['image'] ?? null);
        header('Location: /material/' . $id);
        exit;
    }

    public function material($id)
    {
        $material = $this->materialService->getMaterialById((int) $id);
        if (!$material) {
            http_response_code(404);
            $this->view('404');
            return;
        }
        $navItems = $this->navigationService->getHeaderItems('home');
        $this->view('showMaterial', compact('navItems', 'material'));
    }

    public function edit($id)
    {
        $this->authService->requireLogin();
        $material = $this->authorizedMaterial((int) $id);
        if (!$material) return;
        $navItems = $this->navigationService->getHeaderItems('materials');
        $categories = $this->categories();
        $errors = $_SESSION['material_errors'] ?? [];
        $old = $_SESSION['material_old'] ?? [];
        unset($_SESSION['material_errors'], $_SESSION['material_old']);
        $this->view('editMaterial', compact('navItems', 'material', 'categories', 'errors', 'old'));
    }

    public function editForm($id)
    {
        $this->authService->requireLogin();
        CsrfService::check();
        $material = $this->authorizedMaterial((int) $id);
        if (!$material) return;
        $errors = $this->validate($_POST);
        if ($errors) {
            $_SESSION['material_errors'] = $errors;
            $_SESSION['material_old'] = $_POST;
            header('Location: /material/' . (int) $id . '/edit');
            exit;
        }
        $this->materialService->updateMaterial((int) $id, $_POST, $_FILES['image'] ?? null);
        header('Location: /material/' . (int) $id);
        exit;
    }

    private function authorizedMaterial(int $id)
    {
        $material = $this->materialService->getMaterialById($id);
        if (!$material) {
            http_response_code(404);
            $this->view('404');
            return null;
        }
        if ((int) $material['author_id'] !== (int) $_SESSION['auth']['id'] && !$this->authService->isAdmin()) {
            http_response_code(403);
            $this->view('404');
            return null;
        }
        return $material;
    }

    private function validate(array $data): array
    {
        $errors = [];
        if (trim($data['title'] ?? '') === '') $errors[] = 'O título é obrigatório.';
        if (trim($data['description'] ?? '') === '') $errors[] = 'A descrição é obrigatória.';
        if (!in_array($data['type'] ?? '', ['pdf', 'link', 'book'], true)) $errors[] = 'Selecione um tipo válido.';
        if (filter_var(trim($data['url'] ?? ''), FILTER_VALIDATE_URL) === false) $errors[] = 'Informe um link válido para o material.';
        if (empty($data['category_id'])) $errors[] = 'A categoria é obrigatória.';
        $categoryId = filter_var($data['category_id'] ?? null, FILTER_VALIDATE_INT);
        if ($categoryId && !$this->categoryModel->exists((int) $categoryId)) {
            $errors[] = 'A categoria selecionada não existe.';
        }
        return $errors;
    }

    private function categories(): array
    {
        return $this->categoryModel->findAll();
    }
}
