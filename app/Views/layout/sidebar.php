<?php

use App\Controllers\Staff;
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-UMKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .wrapper {
      display: flex;

      height: 100vh;
      overflow: scroll;
    }
    #sidebar {
      width: 250px;
      background-color: #1e3a8a;
      color: white;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
    }

      /* ini bagian untuk responsive sidebar */
      /* Mobile: sembunyikan sidebar */
@media (max-width: 768px) {
  #sidebar {
    position: fixed;
    left: -250px;
    top: 0;
    height: 100%;
    transition: left 0.3s;
    z-index: 999;
  }
  #sidebar.open {
    left: 0;
  }

  /* Tombol toggle muncul di mobile */
  #mobileToggle {
    display: block;
    background-color: #1e3a8a;
    color: white;
    padding: 10px 15px;
    font-size: 1.2rem;
    cursor: pointer;
  }
}

/* Desktop: tombol toggle disembunyikan */
@media (min-width: 769px) {
  #mobileToggle {
    display: none;
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
    #sidebar .nav-link:hover, #sidebar .nav-link.active {
      background-color: #3b82f6;
      color: white;
      font-weight: 600;
    }
    #sidebar header {
      font-size: 1.5rem;
      font-weight: bold;
      padding: 1rem 1.25rem;
      border-bottom: 1px solid rgba(255,255,255,0.3);
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
  <div id="mobileToggle">☰ Menu</div>

  <div class="wrapper">
    <nav id="sidebar">
      <header>Manajemen Keuangan UMKM  </header>
      <input type="search" id="navSearch" placeholder="Cari menu..." />
      <!-- <a class="nav-link active" data-page="kelola_menu.html">Kelola Menu</a>
      <a class="nav-link" data-page="laporan_keuangan.html">Laporan Keuangan</a> -->
      <a class="nav-link" href="/staff/input_pembelian">Input Pembelian</a>
      <a class="nav-link" href="/staff/input_penjualan" >Input Penjualan</a>
      <a class="nav-link text-danger" id="logoutBtn">Logout</a>
       <footer>Logged in as <span id="userInfo"></span></footer>
    </nav>