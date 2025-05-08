<?php

return [
    '/' => function (): void {
        echo '<h1>Home</h1>';
    },
    '/guest' => function (): void {
        echo '<h1>Hello, guest</h1>';
    },
];
