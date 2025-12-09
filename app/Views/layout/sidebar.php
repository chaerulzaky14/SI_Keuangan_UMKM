<?php

use App\Controllers\Staff;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-UMKM</title>
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">

  <!-- icon edit dan delete -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- bootstrap v5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


  <!-- table bootsrap admin -->
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="<?= base_url('assets/css/sb-admin-2.min.css') ?>">

  <!-- Custom styles for this page -->
  <link rel="stylesheet" href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>">
  <!-- tutup table bootstrap admin -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    #sidebar {

      width: 250px;
      background-color: #1e3a8a;
      color: white;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease;
      transform: translateX(0);
      z-index: 9999;
    }

    /* Sidebar tertutup */
    #sidebar.closed {
      transform: translateX(-260px);
    }

    .container {
      overflow: scroll;
    }


    /* ini bagian untuk responsive sidebar */
    /* Tombol toggle hanya muncul di HP */
    #toggleSidebar {
      position: fixed;
      display: none;
      background: 1e3a8a;
      border: none;
      color: blue;
      font-size: 28px;
      margin: 10px;
      cursor: pointer;
      z-index: 99999;
      /* paling atas */
    }


    /* HP (mobile) */
    @media (max-width: 768px) {

      #toggleSidebar {
        display: block;
      }

      /* Sidebar default disembunyikan */
      #sidebar {
        position: fixed;
        height: 100vh;
        transform: translateX(-260px);
        z-index: 2000;
      }

      /* Ketika dibuka */
      #sidebar.open {
        transform: translateX(0);
      }
    }


    /* tutup responsive sidebar */


    #sidebar .nav-link {
      color: #cbd5e1;
      padding: 15px 20px;
      display: block;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    #sidebar .nav-link:hover,
    #sidebar .nav-link.active {
      background-color: #3b82f6;
      color: white;
      font-weight: 600;
    }

    #sidebar header {
      font-size: 1.5rem;
      font-weight: bold;
      padding: 1rem 1.25rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      text-align: center;
    }

    #content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 20px;

      background-color: #f1f5f9;
    }

    #navSearch {
      margin: 1rem;
      padding: 0.5rem 0.75rem;
      border-radius: 0.5rem;
      border: none;
      width: calc(100% - 2rem);
      font-size: 1rem;
    }

    footer {
      margin-top: auto;
      padding: 10px;
      font-size: 0.9rem;
      text-align: center;
      opacity: 0.5;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <button class="nav-toggle" id="toggleSidebar">
      ☰
    </button>
    <nav id="sidebar" class="">
      <header>Manajemen Keuangan UMKM </header>

      <ul class="nav-menu" id="nav-menu"></ul>

      <input type="search" id="navSearch" placeholder="Cari menu..." />

      <?php $role = $_SESSION['role'] ?? ''; ?>

      <?php if ($role === 'staff'): ?>

        <a class="nav-link" href="<?= base_url('staff/input_pembelian'); ?>">
          <i class="bi bi-cart-plus"></i> | Input Pembelian
        </a>

        <a class="nav-link" href="<?= base_url('staff/input_penjualan'); ?>">
          <i class="bi bi-cash-stack"></i> | Input Penjualan
        </a>

        <a class="nav-link" href="<?= base_url('transaksi'); ?>">
          <i class="bi bi-receipt"></i> | Transaksi
        </a>

      <?php elseif ($role === 'owner'): ?>

        <a class="nav-link" href="<?= base_url('owner/kelola_menu'); ?>">
          <i class="bi bi-list-ul"></i> | Kelola Menu
        </a>

        <a class="nav-link" href="<?= base_url('owner/laporan_keuangan'); ?>">
          <i class="bi bi-graph-up"></i> | Laporan Keuangan
        </a>

      <?php endif; ?>


      </a>

      <li>
        <a class="nav-link text-danger" id="logoutBtn" href="<?= base_url('logout'); ?>">
          <i class="bi bi-box-arrow-in-left btn btn-danger">| Logout</i>
        </a>
      </li>

      <footer>Logged in as <span id="userInfo"></span></footer>
    </nav>