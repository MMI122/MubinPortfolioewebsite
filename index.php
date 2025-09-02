<?php
// Cookie: track visit count
if (isset($_COOKIE['visit_count'])) {
    $count = $_COOKIE['visit_count'] + 1;
} else {
    $count = 1;
}
setcookie("visit_count", $count, time() + (86400 * 30), "/"); // store for 30 days
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mubin Islam Alif</title>

    <!-- Google Font: Allura (Fancy Handwriting Style) -->
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">

    <!-- Your CSS Files -->
    <link rel="stylesheet" href="styles/all.min.css" />
    <link rel="stylesheet" href="styles/v4-shims.min.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/index.css" />

    <style>
        /* Fancy Styling for the Typewriter Text */
        #typewriter {
            font-family: 'Allura', cursive;
            font-size: 56px;
            color: #ff0022;
            white-space: nowrap;
            overflow: hidden;
            letter-spacing: 1px;
            text-shadow:
                2px 2px 4px rgba(0, 0, 0, 0.2),
                0 0 10px rgba(255, 0, 34, 0.2);
            display: inline-block;
        }

        /* Optional: Hover Glow Effect */
        #typewriter:hover {
            text-shadow:
                2px 2px 4px rgba(0, 0, 0, 0.2),
                0 0 15px rgba(255, 0, 34, 0.4);
            transition: all 0.3s ease;
        }

        /* Responsive Font Size */
        @media (max-width: 768px) {
            #typewriter {
                font-size: 42px;
            }
        }

        @media (max-width: 480px) {
            #typewriter {
                font-size: 36px;
            }
        }

        /* Optional: Fade-in Animation After Typing */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        #typewriter.animated {
            animation: fadeIn 1.5s ease-in-out;
        }
    </style>
</head>

