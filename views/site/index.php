<?php
use yii\helpers\Html;
use app\models\User;
use app\models\GameMatch;
use app\models\Team;

$this->title = Yii::$app->params['appName'];
$isLoggedIn = !Yii::$app->user->isGuest;
$user = $isLoggedIn ? Yii::$app->user->identity : null;
$matchCount = GameMatch::find()->count();
$teamCount = Team::find()->count();
?>

<style>
    /* Main Container */
    .home-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header Stats */
    .stats-header {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 50px 0;
        background: rgba(0, 0, 0, 0.6);
        padding: 40px 20px;
        border-radius: 8px;
    }

    [data-theme="light"] .stats-header {
        background: rgba(255, 255, 255, 0.95);
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #00d4ff;
        line-height: 1;
        margin-bottom: 8px;
    }

    [data-theme="light"] .stat-number {
        color: #0084ff;
    }

    .stat-label {
        font-size: 0.95rem;
        color: rgba(232, 234, 240, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    [data-theme="light"] .stat-label {
        color: rgba(0, 0, 0, 0.7);
    }

    /* Title */
    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffffff;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        margin: 40px 0 20px;
    }

    [data-theme="light"] .page-title {
        color: #1a1a1a;
        text-shadow: none;
    }

    /* Countdown Section */
    .countdown-section {
        background: rgba(0, 0, 0, 0.6);
        padding: 40px 20px;
        border-radius: 8px;
        margin-bottom: 60px;
    }

    [data-theme="light"] .countdown-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .countdown-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 20px;
    }

    .countdown-item {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(0, 212, 255, 0.3);
        border-radius: 8px;
        padding: 30px 20px;
        text-align: center;
    }

    [data-theme="light"] .countdown-item {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.25);
    }

    .countdown-value {
        font-size: 2.8rem;
        font-weight: 800;
        color: #00d4ff;
        line-height: 1;
        margin-bottom: 8px;
        font-variant-numeric: tabular-nums;
    }

    [data-theme="light"] .countdown-value {
        color: #0084ff;
    }

    .countdown-unit {
        font-size: 0.85rem;
        color: rgba(232, 234, 240, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    [data-theme="light"] .countdown-unit {
        color: rgba(0, 0, 0, 0.7);
    }

    /* Navigation Tabs */
    .nav-tabs-section {
        margin: 40px 0;
    }

    .nav-tabs {
        display: flex;
        gap: 10px;
        border-bottom: 2px solid rgba(0, 212, 255, 0.2);
        overflow-x: auto;
        padding-bottom: 15px;
    }

    [data-theme="light"] .nav-tabs {
        border-bottom-color: rgba(0, 132, 255, 0.2);
    }

    .nav-tab {
        padding: 10px 20px;
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: rgba(232, 234, 240, 0.6);
        text-decoration: none;
        white-space: nowrap;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
    }

    .nav-tab:hover {
        color: #00d4ff;
    }

    .nav-tab.active {
        color: #00d4ff;
        border-bottom-color: #00d4ff;
    }

    [data-theme="light"] .nav-tab {
        color: rgba(0, 0, 0, 0.6);
    }

    [data-theme="light"] .nav-tab:hover,
    [data-theme="light"] .nav-tab.active {
        color: #0084ff;
        border-bottom-color: #0084ff;
    }

    /* Content Sections */
    .content-section {
        background: rgba(0, 0, 0, 0.6);
        padding: 30px 20px;
        border-radius: 8px;
        margin-bottom: 40px;
    }

    [data-theme="light"] .content-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
    }

    [data-theme="light"] .section-title {
        color: #1a1a1a;
    }

    .action-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .action-link {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(0, 212, 255, 0.25);
        border-radius: 8px;
        padding: 24px;
        text-align: left;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .action-link:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(0, 212, 255, 0.4);
    }

    [data-theme="light"] .action-link {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.2);
    }

    [data-theme="light"] .action-link:hover {
        background: rgba(0, 0, 0, 0.06);
        border-color: rgba(0, 132, 255, 0.35);
    }

    .link-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
    }

    [data-theme="light"] .link-title {
        color: #1a1a1a;
    }

    .link-desc {
        font-size: 0.9rem;
        color: rgba(232, 234, 240, 0.7);
    }

    [data-theme="light"] .link-desc {
        color: rgba(0, 0, 0, 0.6);
    }

    /* 3D Trophy Section */
    .trophy-section {
        background: rgba(0, 0, 0, 0.6);
        padding: 30px 20px;
        border-radius: 8px;
        margin: 60px 0;
    }

    [data-theme="light"] .trophy-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .trophy-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .trophy-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .trophy-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffffff;
    }

    [data-theme="light"] .trophy-title {
        color: #1a1a1a;
    }

    .trophy-desc {
        font-size: 1rem;
        color: rgba(232, 234, 240, 0.8);
        line-height: 1.6;
    }

    [data-theme="light"] .trophy-desc {
        color: rgba(0, 0, 0, 0.7);
    }

    .trophy-panel {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .trophy-scene {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(0, 212, 255, 0.2);
        border-radius: 8px;
        overflow: hidden;
        min-height: 400px;
    }

    [data-theme="light"] .trophy-scene {
        background: rgba(0, 0, 0, 0.02);
        border-color: rgba(0, 132, 255, 0.2);
    }

    .trophy-scene canvas {
        width: 100% !important;
        height: 100% !important;
        display: block !important;
    }

    .trophy-controls {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
        padding: 15px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 6px;
    }

    [data-theme="light"] .trophy-controls {
        background: rgba(0, 0, 0, 0.04);
    }

    .trophy-controls button {
        padding: 8px 16px;
        background: rgba(0, 212, 255, 0.2);
        border: 1px solid rgba(0, 212, 255, 0.4);
        border-radius: 4px;
        color: #00d4ff;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .trophy-controls button:hover {
        background: rgba(0, 212, 255, 0.3);
        border-color: rgba(0, 212, 255, 0.6);
    }

    [data-theme="light"] .trophy-controls button {
        background: rgba(0, 132, 255, 0.15);
        border-color: rgba(0, 132, 255, 0.35);
        color: #0084ff;
    }

    [data-theme="light"] .trophy-controls button:hover {
        background: rgba(0, 132, 255, 0.25);
        border-color: rgba(0, 132, 255, 0.5);
    }

    .trophy-controls label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(232, 234, 240, 0.8);
        font-size: 0.9rem;
    }

    [data-theme="light"] .trophy-controls label {
        color: rgba(0, 0, 0, 0.7);
    }

    .trophy-controls input[type="range"] {
        width: 120px;
        cursor: pointer;
    }

    @media (max-width: 1024px) {
        .trophy-container {
            grid-template-columns: 1fr;
        }

        .trophy-scene {
            min-height: 300px;
        }
    }

    @media (max-width: 768px) {
        .countdown-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .action-links {
            grid-template-columns: 1fr;
        }

        .nav-tabs {
            flex-wrap: wrap;
        }

        .trophy-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .trophy-controls label {
            flex-direction: column;
        }
    }
