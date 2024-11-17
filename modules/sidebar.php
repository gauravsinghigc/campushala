<?php
//admin sidebar
define("ADMIN_SIDEBAR_MENUS", [
  "menu1" => [
    "name" => "Dashboard",
    "icon" => "bi bi-grid",
    "url" => DOMAIN . "/app",
    "id" => "dashbaord"
  ],
  "menu2" => [
    "name" => "Students",
    "icon" => "bx bxs-user",
    "url" => DOMAIN . "/app/students",
    "id" => "students"
  ],
  "menu3" => [
    "name" => "Universities",
    "icon" => "bx bxs-school",
    "url" => DOMAIN . "/app/universities",
    "id" => "universities"
  ],
  "menu4" => [
    "name" => "BDE's",
    "icon" => "bx bxs-user",
    "url" => DOMAIN . "/app/users",
    "id" => "bdes"
  ],
  "menu10" => [
    "name" => "Registrations",
    "icon" => "bx bx-refresh",
    "url" => DOMAIN . "/app/registrations",
    "id" => "txn"
  ],
  "menu5" => [
    "name" => "Fees",
    "icon" => "bx bx-money",
    "url" => DOMAIN . "/app/fees",
    "id" => "txn"
  ],
  "menu6" => [
    'name' => "Invoices",
    "icon" => "bx bxs-file",
    "url" => DOMAIN . "/app/invoices",
    "id" => "invoices"
  ],
  "menu7" => [
    'name' => "App Configuration",
    "icon" => "ri ri-home-gear-fill",
    "url" => DOMAIN . "/app/configs",
    "id" => "config"
  ],
  "menu11" => [
    'name' => "Reports",
    "icon" => "ri ri-file-chart-fill",
    "url" => DOMAIN . "/app/reports",
    "id" => "reports"
  ],
  "menu8" => [
    "name" => "Profile",
    "icon" => "bx bx-user",
    "url" => DOMAIN . "/app/profile",
    "id" => "profile"
  ],
  "menu9" => [
    "name" => "Log Out",
    "icon" => "bx bx-log-out",
    "url" => DOMAIN . "/logout.php",
    "id" => "logout"
  ]
]);
