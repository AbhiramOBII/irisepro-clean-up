/**
 * Leaderboard JavaScript functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize leaderboard
    initLeaderboard();
    
    // Add event listeners for time period filters
    setupTimePeriodFilters();
});

/**
 * Initialize leaderboard functionality
 */
function initLeaderboard() {
    // Add animation classes to elements
    animateLeaderboardElements();
    
    // Setup refresh button if it exists
    const refreshBtn = document.getElementById('refreshLeaderboard');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            const currentPeriod = document.querySelector('.time-period-filter.active')?.dataset.period || '14days';
            loadLeaderboardData(currentPeriod);
        });
    }
}

/**
 * Setup time period filter buttons
 */
function setupTimePeriodFilters() {
    const filterButtons = document.querySelectorAll('.time-period-filter');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get period from data attribute
            const period = this.dataset.period;
            
            // Load data for selected period
            loadLeaderboardData(period);
        });
    });
}

/**
 * Load leaderboard data via AJAX
 */
function loadLeaderboardData(period) {
    // Show loading indicator
    showLoading();
    
    // Make API request
    fetch(`/api/mobile/leaderboard/${period}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateLeaderboardUI(data.data);
                hideLoading();
                showToast('Leaderboard updated successfully', 'success');
            } else {
                hideLoading();
                showToast(`Failed to update leaderboard: ${data.message || 'Unknown error'}`, 'error');
                console.error('Leaderboard update failed:', data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching leaderboard data:', error);
            hideLoading();
            showToast(`Error loading leaderboard data: ${error.message}`, 'error');
        });
}

/**
 * Update the leaderboard UI with new data
 */
function updateLeaderboardUI(data) {
    if (!data) {
        console.error('No data provided to updateLeaderboardUI');
        showToast('No leaderboard data available', 'error');
        return;
    }
    
    // Update top performers
    updateTopPerformers(data.top_performers || []);
    
    // Update current user stats
    updateCurrentUserStats(data.current_user || {});
    
    // Update participant list
    updateParticipantList(data.entries || []);
    
    // Update batch information if available
    if (data.current_user && data.current_user.batch_name) {
        const batchInfoElement = document.querySelector('.batch-info');
        if (batchInfoElement) {
            batchInfoElement.textContent = `Batch: ${data.current_user.batch_name}`;
        }
    }
}

/**
 * Update top performers section with real-time data
 */
function updateTopPerformers(topPerformers) {
    const topPerformersContainer = document.querySelector('.top-performers-container');
    if (!topPerformersContainer || !topPerformers || topPerformers.length === 0) return;
    
    // Default values if API data is missing
    const defaultValues = {
        1: { name: 'Arjun R.', initials: 'AR', percentage: 98 },
        2: { name: 'Vikram P.', initials: 'VP', percentage: 92 },
        3: { name: 'Priya S.', initials: 'PS', percentage: 87 }
    };
    
    // Medal styles for each position
    const medalStyles = {
        1: { podiumHeight: 'h-24', baseHeight: 24 },
        2: { podiumHeight: 'h-16', baseHeight: 16 },
        3: { podiumHeight: 'h-12', baseHeight: 12 }
    };
    
    // Update each top performer
    for (let i = 0; i < Math.min(topPerformers.length, 3); i++) {
        const performer = topPerformers[i];
        if (!performer) continue;
        
        const position = i + 1;
        
        // Find elements - using the new podium structure
        const performerElement = document.querySelector(`.top-${position}`);
        if (!performerElement) continue;
        
        // Find name and percentage elements
        const nameElement = performerElement.querySelector('p:first-of-type');
        const percentElement = performerElement.querySelector('p:nth-of-type(2)');
        
        // Find the avatar container and initials element
        const avatarContainer = performerElement.querySelector('.rounded-full');
        const initialsContainer = avatarContainer ? avatarContainer.querySelector('div') : null;
        const initialsElement = initialsContainer ? initialsContainer.querySelector('span') : null;
        
        // Update name if it exists
        if (nameElement && performer.name) {
            const nameParts = performer.name.split(' ');
            const firstName = nameParts[0] || '';
            const lastInitial = nameParts.length > 1 ? nameParts[1].charAt(0) + '.' : '';
            nameElement.textContent = `${firstName} ${lastInitial}`;
        }
        
        // Update percentage and podium height
        if (percentElement) {
            // Calculate percentage based on real-time score
            let percentage = performer.score_percentage;
            
            // If score_percentage is not available, try to calculate from raw score
            if (percentage === undefined && performer.score !== undefined && performer.max_score !== undefined && performer.max_score > 0) {
                percentage = Math.round((performer.score / performer.max_score) * 100);
            }
            
            // Use default if calculation failed
            if (percentage === undefined || isNaN(percentage)) {
                percentage = defaultValues[position].percentage;
            }
            
            // Format and display the percentage
            percentElement.textContent = `${percentage}%`;
            
            // Adjust the height of the podium bar based on percentage
            const podiumBar = performerElement.querySelector('div:last-child');
            if (podiumBar) {
                // Scale the height based on percentage (min 40%, max 100%)
                const heightScale = Math.max(0.4, Math.min(1, percentage / 100));
                const baseHeight = medalStyles[position].baseHeight;
                const scaledHeight = Math.round(baseHeight * heightScale);
                
                // Apply the new height while maintaining the responsive classes
                podiumBar.style.height = `${scaledHeight}px`;
                
                // Ensure the animation is applied
                if (!podiumBar.classList.contains('grow-animation')) {
                    podiumBar.classList.add('grow-animation');
                }
            }
        }
        
        // Update initials if profile picture is not available
        if (initialsElement && (!performer.profile_picture || performer.profile_picture === '')) {
            // Generate initials from name
            if (performer.name) {
                const nameParts = performer.name.split(' ');
                const firstInitial = nameParts[0] ? nameParts[0].charAt(0) : '';
                const secondInitial = nameParts.length > 1 ? nameParts[1].charAt(0) : '';
                initialsElement.textContent = firstInitial + secondInitial;
            } else {
                initialsElement.textContent = defaultValues[position].initials;
            }
        }
        
        // Update profile picture if available
        if (performer.profile_picture && avatarContainer) {
            // Check if we need to create or update the image
            let imgElement = avatarContainer.querySelector('img');
            const initialsDiv = avatarContainer.querySelector('div');
            
            if (!imgElement) {
                // Remove initials container if it exists
                if (initialsDiv) {
                    initialsDiv.remove();
                }
                
                // Create new image element
                imgElement = document.createElement('img');
                imgElement.className = 'w-full h-full rounded-full object-cover';
                imgElement.alt = performer.name || `${position}${getOrdinalSuffix(position)} Place`;
                avatarContainer.appendChild(imgElement);
            }
            
            // Update image source
            imgElement.src = performer.profile_picture;
        }
    }
    
    // Re-apply animations
    animateLeaderboardElements();
}

/**
 * Get ordinal suffix for a number (1st, 2nd, 3rd, etc.)
 */
function getOrdinalSuffix(num) {
    const j = num % 10;
    const k = num % 100;
    if (j === 1 && k !== 11) {
        return 'st';
    }
    if (j === 2 && k !== 12) {
        return 'nd';
    }
    if (j === 3 && k !== 13) {
        return 'rd';
    }
    return 'th';
}

/**
 * Update current user stats
 */
function updateCurrentUserStats(userData) {
    if (!userData) return;
    
    // Update overall rank
    const rankElement = document.querySelector('.user-rank');
    if (rankElement) rankElement.textContent = userData.rank;
    
    // Update rank change indicator
    const rankChangeElement = document.querySelector('.user-rank-change');
    if (rankChangeElement && userData.data) {
        const direction = userData.data.change_direction || 'none';
        const percentage = userData.data.change_percentage || 0;
        
        if (direction === 'up') {
            rankChangeElement.innerHTML = `<i class="fas fa-arrow-up text-green-500"></i> ${percentage}`;
            rankChangeElement.classList.add('text-green-500');
            rankChangeElement.classList.remove('text-red-500', 'text-gray-500');
        } else if (direction === 'down') {
            rankChangeElement.innerHTML = `<i class="fas fa-arrow-down text-red-500"></i> ${percentage}`;
            rankChangeElement.classList.add('text-red-500');
            rankChangeElement.classList.remove('text-green-500', 'text-gray-500');
        } else {
            rankChangeElement.innerHTML = `<i class="fas fa-minus text-gray-500"></i> 0`;
            rankChangeElement.classList.add('text-gray-500');
            rankChangeElement.classList.remove('text-green-500', 'text-red-500');
        }
    }
    
    // Update AACE ranks
    updateAACERanks(userData.aace_ranks);
    
    // Update streak and improvement
    const streakElement = document.querySelector('.user-streak');
    if (streakElement) streakElement.textContent = userData.streak;
    
    const improvementElement = document.querySelector('.user-improvement');
    if (improvementElement) improvementElement.textContent = userData.weekly_improvement;
}

/**
 * Update AACE component ranks
 */
function updateAACERanks(aaceRanks) {
    if (!aaceRanks) return;
    
    // Update each AACE component
    ['aptitude', 'attitude', 'communication', 'execution'].forEach(component => {
        const rankData = aaceRanks[component];
        if (!rankData) return;
        
        // Find elements
        const rankElement = document.querySelector(`.${component}-rank`);
        const changeElement = document.querySelector(`.${component}-change`);
        
        // Update rank
        if (rankElement) rankElement.textContent = rankData.rank || 'N/A';
        
        // Update change indicator
        if (changeElement) {
            const direction = rankData.change_direction || 'none';
            const value = rankData.change_value || 0;
            
            if (direction === 'up') {
                changeElement.innerHTML = `<i class="fas fa-arrow-up text-green-500"></i> ${value}`;
                changeElement.classList.add('text-green-500');
                changeElement.classList.remove('text-red-500', 'text-gray-500');
            } else if (direction === 'down') {
                changeElement.innerHTML = `<i class="fas fa-arrow-down text-red-500"></i> ${value}`;
                changeElement.classList.add('text-red-500');
                changeElement.classList.remove('text-green-500', 'text-gray-500');
            } else {
                changeElement.innerHTML = `<i class="fas fa-minus text-gray-500"></i> 0`;
                changeElement.classList.add('text-gray-500');
                changeElement.classList.remove('text-green-500', 'text-red-500');
            }
        }
    });
}

/**
 * Update participants list
 */
function updateParticipantList(entries) {
    const participantsList = document.querySelector('.participants-list');
    if (!participantsList || !entries) return;
    
    // Clear existing entries
    participantsList.innerHTML = '';
    
    // Add only participants ranked 4th and below
    entries.forEach(entry => {
        if (entry.rank > 3) {
            const participantRow = createParticipantRow(entry);
            participantsList.appendChild(participantRow);
        }
    });
}

/**
 * Create a participant row element
 */
function createParticipantRow(entry) {
    const row = document.createElement('div');
    row.className = `p-4 flex items-center ${entry.is_current_user ? 'bg-[#FFF9F5] border-l-4 border-[#FF8A3D] rounded-lg shadow-md relative overflow-hidden hover:scale-[1.01] transition-transform duration-300' : 'hover:bg-gray-50'}`;
    
    // Add decorative elements for current user
    if (entry.is_current_user) {
        row.innerHTML += `
            <div class="absolute top-0 right-0 w-20 h-20 bg-[#F58321]/5 rounded-full -mr-5 -mt-5"></div>
            <div class="absolute bottom-0 left-0 w-12 h-12 bg-[#F58321]/5 rounded-full -ml-2 -mb-2"></div>
        `;
    }
    
    // Rank column
    let rankHtml = `
        <div class="w-8 text-center relative">
            <div class="${entry.rank <= 3 ? 'font-bold text-[#FF8A3D]' : 'font-bold text-gray-500'} flex items-center justify-center">
                <span>${entry.rank}</span>
    `;
    
    // Add change indicator
    const changeDirection = entry.change_direction || 'none';
    const changePercentage = entry.change_percentage || 0;
    
    if (changeDirection === 'up') {
        rankHtml += `
            <div class="ml-1 bg-green-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center shadow-sm" title="Moved up ${changePercentage} positions">
                <span>+${changePercentage}</span>
            </div>
        `;
    } else if (changeDirection === 'down') {
        rankHtml += `<i class="fas fa-arrow-down ml-1 text-xs text-red-500"></i>`;
    } else {
        rankHtml += `<i class="fas fa-minus ml-1 text-xs text-gray-400"></i>`;
    }
    
    rankHtml += `
            </div>
        </div>
    `;
    
    // Profile picture/initials
    let profileHtml = `
        <div class="w-10 h-10 rounded-full ${entry.is_current_user ? 'bg-gradient-to-br from-[#FF8A3D] to-[#FFC107] p-0.5 shadow-md' : 'bg-gray-100'} mx-3">
    `;
    
    if (entry.profile_picture) {
        profileHtml += `<img src="${entry.profile_picture}" alt="User" class="w-full h-full rounded-full object-cover ${entry.is_current_user ? 'border-2 border-white' : ''}">`;
    } else {
        profileHtml += `
            <div class="w-full h-full rounded-full ${entry.is_current_user ? 'bg-gradient-to-br from-[#FF8A3D] to-[#FFC107]' : 'bg-gray-200'} flex items-center justify-center ${entry.is_current_user ? 'text-white' : 'text-gray-600'} font-bold">
                ${entry.initials || 'NA'}
            </div>
        `;
    }
    
    profileHtml += `</div>`;
    
    // User info
    const userName = entry.name || 'Unknown';
    const joinedDate = entry.joined_date || 'N/A';
    
    let userInfoHtml = `
        <div class="flex-1 ${entry.is_current_user ? 'relative z-10' : ''}">
            <div class="flex items-center">
                <h4 class="font-medium">${userName}</h4>
                ${entry.is_current_user ? '<span class="ml-2 bg-[#FF8A3D] text-white text-xs px-2 py-0.5 rounded-full font-medium">You</span>' : ''}
            </div>
            <div class="flex items-center">
                <span class="text-xs text-gray-500">Joined ${joinedDate}</span>
            </div>
        </div>
    `;
    
    // Score info
    const scorePercentage = entry.score_percentage || 0;
    
    let scoreHtml = `
        <div class="text-right ${entry.is_current_user ? 'relative z-10' : ''}">
            <div class="font-bold text-[#F58321] ${entry.is_current_user ? 'text-lg' : ''}">${scorePercentage}%</div>
            <div class="flex items-center justify-end text-xs ${changeDirection === 'up' ? 'text-green-500' : (changeDirection === 'down' ? 'text-red-500' : 'text-gray-500')}">
    `;
    
    // Already using changeDirection from above
    
    scoreHtml += `
                <span>${entry.change_percentage || 0}%</span>
            </div>
            ${entry.is_current_user ? '<a href="/mobile/performance" class="mt-2 text-xs text-[#FF8A3D] font-medium bg-white px-3 py-1 rounded-full shadow-sm hover:shadow-md transition-shadow border border-[#FF8A3D]/20 inline-block"><i class="fas fa-chart-line mr-1"></i> View Details</a>' : ''}
        </div>
    `;
    
    // Combine all parts
    row.innerHTML += rankHtml + profileHtml + userInfoHtml + scoreHtml;
    
    return row;
}

/**
 * Add animation classes to leaderboard elements
 */
function animateLeaderboardElements() {
    // Animate top performers with float animation
    const topPerformers = document.querySelectorAll('.top-performer');
    topPerformers.forEach((performer, index) => {
        // Make sure float-animation class is applied to the avatar container
        const avatarContainer = performer.querySelector('.relative');
        if (avatarContainer && !avatarContainer.classList.contains('float-animation')) {
            avatarContainer.classList.add('float-animation');
            avatarContainer.style.animationDelay = `${index * 0.2}s`;
        }
    });
    
    // Animate podium bars with grow animation
    const podiumBars = document.querySelectorAll('.top-performer div:last-child');
    podiumBars.forEach((bar, index) => {
        if (!bar.classList.contains('grow-animation')) {
            bar.classList.add('grow-animation');
            bar.style.animationDelay = `${0.1 + (index * 0.2)}s`;
        }
    });
    
    // Animate medal icons without bounce effect
    const medalIcons = document.querySelectorAll('.fas.fa-medal, .fas.fa-crown, .fas.fa-award');
    medalIcons.forEach((icon) => {
        const iconContainer = icon.closest('div');
        // Removed bounce animation
    });
    
    // Animate confetti elements with float effect
    const confettiElements = document.querySelectorAll('.confetti');
    confettiElements.forEach((confetti, index) => {
        if (!confetti.style.animation) {
            confetti.style.animation = `float ${2.5 + (index * 0.3)}s infinite ease-in-out`;
            confetti.style.transform = `rotate(${(index * 15) - 15}deg)`;
        }
    });
    
    // Add hover effects to top performers
    topPerformers.forEach(performer => {
        // Remove existing event listeners first to prevent duplicates
        const clone = performer.cloneNode(true);
        performer.parentNode.replaceChild(clone, performer);
        
        // Add new event listeners
        clone.addEventListener('mouseenter', function() {
            // Add a subtle scale and lift effect
            this.style.transform = 'translateY(-5px) scale(1.03)';
            
            // Find the badge and add pulse effect
            const badge = this.querySelector('[class*="badge_bg"]');
            if (badge) {
                badge.classList.add('animate-pulse');
            }
            
            // Enhance glow effect on the avatar
            const avatarBorder = this.querySelector('[class*="border-["]');
            if (avatarBorder) {
                avatarBorder.style.boxShadow = '0 0 15px currentColor';
            }
            
            // Make medal icons bounce more
            const medalIcon = this.querySelector('.fas.fa-medal, .fas.fa-crown, .fas.fa-award');
            if (medalIcon) {
                const iconContainer = medalIcon.closest('div');
                if (iconContainer) {
                    iconContainer.style.animationDuration = '0.8s';
                }
            }
        });
        
        clone.addEventListener('mouseleave', function() {
            // Remove the scale and lift effect
            this.style.transform = '';
            
            // Find the badge and remove pulse effect
            const badge = this.querySelector('[class*="badge_bg"]');
            if (badge) {
                badge.classList.remove('animate-pulse');
            }
            
            // Reset glow effect
            const avatarBorder = this.querySelector('[class*="border-["]');
            if (avatarBorder) {
                avatarBorder.style.boxShadow = '';
            }
            
            // Reset medal icon animation
            const medalIcon = this.querySelector('.fas.fa-medal, .fas.fa-crown, .fas.fa-award');
            if (medalIcon) {
                const iconContainer = medalIcon.closest('div');
                if (iconContainer) {
                    iconContainer.style.animationDuration = '';
                }
            }
        });
    });
    
    // Animate user stats cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        if (!card.classList.contains('fade-in-animation')) {
            card.classList.add('fade-in-animation');
        }
    });
}

/**
 * Show loading indicator
 */
function showLoading() {
    // Check if loading overlay exists, if not create it
    let loadingOverlay = document.getElementById('leaderboard-loading');
    
    if (!loadingOverlay) {
        loadingOverlay = document.createElement('div');
        loadingOverlay.id = 'leaderboard-loading';
        loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loadingOverlay.innerHTML = `
            <div class="bg-white p-5 rounded-lg shadow-lg flex flex-col items-center">
                <img src="/images/hour-glass.gif" alt="Loading" class="w-16 h-16">
                <p class="mt-3 font-medium text-gray-700">Updating leaderboard...</p>
            </div>
        `;
        document.body.appendChild(loadingOverlay);
    } else {
        loadingOverlay.style.display = 'flex';
    }
}

/**
 * Hide loading indicator
 */
function hideLoading() {
    const loadingOverlay = document.getElementById('leaderboard-loading');
    if (loadingOverlay) {
        loadingOverlay.style.display = 'none';
    }
}

/**
 * Show toast message
 */
function showToast(message, type = 'success') {
    // Remove any existing toasts
    const existingToast = document.getElementById('leaderboard-toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.id = 'leaderboard-toast';
    toast.className = `fixed bottom-5 left-1/2 transform -translate-x-1/2 px-4 py-2 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
    toast.innerHTML = message;
    
    // Add to document
    document.body.appendChild(toast);
    
    // Add animation
    setTimeout(() => {
        toast.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        setTimeout(() => {
            toast.remove();
        }, 500);
    }, 3000);
}