</style>

<div class="home-container">
    <!-- Key Statistics Header -->
    <div class="stats-header">
        <div class="stat-item">
            <div class="stat-number"><?= $teamCount ?></div>
            <div class="stat-label">Teams</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?= $matchCount ?></div>
            <div class="stat-label">Matches</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">12</div>
            <div class="stat-label">Groups</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">6</div>
            <div class="stat-label">Knockout Rounds</div>
        </div>
    </div>

    <!-- Countdown Timer -->
    <h2 class="page-title">Time Until Kickoff</h2>
    <div class="countdown-section">
        <div class="countdown-grid">
            <div class="countdown-item">
                <div class="countdown-value days-digit">0</div>
                <div class="countdown-unit">Days</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value hours-digit">0</div>
                <div class="countdown-unit">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value minutes-digit">0</div>
                <div class="countdown-unit">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value seconds-digit">0</div>
                <div class="countdown-unit">Seconds</div>
            </div>
        </div>
    </div>

    <!-- 3D Trophy Section -->
    <div class="trophy-section">
        <div class="trophy-container">
            <div class="trophy-info">
                <h2 class="trophy-title">FIFA World Cup Trophy</h2>
                <p class="trophy-desc">
                    The FIFA World Cup is the most prestigious international football competition.
                    Held every four years, it brings together the world's greatest teams to compete
                    for the legendary gold trophy.
                </p>
                <p class="trophy-desc">
                    The tournament features 48 teams playing across 104 matches in a thrilling journey
                    from group stage through to the grand finals.
                </p>
            </div>
            <div class="trophy-panel" aria-label="3D World Cup Trophy Model">
                <div id="trophyScene" class="trophy-scene">
                    <canvas data-engine="three.js" width="500" height="500" style="display: block; touch-action: none;"></canvas>
                </div>
                <div class="trophy-controls" aria-label="Trophy Controls">
                    <button type="button" id="spinToggle" aria-pressed="false">Auto Rotate</button>
                    <button type="button" id="resetView">Reset View</button>
                    <label>
                        Brightness
                        <input id="lightRange" type="range" min="0.8" max="3.5" step="0.1" value="2.0">
                    </label>
                    <label>
                        Zoom
                        <input id="zoomRange" type="range" min="3.8" max="8" step="0.1" value="5.8">
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="nav-tabs-section">
        <div class="nav-tabs">
            <a href="/team/index" class="nav-tab">Tour</a>
            <a href="/match/index" class="nav-tab">Schedule</a>
            <a href="/ranking/index" class="nav-tab">Rankings</a>
            <?php if ($isLoggedIn): ?>
                <a href="/bet/index" class="nav-tab">Predictions</a>
            <?php else: ?>
                <a href="/user/login" class="nav-tab">Sign In</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <h2 class="section-title">Get Started</h2>
        <div class="action-links">
            <a href="/team/index" class="action-link">
                <div class="link-title">Browse Teams</div>
                <div class="link-desc">View all 48 teams in group stage and knockout rounds</div>
            </a>
            <a href="/match/index" class="action-link">
                <div class="link-title">Match Schedule</div>
                <div class="link-desc">See upcoming matches and tournament schedule</div>
            </a>
            <a href="/ranking/index" class="action-link">
                <div class="link-title">View Rankings</div>
                <div class="link-desc">Check top predictors and leaderboard</div>
            </a>
            <?php if ($isLoggedIn): ?>
                <a href="/bet/index" class="action-link">
                    <div class="link-title">Make Predictions</div>
                    <div class="link-desc">Predict match outcomes and earn points</div>
                </a>
            <?php else: ?>
                <a href="/user/login" class="action-link">
                    <div class="link-title">Sign In to Play</div>
                    <div class="link-desc">Create an account and start making predictions</div>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($isLoggedIn && $user): ?>
    <!-- User Stats Section -->
    <div class="content-section">
        <h2 class="section-title">Your Stats</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px;">
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">
                    <?= isset($user->profile->points) ? $user->profile->points : 0 ?>
                </div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Points</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">-</div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Rank</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">-</div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Predictions</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">-</div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Accuracy</div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
