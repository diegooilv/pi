<?php

class MaterialService
{
    private MaterialModel $materialModel;
    private UserModel $userModel;
    private CloudinaryService $cloudinaryService;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        $this->userModel = new UserModel();
        $this->cloudinaryService = new CloudinaryService();
    }

    public function createMaterial(int $authorId, array $data, ?array $imageFile = null)
    {
        $imageUrl = $this->uploadImage($imageFile);
        return $this->materialModel->create(
            trim($data['title']),
            trim($data['description']),
            $imageUrl,
            $data['type'],
            trim($data['url']),
            $authorId,
            (int) $data['category_id']
        );
    }

    public function getMaterialById(int $id)
    {
        return $this->materialModel->findById($id);
    }

    public function getMaterials(int $limit = 10, int $offset = 0): array
    {
        $views = [];
        foreach ($this->materialModel->findMaterials($limit, $offset) as $material) {
            $views[] = new MaterialViewModel($material, $this->userModel->findById($material['author_id']));
        }
        return $views;
    }

    public function getNumberOfMaterials(): int
    {
        return $this->materialModel->count();
    }

    public function getMaterialsByAuthorId(int $authorId, int $limit = 100, int $offset = 0): array
    {
        return $this->materialModel->findByAuthor($authorId, $limit, $offset);
    }

    public function updateMaterial(int $id, array $data, ?array $imageFile = null): bool
    {
        $material = $this->getMaterialById($id);
        if (!$material) {
            throw new Exception('Material not found');
        }
        $imageUrl = $this->uploadImage($imageFile) ?? $material['image'];
        return $this->materialModel->edit($id, [
            'title' => trim($data['title']),
            'description' => trim($data['description']),
            'image' => $imageUrl,
            'type' => $data['type'],
            'url' => trim($data['url']),
            'category_id' => (int) $data['category_id'],
        ]);
    }

    private function uploadImage(?array $file): ?string
    {
        if ($file && ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
            return $this->cloudinaryService->upload($file['tmp_name']);
        }
        return null;
    }
}
