<?php

require './confi.php';
session_start();


if (isset($_SESSION['UserSession'])) {
    if (isset($_POST['addtocart'])) {

        if (isset($_SESSION['cart'])) {
            $productids = array_column($_SESSION['cart'], 'pid');
            if (in_array($_POST['hiddid'], $productids)) {
                echo '<script>alert("Item already added");window.location.' . $_SESSION['pagestate'] . ';</script>';
            } else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array(
                    'pid' => $_POST['hiddid'],
                    'pname' => $_POST['hiddname'],
                    'pimage' => $_POST['hiddimage'],
                    'qty' => $_POST['hiddqty'],
                    'category' => $_POST['hiddcate'],
                    'price' => $_POST['hiddprice']
                );
                echo '<script>alert("Item added");window.location.' . $_SESSION['pagestate'] . ';</script>';
            }
        } else {
            $_SESSION['cart'][0] = array(
                'pid' => $_POST['hiddid'],
                'pname' => $_POST['hiddname'],
                'pimage' => $_POST['hiddimage'],
                'qty' => $_POST['hiddqty'],
                'category' => $_POST['hiddcate'],
                'price' => $_POST['hiddprice']
            );
            echo '<script>alert("Item added");window.location.' . $_SESSION['pagestate'] . ';</script>';
            // print_r($_SESSION['cart']);
        }
    }
    if (isset($_POST['del'])){
        foreach($_SESSION['cart'] as $k => $v){
            if($v['pid']==$_POST['hidid']){
                unset($_SESSION['cart'][$k]);
                $_SESSION['cart']=array_values($_SESSION['cart']);
                echo "<script>alert('Item Removed');window.location.href='cart.php';</script>";    
            }
        }
    }
    if (isset($_POST['add'])){

        foreach($_SESSION['cart'] as $k => $v){
            if($v['pid']==$_POST['hidid']){
                if($_SESSION['cart'][$k]['qty']<5){
                $_SESSION['cart'][$k]['qty']+=1;
                echo "<script>window.location.href='cart.php';</script>";
            }
            else{
                echo "<script>alert('you have selected maximum quantity');window.location.href='cart.php';</script>";
            }
                    
            }
        }
    }
    if (isset($_POST['sub'])){

        foreach($_SESSION['cart'] as $k => $v){
            if($v['pid']==$_POST['hidid']){
                if($_SESSION['cart'][$k]['qty']>1){
                $_SESSION['cart'][$k]['qty']-=1; 
                echo "<script>window.location.href='cart.php';</script>";
                }
                else{
                    echo "<script>alert('Minimum quantity is 1');window.location.href='cart.php';</script>"; 
                }
            }
        }
    }
} else {
    echo "<script>alert('Firstly you have to login');window.location.href='login.php';</script>";
}