// Initialize 3D Trophy
(function() {
    let scene, camera, renderer, trophy, autoRotate = false;

    function initTrophy() {
        const canvas = document.querySelector('#trophyScene canvas');
        if (!canvas) return;

        // Scene setup
        scene = new THREE.Scene();
        scene.background = new THREE.Color(0x1a1a1a);

        const isDark = document.documentElement.getAttribute('data-theme') !== 'light';
        if (!isDark) {
            scene.background = new THREE.Color(0xf5f5f5);
        }

        // Camera
        camera = new THREE.PerspectiveCamera(75, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);
        camera.position.set(0, 2, 5.8);

        // Renderer
        renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true });
        renderer.setSize(canvas.clientWidth, canvas.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);

        // Lighting
        const ambientLight = new THREE.AmbientLight(0xffffff, 2.0);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0xffffff, 2.0);
        directionalLight.position.set(5, 10, 7);
        scene.add(directionalLight);

        // Create trophy (procedural)
        createTrophy();

        // Controls
        setupControls();

        // Animation loop
        animate();

        // Handle window resize
        window.addEventListener('resize', onWindowResize);
    }

    function createTrophy() {
        const group = new THREE.Group();

        // Trophy body (gold cone)
        const bodyGeometry = new THREE.ConeGeometry(0.8, 2, 32);
        const goldMaterial = new THREE.MeshStandardMaterial({
            color: 0xffd700,
            metalness: 0.8,
            roughness: 0.2
        });
        const body = new THREE.Mesh(bodyGeometry, goldMaterial);
        body.position.y = 1;
        group.add(body);

        // Trophy base (cylinder)
        const baseGeometry = new THREE.CylinderGeometry(1.2, 1.2, 0.5, 32);
        const baseMaterial = new THREE.MeshStandardMaterial({
            color: 0x333333,
            metalness: 0.3,
            roughness: 0.4
        });
        const base = new THREE.Mesh(baseGeometry, baseMaterial);
        group.add(base);

        // Handles (tori)
        const handleGeometry = new THREE.TorusGeometry(0.4, 0.1, 16, 100);
        const handle1 = new THREE.Mesh(handleGeometry, goldMaterial);
        handle1.position.set(-0.8, 1.5, 0);
        handle1.rotation.z = Math.PI / 2;
        group.add(handle1);

        const handle2 = new THREE.Mesh(handleGeometry, goldMaterial);
        handle2.position.set(0.8, 1.5, 0);
        handle2.rotation.z = Math.PI / 2;
        group.add(handle2);

        scene.add(group);
        trophy = group;
    }

    function setupControls() {
        // Auto rotate button
        const spinToggle = document.getElementById('spinToggle');
        if (spinToggle) {
            spinToggle.addEventListener('click', () => {
                autoRotate = !autoRotate;
                spinToggle.setAttribute('aria-pressed', autoRotate);
                spinToggle.textContent = autoRotate ? 'Stop Rotating' : 'Auto Rotate';
            });
        }

        // Reset view button
        const resetView = document.getElementById('resetView');
        if (resetView) {
            resetView.addEventListener('click', () => {
                if (camera) {
                    camera.position.set(0, 2, 5.8);
                    camera.lookAt(0, 1, 0);
                }
                autoRotate = false;
                spinToggle.setAttribute('aria-pressed', false);
                spinToggle.textContent = 'Auto Rotate';
            });
        }

        // Light range
        const lightRange = document.getElementById('lightRange');
        if (lightRange) {
            lightRange.addEventListener('input', (e) => {
                const lights = scene.children.filter(child => child instanceof THREE.Light);
                lights.forEach(light => {
                    if (light instanceof THREE.AmbientLight) {
                        light.intensity = parseFloat(e.target.value);
                    }
                });
            });
        }

        // Zoom range
        const zoomRange = document.getElementById('zoomRange');
        if (zoomRange) {
            zoomRange.addEventListener('input', (e) => {
                camera.position.z = parseFloat(e.target.value);
            });
        }

        // Mouse controls
        let isDragging = false, previousMousePosition = { x: 0, y: 0 };

        renderer.domElement.addEventListener('mousedown', (e) => {
            isDragging = true;
            previousMousePosition = { x: e.clientX, y: e.clientY };
        });

        renderer.domElement.addEventListener('mousemove', (e) => {
            if (isDragging && trophy) {
                const deltaX = e.clientX - previousMousePosition.x;
                const deltaY = e.clientY - previousMousePosition.y;

                trophy.rotation.y += deltaX * 0.01;
                trophy.rotation.x += deltaY * 0.01;

                previousMousePosition = { x: e.clientX, y: e.clientY };
            }
        });

        renderer.domElement.addEventListener('mouseup', () => {
            isDragging = false;
        });
    }

    function animate() {
        requestAnimationFrame(animate);

        if (autoRotate && trophy) {
            trophy.rotation.y += 0.005;
        }

        renderer.render(scene, camera);
    }

    function onWindowResize() {
        const canvas = document.querySelector('#trophyScene canvas');
        if (!canvas) return;

        camera.aspect = canvas.clientWidth / canvas.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(canvas.clientWidth, canvas.clientHeight);
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTrophy);
    } else {
        initTrophy();
    }
})();

(function() {
    function updateCountdown() {
        const countdownDate = new Date('2026-06-12T00:00:00').getTime();
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            document.querySelector('.days-digit').innerHTML = '0';
            document.querySelector('.hours-digit').innerHTML = '0';
            document.querySelector('.minutes-digit').innerHTML = '0';
            document.querySelector('.seconds-digit').innerHTML = '0';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.querySelector('.days-digit').innerHTML = days.toString().padStart(2, '0');
        document.querySelector('.hours-digit').innerHTML = hours.toString().padStart(2, '0');
        document.querySelector('.minutes-digit').innerHTML = minutes.toString().padStart(2, '0');
        document.querySelector('.seconds-digit').innerHTML = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
</script>
