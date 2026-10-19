<?php
class SignupController extends Controller
{
    private SignupService $signupService;
    private AuthService $authService;
    private CloudinaryService $cloudinaryService;
    private RecaptchaService $recaptchaService;
    private NavigationService $navigationService;
    public function __construct()
    {
        $this->signupService = new SignupService();
        $this->authService = new AuthService();
        $this->cloudinaryService = new CloudinaryService();
        $this->recaptchaService = new RecaptchaService();
        $this->navigationService = new NavigationService();
    }
    public function signupForm()
    {
        CsrfService::check();
        $name = $_POST['name'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $bio = $_POST['bio'] ?? '';
        $token = $_POST['g-recaptcha-response'] ?? '';

        if (empty($name) || empty($username) || empty($email) || empty($_POST['password'])) {
            return;
        }

        if (!$this->recaptchaService->verify($token)) {
            header('Location: /signup');
            exit;
        }

        $image = $_FILES['image'] ?? null;
        $image_url = null;

        if ($image && ($image['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            if (($image['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
                header('Location: /signup');
                exit;
            }

            $mime = mime_content_type($image['tmp_name']);
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];

            if (!in_array($mime, $allowed, true)) {
                header('Location: /signup');
                exit;
            }

            $image_url = $this->cloudinaryService->upload($image['tmp_name']);
        }

        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $created = $this->authService->signup(
            $name,
            $username,
            $email,
            $password_hash,
            $bio,
            $image_url
        );

        header('Location: ' . ($created ? '/profile' : '/signup'));
        exit;
    }

    public function signup()
    {
        $navItems = $this->navigationService->getHeaderItems('signup');
        $this->view('signup', compact('navItems'));
    }
}
