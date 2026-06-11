<?php
use yii\helpers\Html;
use app\assets\Helper;

$this->title = 'Rules';

$total = $config['totalAmount'] ?? 0;
$p1 = Helper::calculatePrices($total, $config['p1Rate'] ?? 25, $config['p1Count'] ?? 1);
$p2 = Helper::calculatePrices($total, $config['p2Rate'] ?? 20, $config['p2Count'] ?? 1);
$p3 = Helper::calculatePrices($total, $config['p3Rate'] ?? 10, $config['p3Count'] ?? 2);
$p4 = Helper::calculatePrices($total, $config['p4Rate'] ?? 5, $config['p4Count'] ?? 4);
$p5 = Helper::calculatePrices($total, $config['p5Rate'] ?? 0, $config['p5Count'] ?? 5);
?>

<div class="min-h-screen bg-primary text-primary">
    <!-- Hero Section -->
    <div class="max-w-5xl mx-auto text-center py-16 px-4 md:py-24 md:px-8 border-b border-primary">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 md:mb-6 leading-tight">
            GAME RULES & REGULATIONS
        </h1>
        <p class="text-base md:text-lg text-secondary max-w-2xl mx-auto leading-relaxed">
            Complete guide to World Cup 2026 betting, match predictions, betting rules, and prize structure
        </p>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-5xl mx-auto px-4 md:px-8 py-12 md:py-16 space-y-16">

        <!-- PRIZE STRUCTURE SECTION -->
        <section class="space-y-8">
            <div class="flex items-center gap-3 p-6 md:p-8 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 border-l-4 border-yellow-500/30 rounded-lg">
                <i class="glyphicon glyphicon-star text-2xl text-yellow-500/50"></i>
                <h2 class="text-2xl md:text-3xl font-bold">PRIZE TIERS & STRUCTURE</h2>
            </div>

            <!-- Prize Tier Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- DIAMOND - Tier 1 -->
                <div class="p-6 bg-card border border-primary rounded-xl hover:border-yellow-500/50 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">💎</span>
                        <div>
                            <p class="text-xs text-secondary">RANK 1</p>
                            <p class="text-lg font-bold text-yellow-600 dark:text-yellow-400">DIAMOND</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm border-t border-primary pt-4">
                        <p><span class="text-secondary">Rate:</span> <span class="bg-yellow-500/20 px-2 py-1 rounded font-bold text-yellow-600 dark:text-yellow-400"><?= $config['p1Rate'] ?? 25 ?>%</span></p>
                        <p><span class="text-secondary">Count:</span> <span class="font-bold"><?= $config['p1Count'] ?? 1 ?></span></p>
                        <div class="pt-2 border-t border-primary">
                            <p class="text-xs text-secondary mb-1">Prize per person:</p>
                            <p class="text-lg font-bold text-yellow-600 dark:text-yellow-400"><?= Helper::formatMoney($p1['price']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- PLATINUM - Tier 2 -->
                <div class="p-6 bg-card border border-primary rounded-xl hover:border-orange-500/50 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">🏅</span>
                        <div>
                            <p class="text-xs text-secondary">RANK 2</p>
                            <p class="text-lg font-bold text-orange-600 dark:text-orange-400">PLATINUM</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm border-t border-primary pt-4">
                        <p><span class="text-secondary">Rate:</span> <span class="bg-orange-500/20 px-2 py-1 rounded font-bold text-orange-600 dark:text-orange-400"><?= $config['p2Rate'] ?? 20 ?>%</span></p>
                        <p><span class="text-secondary">Count:</span> <span class="font-bold"><?= $config['p2Count'] ?? 1 ?></span></p>
                        <div class="pt-2 border-t border-primary">
                            <p class="text-xs text-secondary mb-1">Prize per person:</p>
                            <p class="text-lg font-bold text-orange-600 dark:text-orange-400"><?= Helper::formatMoney($p2['price']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- GOLD - Tier 3 -->
                <div class="p-6 bg-card border border-primary rounded-xl hover:border-green-500/50 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">🥇</span>
                        <div>
                            <p class="text-xs text-secondary">RANK 3</p>
                            <p class="text-lg font-bold text-green-600 dark:text-green-400">GOLD</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm border-t border-primary pt-4">
                        <p><span class="text-secondary">Rate:</span> <span class="bg-green-500/20 px-2 py-1 rounded font-bold text-green-600 dark:text-green-400"><?= $config['p3Rate'] ?? 10 ?>%</span></p>
                        <p><span class="text-secondary">Count:</span> <span class="font-bold"><?= $config['p3Count'] ?? 2 ?></span></p>
                        <div class="pt-2 border-t border-primary">
                            <p class="text-xs text-secondary mb-1">Prize per person:</p>
                            <p class="text-lg font-bold text-green-600 dark:text-green-400"><?= Helper::formatMoney($p3['price']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- SILVER - Tier 4 -->
                <div class="p-6 bg-card border border-primary rounded-xl hover:border-cyan-500/50 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">🥈</span>
                        <div>
                            <p class="text-xs text-secondary">RANK 4</p>
                            <p class="text-lg font-bold text-cyan-600 dark:text-cyan-400">SILVER</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm border-t border-primary pt-4">
                        <p><span class="text-secondary">Rate:</span> <span class="bg-cyan-500/20 px-2 py-1 rounded font-bold text-cyan-600 dark:text-cyan-400"><?= $config['p4Rate'] ?? 5 ?>%</span></p>
                        <p><span class="text-secondary">Count:</span> <span class="font-bold"><?= $config['p4Count'] ?? 4 ?></span></p>
                        <div class="pt-2 border-t border-primary">
                            <p class="text-xs text-secondary mb-1">Prize per person:</p>
                            <p class="text-lg font-bold text-cyan-600 dark:text-cyan-400"><?= Helper::formatMoney($p4['price']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Prize Pool Card -->
            <div class="p-8 md:p-12 bg-gradient-cyan rounded-xl text-white text-center">
                <p class="text-sm opacity-90 mb-3 font-semibold">TOTAL PRIZE POOL</p>
                <p class="text-5xl md:text-6xl font-black"><?= Helper::formatMoney($total) ?></p>
            </div>
        </section>

        <!-- BETTING RULES SECTION -->
        <section class="space-y-8">
            <div class="flex items-center gap-3 p-6 md:p-8 bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border-l-4 border-blue-500/30 rounded-lg">
                <i class="glyphicon glyphicon-ok text-2xl text-blue-500/50"></i>
                <h2 class="text-2xl md:text-3xl font-bold">BETTING RULES & GUIDE</h2>
            </div>

            <div class="space-y-4">
                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="text-2xl">🎯</span>
                        How to Place a Bet
                    </h3>
                    <ul class="space-y-3 ml-8 text-sm">
                        <li class="list-disc"><b>Go to Matches page</b> - View all upcoming World Cup matches</li>
                        <li class="list-disc"><b>Select a match</b> - Click on any match to view details</li>
                        <li class="list-disc"><b>Choose prediction</b> - Win (Team 1), Draw, or Loss (Team 2)</li>
                        <li class="list-disc"><b>Enter bet amount</b> - Min 50K, Max 2,000K per match</li>
                        <li class="list-disc"><b>Confirm & Submit</b> - Your bet is locked until match result</li>
                    </ul>
                </div>

                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="text-2xl">💰</span>
                        Starting Balance & Refills
                    </h3>
                    <ul class="space-y-3 ml-8 text-sm">
                        <li class="list-disc"><b>Starting Balance:</b> 300K coins</li>
                        <li class="list-disc"><b>Refill Limit:</b> Maximum 4 refills per season</li>
                        <li class="list-disc"><b>Refill Range:</b> 50K to 2,000K per refill</li>
                        <li class="list-disc"><b>How to Refill:</b> Account → Refill → Select Amount → Confirm</li>
                        <li class="list-disc"><b>Processing:</b> Refills process during payment hours (09:00 - 22:30)</li>
                    </ul>
                </div>

                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="text-2xl">🏆</span>
                        Winning & Points
                    </h3>
                    <ul class="space-y-3 ml-8 text-sm">
                        <li class="list-disc"><b>Correct Prediction:</b> Win your bet amount + earn points</li>
                        <li class="list-disc"><b>Wrong Prediction:</b> Lose your bet amount</li>
                        <li class="list-disc"><b>Draw Prediction (if correct):</b> Earn 1.5x your bet</li>
                        <li class="list-disc"><b>Points System:</b> 1 point per 10K won (across season)</li>
                        <li class="list-disc"><b>Leaderboard:</b> Top scorers shown on Rankings page</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CONTACT & SUPPORT SECTION -->
        <section class="space-y-8">
            <div class="flex items-center gap-3 p-6 md:p-8 bg-gradient-to-r from-green-500/10 to-emerald-500/10 border-l-4 border-green-500/30 rounded-lg">
                <i class="glyphicon glyphicon-phone text-2xl text-green-500/50"></i>
                <h2 class="text-2xl md:text-3xl font-bold">CONTACT & ACCOUNT CREATION</h2>
            </div>

            <div class="p-6 md:p-8 bg-green-500/10 border-l-4 border-green-600 rounded-lg">
                <p class="text-base md:text-lg font-bold text-green-600 dark:text-green-400 mb-3">
                    <i class="glyphicon glyphicon-user text-xl mr-2"></i>
                    New Account / Balance Refill
                </p>
                <p class="text-secondary ml-8">
                    Contact <b><?= $config['adminName'] ?? 'Admin Giàu Võ' ?></b> to create a new account or refill your balance. You'll receive username/password immediately.
                </p>
            </div>

            <!-- Payment Methods -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bank Transfer -->
                <div class="p-6 md:p-8 bg-blue-500/10 border border-blue-500/30 rounded-xl">
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400 mb-6">🏦 Bank Transfer (Ting Ting)</p>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-secondary text-xs mb-1">Account Name:</p>
                            <p class="font-semibold">VO NGOC GIAU</p>
                        </div>
                        <div>
                            <p class="text-secondary text-xs mb-1">Account Number:</p>
                            <p class="bg-white/10 px-3 py-2 rounded font-mono text-sm">1440216948</p>
                        </div>
                        <div>
                            <p class="text-secondary text-xs mb-1">Bank:</p>
                            <p class="font-semibold">BIDV CN TN TpHCM</p>
                        </div>
                        <div class="pt-3 border-t border-blue-500/20">
                            <p class="text-secondary text-xs mb-2"><b>Transfer Message:</b></p>
                            <p class="bg-white/5 px-2 py-2 rounded text-xs font-mono">[Account]_[Nickname]_[Full Name]_wb</p>
                            <p class="text-secondary text-xs mt-2">Example: mvbet_Betman_Bét Man_wb</p>
                        </div>
                    </div>
                </div>

                <!-- MoMo Payment -->
                <div class="p-6 md:p-8 bg-pink-500/10 border border-pink-500/30 rounded-xl">
                    <p class="text-lg font-bold text-pink-600 dark:text-pink-400 mb-6">📱 MoMo Wallet</p>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-secondary text-xs mb-1">Account Name:</p>
                            <p class="font-semibold">Võ Ngọc Giàu</p>
                        </div>
                        <div>
                            <p class="text-secondary text-xs mb-1">MoMo Number:</p>
                            <p class="bg-white/10 px-3 py-2 rounded font-mono text-sm">0834020737</p>
                        </div>
                        <div>
                            <p class="text-secondary text-xs mb-1">MSTeams:</p>
                            <p class="font-semibold">Giàu Võ</p>
                        </div>
                        <div class="pt-3 border-t border-pink-500/20">
                            <p class="text-secondary text-xs mb-2"><b>Transfer Message:</b></p>
                            <p class="bg-white/5 px-2 py-2 rounded text-xs font-mono">[Account]_[Nickname]_[Full Name]_wb</p>
                            <p class="text-secondary text-xs mt-2">Example: mvbet_Betman_Bét Man_wb</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Schedule -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-orange-500/10 to-yellow-500/10 border-2 border-orange-500/30 rounded-lg">
                <p class="text-lg font-bold text-orange-600 dark:text-orange-400 mb-4 flex items-center gap-2">
                    <i class="glyphicon glyphicon-time"></i>
                    Payment Gateway Schedule
                </p>
                <div class="space-y-3 ml-6 text-sm">
                    <p><b class="text-orange-600 dark:text-orange-400">💳 Gateway Open:</b> 09:00 - 22:30 every day</p>
                    <p><b class="text-orange-600 dark:text-orange-400">🔄 After 22:30:</b> Processed at 09:00 next day</p>
                    <p><b class="text-orange-600 dark:text-orange-400">⛔ Processing Stopped:</b> 22:30 for 3 days before Finals</p>
                    <p class="text-secondary text-xs mt-2 ml-4">✓ Users benefit from this protection on rewards account</p>
                </div>
            </div>
        </section>

        <!-- TOURNAMENT STRUCTURE SECTION -->
        <section class="space-y-8">
            <div class="flex items-center gap-3 p-6 md:p-8 bg-gradient-to-r from-purple-500/10 to-pink-500/10 border-l-4 border-purple-500/30 rounded-lg">
                <i class="glyphicon glyphicon-flag text-2xl text-purple-500/50"></i>
                <h2 class="text-2xl md:text-3xl font-bold">TOURNAMENT STRUCTURE</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-4">⚽ GROUP STAGE</h3>
                    <ul class="space-y-2 text-sm ml-4 list-disc">
                        <li>48 teams total</li>
                        <li>12 groups (A-L)</li>
                        <li>4 teams per group</li>
                        <li>Each team plays 3 matches (round-robin)</li>
                        <li>Top 2 advance to Knockout</li>
                    </ul>
                </div>

                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-4">🏆 KNOCKOUT STAGE</h3>
                    <ul class="space-y-2 text-sm ml-4 list-disc">
                        <li>R32 (Round of 32)</li>
                        <li>R16 (Quarter-Finals)</li>
                        <li>QF (Semi-Finals)</li>
                        <li>SF (Finals)</li>
                        <li>3rd Place Match</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- TERMS & CONDITIONS -->
        <section class="space-y-8 border-t border-primary pt-8">
            <div class="flex items-center gap-3 p-6 md:p-8 bg-gradient-to-r from-red-500/10 to-pink-500/10 border-l-4 border-red-500/30 rounded-lg">
                <i class="glyphicon glyphicon-warning-sign text-2xl text-red-500/50"></i>
                <h2 class="text-2xl md:text-3xl font-bold">TERMS & RESPONSIBLE PLAY</h2>
            </div>

            <div class="space-y-4">
                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-3">✅ Important Terms</h3>
                    <ul class="space-y-2 text-sm ml-8 list-disc">
                        <li>This is an entertainment game for entertainment purposes only</li>
                        <li>Maximum 2 accounts per player</li>
                        <li>Rules are subject to change at admin discretion</li>
                        <li>All decisions are final and non-refundable</li>
                        <li>Play responsibly and within your means</li>
                    </ul>
                </div>

                <div class="p-6 bg-card border border-primary rounded-lg">
                    <h3 class="text-lg font-bold mb-3">⚠️ Responsible Gaming</h3>
                    <p class="text-sm text-secondary mb-3">
                        Remember that this is a game for fun and entertainment. Please:
                    </p>
                    <ul class="space-y-2 text-sm ml-8 list-disc">
                        <li>Set spending limits and stick to them</li>
                        <li>Never bet money you can't afford to lose</li>
                        <li>Take breaks if you feel overwhelmed</li>
                        <li>Reach out if you need support</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CLOSING SECTION -->
        <section class="py-12 md:py-16 text-center border-t border-primary">
            <h3 class="text-3xl md:text-4xl font-black mb-6 text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">
                Good Luck! 🍀
            </h3>
            <p class="text-base md:text-lg text-secondary max-w-2xl mx-auto leading-relaxed">
                Chúc toàn thể bạn có một sân chơi lành mạnh, vui vẻ và công bằng trong mùa giải World Cup 2026.
                Hãy chơi có trách nhiệm và vui vẻ!
            </p>
            <div class="mt-8 flex justify-center gap-4 text-3xl">
                ⚽ 🌍 🏆 💎 🎉
            </div>
        </section>

    </div>
</div>
