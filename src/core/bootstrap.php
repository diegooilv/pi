<?php

// Vendor
require_once __DIR__ . '/../vendor/autoload.php';

// Config
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/mail.php';
require_once __DIR__ . '/../config/Recaptcha.php';
require_once __DIR__ . '/../config/philosophers.php';

// Core
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';

// Model
require_once __DIR__ . '/../model/CategoryModel.php';
require_once __DIR__ . '/../model/PostModel.php';
require_once __DIR__ . '/../model/PreferenceModel.php';
require_once __DIR__ . '/../model/ResetTokenModel.php';
require_once __DIR__ . '/../model/SessionTokenModel.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/MaterialModel.php';

// ModelView
require_once __DIR__ . '/../viewmodels/PostViewModel.php';
require_once __DIR__ . '/../viewmodels/MaterialViewModel.php';


// Controller
require_once __DIR__ . '/../controller/HomeController.php';
require_once __DIR__ . '/../controller/ErrorController.php';
require_once __DIR__ . '/../controller/ReportController.php';
require_once __DIR__ . '/../controller/SignupController.php';
require_once __DIR__ . '/../controller/LoginController.php';
require_once __DIR__ . '/../controller/AboutController.php';
require_once __DIR__ . '/../controller/ChatBotController.php';
require_once __DIR__ . '/../controller/UserPageController.php';
require_once __DIR__ . '/../controller/Philosophers.php';
require_once __DIR__ . '/../controller/ContactController.php';


// Services
require_once __DIR__ . '/../service/ErrorService.php';
require_once __DIR__ . '/../service/HomeService.php';
require_once __DIR__ . '/../service/ReportService.php';
require_once __DIR__ . '/../service/MailService.php';
require_once __DIR__ . '/../service/AuthService.php';
require_once __DIR__ . '/../service/SignupService.php';
require_once __DIR__ . '/../service/CloudinaryService.php';
require_once __DIR__ . '/../service/LoginService.php';
require_once __DIR__ . '/../service/RecaptchaService.php';
require_once __DIR__ . '/../service/GroqService.php';
require_once __DIR__ . '/../service/RedisService.php';
require_once __DIR__ . '/../service/CsrfService.php';
require_once __DIR__ . '/../service/NavigationService.php';
require_once __DIR__ . '/../service/RateLimitService.php';
require_once __DIR__ . '/../service/UserService.php';
require_once __DIR__ . '/../service/PhilosophersService.php';


// Layouts
require_once __DIR__ . '/../view/layouts/header.php';
require_once __DIR__ . '/../view/layouts/footer.php';
require_once __DIR__ . '/../view/layouts/post.php';
require_once __DIR__ . '/../view/layouts/material.php';
require_once __DIR__ . '/../view/layouts/vlibras.php';

