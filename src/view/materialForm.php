<?php
$isEdit = isset($material);
$values = array_merge($material ?? [], $old ?? []);
$action = $isEdit ? '/material/' . (int) $material['id'] . '/edit' : '/material/create';
?>
<div class="post">
    <div class="post-content">
        <h2 class="post-title"><?= $isEdit ? 'Editar material' : 'Adicionar material' ?></h2>
        <?php if (!empty($errors)): ?>
            <div class="create-post__errors">
                <ul>
                        <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form id="materialForm" class="create-post__form" action="<?= $action ?>" method="POST"
            enctype="multipart/form-data" novalidate>
            <input type="hidden" name="csrf" value="<?= CsrfService::token() ?>">
            <div class="post-field"><label for="title">Título</label><input id="title" name="title" maxlength="255"
                    required value="<?= htmlspecialchars($values['title'] ?? '') ?>"></div>
            <div class="post-field"><label for="description">Descrição</label><textarea id="description"
                    name="description" rows="10"
                    required><?= htmlspecialchars($values['description'] ?? '') ?></textarea></div>
            <div class="post-field"><label for="type">Tipo</label><select id="type" name="type" required>
                    <option value="" disabled <?= empty($values['type']) ? 'selected' : '' ?>>Selecione um tipo</option>
                        <?php foreach (['pdf' => 'PDF', 'link' => 'Link', 'book' => 'Livro'] as $value => $label): ?>
                        <option value="<?= $value ?>" <?= ($values['type'] ?? '') === $value ? 'selected' : '' ?>><?= $label ?>
                        </option><?php endforeach; ?>
                </select></div>
            <div class="post-field"><label for="url">Link do material</label><input type="url" id="url" name="url"
                    maxlength="500" required placeholder="https://..."
                    value="<?= htmlspecialchars($values['url'] ?? '') ?>"></div>
            <div class="post-field"><label for="image">Imagem de capa</label>
                <div class="post-image-wrapper"><input type="file" id="image" name="image" accept="image/*"><img
                        class="post-preview" id="preview" src="<?= htmlspecialchars($material['image'] ?? '') ?>"
                        alt="Prévia da imagem"></div>
            </div>
            <div class="post-field"><label for="category_id">Categoria</label><select id="category_id"
                    name="category_id" required>
                    <option value="" disabled <?= empty($values['category_id']) ? 'selected' : '' ?>>Selecione uma
                        categoria</option>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= (string) ($values['category_id'] ?? '') === (string) $category['id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                    
                    <?php endforeach; ?>
                </select></div>
            <button type="submit" id="materialSubmitBtn"
                class="post-submit"><?= $isEdit ? 'Salvar alterações' : 'Publicar material' ?></button>
        </form>
    </div>
</div>