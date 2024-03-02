<?php

function logoutUser () {
    unset($_SESSION['user']);
    header("Location: connexion");
}