<?php
namespace redcat\Engines;

class View {
    /**
     * @var false|string
     */
    private $html;
    /**
     * @var Tokenizer
     */
    /**
     * @var string
     */
    private $template;

    public function __construct()
    {

    }

    public function render($template): void
    {
        ob_start();
        include './Views/header.php';
        include './Views/' . $template . '.php';
        include './Views/footer.php';
        $contents = ob_get_clean();
        echo $contents;
        die();
    }

    public function redirectBack()
    {
        header("Location: /index.php");
        die();
    }
}