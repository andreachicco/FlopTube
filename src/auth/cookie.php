<?php 
    class Cookie {
        private string $name;
        private string $value;
        private int $expiry_seconds;
        private string $path;
        private string $domain;
        private bool $secure;
        private bool $http_only;

        public function __construct(string $name, string $value, int $expiry_seconds, string $path, string $domain, bool $secure, bool $http_only) {
            $this->name = $name;
            $this->value = $value;
            $this->expiry_seconds = $expiry_seconds;
            $this->path = $path;
            $this->domain = $domain;
            $this->secure = $secure;
            $this->http_only = $http_only;
        }

        public function get_name(): string {
            return $this->name;
        }

        public function get_value(): string {
            return $this->value;
        }

        public function get_expiry_seconds(): int {
            return $this->expiry_seconds;
        }

        public function get_path(): string {
            return $this->path;
        }

        public function get_domain(): string {
            return $this->domain;
        }

        public function get_secure(): bool {
            return $this->secure;
        }

        public function get_http_only(): bool {
            return $this->http_only;
        }
    }
?>