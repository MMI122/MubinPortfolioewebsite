<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Education History</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="styles/all.min.css" />
    <link rel="stylesheet" href="styles/v4-shims.min.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <style>
        /* Background & Overlay (Same as customers.php) */
        .container {
            background-image: url("images/customers.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--trans);
            /* e.g. rgba(0,0,0,0.7) */
            z-index: -1;
        }

        .main-text {
            color: var(--sub) !important;
            font-size: 2.8em;
            font-weight: 700;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        /* Timeline Container */
        .timeline {
            position: relative;
            max-width: 900px;
            width: 100%;
            margin: 60px auto;
            padding: 40px 20px;
            z-index: 2;
            /* Full GIF Background */
            background-image: url('images/colorbackground.gif');
            background-size: cover;
            /* Ensures the GIF covers the entire area */
            background-position: center;
            /* Centers the GIF */
            background-repeat: no-repeat;
            /* Prevents tiling */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
            min-height: 500px;
            /* Ensures height even with few items */
        }

        /* Overlay to improve text readability over animated background */
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(18, 18, 30, 0.35);
            /* Dark tint to enhance contrast */
            z-index: 0;
            pointer-events: none;
            border-radius: 12px;
        }

        /* Timeline Vertical Line */
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: var(--main);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
            border-radius: 3px;
            z-index: 1;
            /* Above overlay, below content */
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        }

        .timeline-item {
            padding: 15px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
            z-index: 2;
            /* Above everything else */
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background-color: var(--sub);
            border: 4px solid var(--main);
            border-radius: 50%;
            top: 18px;
            z-index: 3;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .left::before {
            right: -12px;
        }

        .right::before {
            left: -12px;
        }

        /* Content Box Styling */
        .content {
            padding: 24px;
            background-color: rgba(255, 255, 255, 0.96);
            /* Slight transparency for elegance */
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            border-left: 5px solid var(--main);
            transition: all 0.3s ease;
        }

        .content:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }

        .content h3 {
            margin: 0 0 10px;
            color: #333;
            font-size: 1.4em;
            font-weight: 600;
        }

        .content .institution {
            font-weight: 700;
            color: #d32f2f !important;
            font-size: 1.15em;
            letter-spacing: 0.3px;
            margin: 10px 0 8px;
            display: block;
            opacity: 1 !important;
            filter: none !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .content .institution::before {
            content: "🎓 ";
            color: #c62828 !important;
            font-size: 1.2em;
            vertical-align: middle;
        }

        .content .year {
            font-size: 0.95em;
            color: #007BFF;
            margin: 8px 0;
        }

        .content p {
            color: #555;
            line-height: 1.6;
            margin: 0;
        }

        /* Responsive: Stack on small screens */
        @media (max-width: 768px) {
            .timeline::after {
                left: 30px;
            }

            .timeline::before,
            .timeline::after {
                border-radius: 10px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 20px;
            }

            .left,
            .right {
                left: 0;
            }

            .left::before,
            .right::before {
                left: 12px !important;
                right: auto;
            }

            .content {
                font-size: 0.95em;
            }

            .main-text {
                font-size: 2.2em;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="f-around">
        <div class="logo"></div>
        <nav>
            <a href="index.php">Home</a>
            <a href="services.php">Experience</a>
            <a href="projects.php">Projects</a>
            <!-- <a href="customers.php">Customers</a> -->
            <a href="education.php" id="active">Education</a>
            <!-- <a href="team.php">Team</a> -->
            <a href="practice/index.php">projects</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="icons">
            <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-telegram"></i></a>
        </div>
        <div class="BTNSIDER" id="BTNSIDER"></div>
    </header>

    <!-- Background Header with Title -->
    <div class="container f-center">
        <h2 class="main-text">Education History</h2>
    </div>

    <!-- Timeline Section -->
    <div class="timeline">
        <?php
        include "conni.php"; // Make sure this file exists and connects

        $counter = 0;
        $query = "SELECT * FROM education_timeline ORDER BY order_num, year DESC";
        $result = mysqli_query($con_mysqli, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($edu = mysqli_fetch_assoc($result)) {
                $position = ($counter % 2 == 0) ? 'left' : 'right';
                $counter++;
        ?>
                <div class="timeline-item <?php echo $position; ?>">
                    <div class="content">
                        <h3><?php echo htmlspecialchars($edu['title']); ?></h3>
                        <p class="institution"><?php echo htmlspecialchars($edu['institution']); ?></p>
                        <p class="year"><?php echo htmlspecialchars($edu['year']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($edu['description'])); ?></p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p style='text-align:center; color:white; width:100%;'>No education history available.</p>";
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer" style="background-image: url('images/footer-1.jpg')">
            <div class="links">
                <a href="index.php">Home</a>
                <a href="services.php">Experience</a>
                <a href="projects.php">Projects</a>
                <!-- <a href="customers.php">Customers</a> -->
                <a href="education.php" id="active">Education</a>
                <!-- <a href="team.php">Team</a> -->
                <a href="practice/index.php">projects</a>
                <a href="contact.php">Contact</a>
            </div>
            <div class="logo">
                <img src="images/logo-colors.png" alt="logo" />
                <!-- <p>Sama Media</p> -->
            </div>
            <div class="contact">
                <h3>Phone Numbers</h3>
                <p class="phone">+ 880 246 894 2097</p>
                <p class="phone">+ 880 156 789 3041</p>
                <h3>Social Media</h3>
                <span>
                    <a href="https://www.facebook.com/mubinislam.alif.1"> <i class="fa fa-facebook">&nbsp; Facebook</i></a>
                    <a href=""> <i class="fa fa-instagram"> &nbsp;Instagram</i></a>
                    <a href=""> <i class="fa fa-whatsapp"> &nbsp;Whatsapp</i></a>
                </span>
            </div>
            <!-- <i class="copyright">All copyright reserved &copy;</i> -->
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <a class="scroll" href="#">
        <i class="fa fa-arrow-up"></i>
    </a>

    <!-- JS Script -->
    <script src="scripts/script.js"></script>

</body>

</html>