<?php 

    require_once(dirname(__FILE__) . "/component.php");

    interface IAlertBox extends IComponent {} 

    class AlertBox implements IAlertBox {

        private string $message;
        private string $color;

        public function __construct(string $message, string $color) {
            $this->message = $message;
            $this->color = $color;
        }

        public function render() {
            $color = $this->color;
            print("
                <div class=\"alert-box flex items-center justify-between p-2 border border-{$color} rounded-lg mb-5 text-xs font-montserrat sm:text-base text-" . $this->color . "\">
                    <p> " . $this->message . " </p>
                    <button class=\"close-alert-btn\">
                        <i class=\"fa-solid fa-xmark\"></i>
                    </button>
                </div>
            ");
        }
    }
?>