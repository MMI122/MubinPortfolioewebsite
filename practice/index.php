<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Projects</title>
    <link rel="stylesheet" href="assets/css/styleprojects.css" />
    <link rel="stylesheet" href="../styles/all.min.css" />
    <link rel="stylesheet" href="../styles/v4-shims.min.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/projects1.css" />
</head>

<body>

    <!-- Header -->
    <header class="f-around">
        <div class="logo"></div>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../services.php">Experience</a>
            <a href="../projects.php">Publication</a>
            <a href="../education.php">Education</a>
            <a href="../practice/index.php" id="active">Project</a>
            <a href="../contact.php">Contact</a>
        </nav>
        <div class="icons">
            <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-telegram"></i></a>
        </div>
        <div class="BTNSIDER" id="BTNSIDER"></div>
        <a href="admin/login.php" class="admin-link">Admin</a>
    </header>

    <div class="font"></div>
    <aside id="sider">
        <div class="logo"></div>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../services.php">Experience</a>
            <a href="../projects.php">Publication</a>
            <a href="../education.php">Education</a>
            <a href="../practice/index.php" id="active">Project</a>
            <a href="../contact.php">Contact</a>
        </nav>
        <div class="icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-telegram"></i></a>
        </div>
    </aside>

    <!-- Main Title -->
    <div class="container f-center">
        <h2 class="main-text">Projects</h2>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="🔍 Search projects..." />
    </div>

    <!-- Projects Grid with Full-Width Background GIF -->
    <main class="projects-grid" id="projectsContainer">
        <?php
        require_once 'config/db.php';

        $stmt = $pdo->prepare("SELECT * FROM projects ORDER BY created_at DESC");
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($projects)): ?>
            <p>No projects yet. Stay tuned!</p>
        <?php else: ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-card">
                    <img src="<?= htmlspecialchars($project['image_url']) ?>"
                        alt="<?= htmlspecialchars($project['title']) ?>" />

                    <span class="tag"><?= htmlspecialchars($project['category']) ?></span>

                    <h3><?= htmlspecialchars($project['title']) ?></h3>

                    <div class="project-description">
                        <?php
                        $desc = htmlspecialchars($project['description']);
                        $paragraphs = array_filter(array_map('trim', explode("\n", $desc)));
                        foreach ($paragraphs as $p) {
                            echo "<p>$p</p>";
                        }
                        ?>
                    </div>

                    <a href="<?= htmlspecialchars($project['github_url']) ?>"
                        target="_blank" class="github-link">📁 View on GitHub</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer" style="background-image: url('../images/footer-1.jpg')">
            <div class="links">
                <a href="../index.php">Home</a>
                <a href="../services.php">services</a>
                <a href="../projects.php" id="active">projects</a>
                <a href="../contact.php">contact</a>
            </div>
            <div class="logo">
                <img src="../images/logo-colors.png" alt="logo" />
            </div>
            <div class="contact">
                <h3>Phone Numbers</h3>
                <p class="phone">+880 246 894 2097</p>
                <p class="phone">+880 156 789 3041</p>
                <h3>Social Media</h3>
                <span>
                    <a href="https://www.facebook.com/mubinislam.alif.1"><i class="fa fa-facebook">&nbsp; Facebook</i></a>
                    <a href=""><i class="fa fa-instagram"> &nbsp;Instagram</i></a>
                    <a href=""><i class="fa fa-whatsapp"> &nbsp;Whatsapp</i></a>
                </span>
            </div>
        </div>
    </footer>

    <a class="scroll" href="#"><i class="fa fa-arrow-up"></i></a>
    <script src="../scripts/script.js"></script>

    <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle">🌙 Dark Mode</button>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const searchInput = document.getElementById('searchInput');
            const projectCards = document.getElementsByClassName('project-card');

            // Dark Mode Toggle
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                return parts.length === 2 ? parts.pop().split(';').shift() : null;
            }

            if (getCookie('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
                toggle.textContent = '☀️ Light Mode';
            }

            toggle?.addEventListener('click', function() {
                body.classList.toggle('dark-mode');
                if (body.classList.contains('dark-mode')) {
                    document.cookie = 'darkMode=enabled; path=/; max-age=31536000';
                    toggle.textContent = '☀️ Light Mode';
                } else {
                    document.cookie = 'darkMode=disabled; path=/; max-age=31536000';
                    toggle.textContent = '🌙 Dark Mode';
                }
            });

            // Live Search
            if (searchInput && projectCards.length > 0) {
                searchInput.addEventListener('keyup', function() {
                    const filter = this.value.toLowerCase().trim();
                    for (let card of projectCards) {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const desc = card.querySelector('.project-description').textContent.toLowerCase();
                        const tag = card.querySelector('.tag')?.textContent.toLowerCase() || '';

                        if (title.includes(filter) || desc.includes(filter) || tag.includes(filter)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>