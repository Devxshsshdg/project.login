<?php 
session_start();
// cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .dashboard-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(255, 105, 180, 0.2);
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            border: 1px solid rgba(255, 182, 193, 0.3);
        }

        .dashboard-header {
            background: linear-gradient(135deg, #ff6b9d 0%, #ff99cc 100%);
            color: white;
            padding: 35px 30px;
            text-align: center;
            position: relative;
        }

        .user-avatar {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 4px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
        }

        .user-avatar i {
            font-size: 40px;
        }

        .waving-hand {
            position: absolute;
            top: 35px;
            right: 35px;
            font-size: 28px;
            animation: wave 2s infinite;
            transform-origin: 70% 70%;
        }

        @keyframes wave {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            30% { transform: rotate(14deg); }
            40% { transform: rotate(-4deg); }
            50% { transform: rotate(10deg); }
            60% { transform: rotate(0deg); }
            100% { transform: rotate(0deg); }
        }

        .dashboard-header h1 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .greeting {
            font-size: 20px;
            opacity: 0.95;
            margin-bottom: 5px;
        }

        .dashboard-header p {
            opacity: 0.9;
            font-size: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 8px;
        }

        .dashboard-content {
            padding: 35px 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 35px;
        }

        .info-card {
            background: linear-gradient(135deg, #fff5f7 0%, #ffeef2 100%);
            padding: 20px;
            border-radius: 18px;
            text-align: center;
            border: 2px solid #ffe4ec;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #ff6b9d 0%, #ff99cc 100%);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 107, 157, 0.15);
        }

        .info-card i {
            font-size: 24px;
            color: #ff6b9d;
            margin-bottom: 12px;
            background: rgba(255, 107, 157, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .info-card .label {
            font-size: 13px;
            color: #ff6b9d;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .info-card .value {
            font-size: 18px;
            font-weight: 600;
            color: #d63384;
        }

        .stats-section {
            background: linear-gradient(135deg, #fff5f7 0%, #ffeef2 100%);
            padding: 25px;
            border-radius: 18px;
            margin-bottom: 30px;
            border: 2px solid #ffe4ec;
        }

        .stats-section h3 {
            color: #d63384;
            font-size: 18px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ffe4ec;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-label {
            color: #ff6b9d;
            font-size: 14px;
        }

        .stat-value {
            color: #d63384;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b9d 0%, #ff99cc 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(255, 107, 157, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 107, 157, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #ff6b9d;
            border: 2px solid #ffe4ec;
            box-shadow: 0 3px 10px rgba(255, 107, 157, 0.1);
        }

        .btn-secondary:hover {
            background: #fff5f7;
            transform: translateY(-3px);
        }

        .logout-btn {
            background: linear-gradient(135deg, #ff4757 0%, #ff6b7a 100%);
            color: white;
            width: 100%;
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 71, 87, 0.4);
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <div class="dashboard-header">
            <div class="waving-hand">
                <i class="fas fa-hand-wave"></i>
            </div>
            <div class="user-avatar">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h1>
                <span>Hai Dina🖐</span>
            </h1>
            <div class="greeting">Selamat datang</div>
            <p><?php echo htmlspecialchars($_SESSION['role']); ?></p>
        </div>

        <div class="dashboard-content">
            <div class="info-grid">
                <div class="info-card">
                    <i class="fas fa-book-open"></i>
                    <div class="label">Mata Kuliah</div>
                    <div class="value">6 Aktif</div>
                </div>
                <div class="info-card">
                    <i class="fas fa-tasks"></i>
                    <div class="label">Tugas</div>
                    <div class="value">4 Baru</div>
                </div>
                <div class="info-card">
                    <i class="fas fa-calendar-check"></i>
                    <div class="label">Kehadiran</div>
                    <div class="value">95%</div>
                </div>
                <div class="info-card">
                    <i class="fas fa-star"></i>
                    <div class="label">IPK</div>
                    <div class="value">3.82</div>
                </div>
            </div>


                

            <div class="action-buttons">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-graduation-cap"></i> Kelas Saya
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-bell"></i> Notifikasi
                </a>
            </div>

            <a href="logout.php" class="btn logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <script>
        // Tambahkan efek interaktif tambahan
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.info-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.background = 'linear-gradient(135deg, #ffebef 0%, #ffe4ec 100%)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.background = 'linear-gradient(135deg, #fff5f7 0%, #ffeef2 100%)';
                });
            });
        });
    </script>
</body>
</html>