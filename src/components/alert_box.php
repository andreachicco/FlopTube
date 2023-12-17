<?php 

    require_once(dirname(__FILE__) . "/component.php");

    interface IAlertBox extends IComponent {} 

    class AlertBox implements IAlertBox {

        private $message;
        private $type;

        public function __construct(string $message, string $type) {
            $this->message = $message;
            $this->type = $type;
        }

        public function render() {
            print("
                <div class=\"alert-box flex items-center justify-between p-2 border border-ft-red rounded-lg mb-5 text-xs font-montserrat sm:text-base text-" . $this->type . "\">
                    <p> " . $this->message . " </p>
                    <button class=\"close-alert-btn\">
                        <i class=\"fa-solid fa-xmark\"></i>
                    </button>
                </div>
            ");
        }
    }
?>