<body>
    <!-- header -->
    <header class="f-around">
        <div class="logo"></div>
        <nav>
            <a href="index.php" id="active">Home</a>
            <a href="services.php">Experience</a>
            <a href="projects.php">publications</a>
            <a href="education.php">Education</a>
            <a href="practice/index.php">projects</a>
            <a href="contact.php">contact</a>
        </nav>
        <div class="icons">
            <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-telegram"></i></a>
        </div>
        <div class="BTNSIDER" id="BTNSIDER"></div>
    </header>
    <div class="font"></div>
    <aside id="sider">
        <div class="logo"></div>
        <nav>
            <a href="index.php" id="active">Home</a>
            <a href="services.php">Experience</a>
            <a href="projects.php">publications</a>
            <a href="education.php">Education</a>
            <a href="practice/index.php">projects</a>
            <a href="contact.php">contact</a>
        </nav>
        <div class="icons">
            <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-telegram"></i></a>
        </div>
    </aside>

    <!-- content -->
    <div class="container f-evenly main" style="padding-top: 100px">
        <div class="text">
            <h2>Hello..</h2>
            <!-- <h1>
                I am <span id="typewriter" style="color: #ff0022;"></span>
            </h1> -->
            <h1 class="name-heading">
                I am
                <span id="typewriter"></span>
            </h1>

            <style>
                .name-heading {
                    font-size: 60px;
                    font-weight: 500;
                    text-align: left;
                    line-height: 1.2;
                    color: #333;
                }

                #typewriter {
                    font-family: 'Allura', cursive;
                    font-size: 68px;
                    /* Larger for elegance */
                    color: #ff0022;
                    white-space: nowrap;
                    overflow: hidden;
                    letter-spacing: 1px;
                    vertical-align: -30px;
                    /* Pulls the name up/down to align visually */
                    text-shadow: 0 0 8px rgba(255, 0, 34, 0.2);
                    display: inline-block;
                    /* Ensures vertical-align works */
                }

                /* Responsive adjustments */
                @media (max-width: 768px) {
                    .name-heading {
                        font-size: 45px;
                    }

                    #typewriter {
                        font-size: 52px;
                        vertical-align: -2px;
                    }
                }

                @media (max-width: 480px) {
                    .name-heading {
                        font-size: 36px;
                    }

                    #typewriter {
                        font-size: 40px;
                        vertical-align: 0;
                    }
                }
            </style>
            <h3>who codes for the love of it</h3>

            <!-- Typewriter Effect with Animation -->
            <script>
                const text = "Mubin Islam Alif";
                let i = 0;

                function typeWriter() {
                    if (i < text.length) {
                        document.getElementById("typewriter").innerHTML += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 120);
                    } else {
                        // Add animated class after typing finishes
                        document.getElementById("typewriter").classList.add("animated");
                    }
                }

                // Run when page loads
                window.onload = typeWriter;
            </script>

            <div class="links">
                <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-telegram"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-whatsapp"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
            </div>
        </div>
        <div class="img">
            <img src="images/alifprofile1.png" alt="Mubin Islam Alif" />
        </div>
    </div>

    <!-- services -->
    <div class="serves container f-evenly" id="serves">
        <h2>Experience</h2>
        <div class="card">
            <div class="serv">
                <a href="services.php?#design">
                    <img src="images/logo11.gif" alt="" class="img200" />
                </a>
                <h3>Academic Coordinator</h3>
            </div>
            <div class="serv">
                <a href="services.php?#print">
                    <img src="images/logo33.gif" alt="" class="img200" />
                </a>
                <h3>Academic Coordinator</h3>
            </div>
            <div class="serv">
                <a href="services.php?#execut">
                    <img src="images/logo22.gif" alt="" class="img200" />
                </a>
                <h3>Member<br /></h3>
            </div>
        </div>
        <a href="projects.php"><button>Show publications</button></a>
    </div>

    <!-- about/latest work -->
    <div class="projects container f-evenly">
        <h2>latest work</h2>
        <?php
        include "conn.php";
        if ($con_mysqli) {
            $query = "SELECT * FROM projects ORDER BY p_id DESC LIMIT 3";
            $result = mysqli_query($con_mysqli, $query);
            $row_com = mysqli_num_rows($result);
            if ($row_com > 0) {
                while ($data_main = mysqli_fetch_assoc($result)) { ?>
                    <div class="project f-center shad-bx">
                        <img src="images/<?php echo htmlspecialchars($data_main["p_image"]); ?>" alt="Project Image">
                    </div>
        <?php }
            } else {
                echo "<p>No projects found.</p>";
            }
        } else {
            echo '<p style="color:red;">Database connection failed.</p>';
        }
        ?>
    </div>

    <!-- footer -->
    <footer>
        <div class="footer" style="background-image: url('images/footer-1.jpg')">
            <div class="links">
                <a href="index.php">Home</a>
                <a href="services.php">experience</a>
                <a href="projects.php">publications</a>
                <a href="education.php">education</a>
                <a href="practice/index.php">projects</a>
                <a href="contact.php">contact</a>
                <a href="dashboard/index.php">admin</a>
            </div>
            <div class="logo">
                <img src="images/logo-colors.png" alt="logo" />
            </div>
            <div class="contact">
                <h3>Phone Numbers</h3>
                <p class="phone">+880 246 894 2097</p>
                <p class="phone">+880 156 789 3041</p>
                <h3>Social Media</h3>
                <span>
                    <a href="https://www.facebook.com/mubinislam.alif.1">
                        <i class="fa fa-facebook"></i> Facebook
                    </a><br>
                    <a href="#">
                        <i class="fa fa-instagram"></i> Instagram
                    </a><br>
                    <a href="#">
                        <i class="fa fa-whatsapp"></i> WhatsApp
                    </a>
                </span>
            </div>
        </div>
        <p style="text-align:center; font-size:16px; color:gray; margin-top: 10px;">
            You have visited this site <strong><?php echo $count; ?></strong> times.
        </p>
    </footer>

    <a class="scroll" href="#">
        <i class="fa fa-arrow-up"></i>
    </a>

    <script src="scripts/script.js"></script>
</body>

</html>