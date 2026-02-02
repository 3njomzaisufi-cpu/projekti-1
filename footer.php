<?php
class Footer {
    public $year;
    public function __construct($year = null) {
        $this->year = $year ?? date('Y');
    }

    public function render() {
        return "
        <footer>
            <p style='text-align:center; padding:15px; background:#f3961c; color:#252525;'>&copy; {$this->year} Burger House</p>
        </footer>
        <script>
            document.getElementById('menu-open-button').addEventListener('click', function(){
                document.querySelector('.nav-menu').style.left = '0';
            });
            document.getElementById('menu-close-button').addEventListener('click', function(){
                document.querySelector('.nav-menu').style.left = '-300px';
            });
        </script>
        </body>
        </html>
        ";
    }
}

$footer = new Footer(2026);
echo $footer->render();
