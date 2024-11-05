<?php
// Lógica e consultas
require_once '../config/database.php';
require_once '../helpers/DashboardHelper.php';

$dashboardData = DashboardHelper::getStatistics();
$recentBookings = DashboardHelper::getRecentBookings();
$popularServices = DashboardHelper::getPopularServices();
?>

<!-- Template HTML -->
<div class="dashboard-container">
    <?php include '../includes/dashboard/statistics.php'; ?>
    <?php include '../includes/dashboard/recent-bookings.php'; ?>
    <?php include '../includes/dashboard/popular-services.php'; ?>
</div>

<!-- Scripts específicos da página -->
<script src="assets/js/dashboard.js"></script> 