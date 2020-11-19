<?php
// select all rubriques for menu
$allMenu = selectAllRubriques($connexion);
// recursive menu
$menu = createMenuMultiBootstrap(0, 0, $allMenu);