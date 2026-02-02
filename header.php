<?php
class NavItem {
    public $href;
    public $text;

    public function __construct($href, $text) {
        $this->href = $href;
        $this->text = $text;
    }

    public function render() {
        return "<li class='nav-item'><a href='{$this->href}' class='nav-link'>{$this->text}</a></li>";
    }
}

$navItems = [
    new NavItem('index.php', 'Home'),
    new NavItem('about.php', 'About us'),
    new NavItem('menu.php', 'Menu'),
    new NavItem('feedback.php', 'Feedback'),
    new NavItem('gallery.php', 'Gallery'),
    new NavItem('login.php', 'Log in')
];
?>

<header>
    <nav class="navbar section-content">
        <a href="#" class="nav-logo">
            <h2 class="logo-text">Burger House</h2>
        </a>
        <ul class="nav-menu">
            <button aria-label="Close menu" id="menu-close-button" class="fas fa-times"></button>
            <?php
            foreach ($navItems as $item) {
                echo $item->render();
            }
            ?>
        </ul>
        <button aria-label="Open menu" id="menu-open-button" class="fas fa-bars"></button>
    </nav>
</header>
