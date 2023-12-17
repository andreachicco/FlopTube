<?php 
    require_once(dirname(__FILE__) . "/component.php");

    interface IInjectComponent extends IComponent {
        public function set_component(IComponent $component);
    }

    class ComponentRenderer implements IInjectComponent {
        private $component;

        public function set_component(IComponent $component) {
            $this->component = $component;
        }

        public function render() {
            $this->component->render();
        }
    }
?>