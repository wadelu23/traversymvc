# Traversy MVC
### MVC 初識
##### 依照Udemy課程[Object Oriented PHP & MVC](https://www.udemy.com/course/object-oriented-php-mvc/) 初識MVC部分，簡單頁面與初步流程

* MVC架構大致是將程式碼分類成 Model, Controller, View
  * Model 所有跟資料庫有關的動作、演算法邏輯等
    * 位於 /app/models/，如/app/models/Post.php
  * View 要顯示什麼樣的畫面
    * 位於 /app/views/ ，後續可細分，如 views/pages/index.php 或 views/inc/header.php
  * Controller 會依據情形使用Model去資料庫查資料、流程控制、利用View來顯示什麼樣的畫面
    * 位於 /app/controllers/，如/app/controllers/Pages.php

#### 此範例簡略流程解說
##### 1. 藉由網址判斷使用哪一個Controller與method，位於/app/libraries/Core.php
  * 主頁預設是使用 /controllers/Pages.php 裡的 index()
    * `protected $currenController = 'Pages';`
    * `protected $currenMethod = 'index';`
    * 實體化 Pages 這個Controller
    * 呼叫 Pages 裡的 index()
##### 2. Pages (Controller) 流程，/app/controllers/Pages.php
  * 建構式裡先設定好要用什麼Model
  * 在 index() 裡利用Model，去資料庫拿資料
  * 將資料傳給哪一個 View
  * ```php
    class Pages extends Controller{
        public function __construct(){
            $this->postModel = $this->model('Post');
        }
        public function index(){
            $posts = $this->postModel->getPosts();
            $data = [
                'title' => 'welcome'
                ,'posts' => $posts
            ];

            $this->view('pages/index', $data);
        }
    }
    ```
##### 3. View /views/pages/index.php
  * 在該頁面將接收的資料呈現
  * ```php
    <h1><?php echo $data['title']; ?></h1>

    <ul>
        <?php foreach($data['posts'] as $post) : ?>
            <li><?php echo $post->title; ?></li>
        <?php endforeach; ?>
    </ul>
    ```
