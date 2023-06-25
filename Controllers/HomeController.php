<?php

function showHome(){
    if (isAdmin()) {
        $stats = getSat();
        $rez = [];

        foreach ($stats as  $stat) {
            $rez[$stat['ID']] = $stat;
        }

        View('HomeView', ['stats' => $rez]);
    }else {
        $stats = getSat(getUserAuth()['ID']);
        $rez = [];

        foreach ($stats as  $stat) {
            $rez[$stat['ID']] = $stat;
        }

        View('HomeView', ['stats' => $rez]);
    }
}

function errorNotFound(){
    View('404');
}
