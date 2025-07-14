// PHP Simple Project - JavaScript File

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize the application
    init();
    
    // Add smooth scrolling for anchor links
    addSmoothScrolling();
    
    // Add interactive features
    addInteractiveFeatures();
    
    // Add loading animation
    addLoadingAnimation();
});

// Main initialization function
function init() {
    console.log('PHP Simple Project initialized');
    
    // Add current year to footer
    updateFooterYear();
    
    // Add page load timestamp
    addPageLoadInfo();
}

// Add smooth scrolling functionality
function addSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Add interactive features
function addInteractiveFeatures() {
    
    // Add hover effects to sections
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        section.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Add click to copy functionality for code blocks
    const codeBlocks = document.querySelectorAll('.code');
    codeBlocks.forEach(block => {
        block.addEventListener('click', function() {
            copyToClipboard(this.textContent);
            showNotification('Code copied to clipboard!');
        });
        
        // Add cursor pointer to indicate clickable
        block.style.cursor = 'pointer';
        block.title = 'Click to copy code';
    });
    
    // Add collapsible sections (if needed)
    addCollapsibleSections();
}

// Add loading animation
function addLoadingAnimation() {
    const container = document.querySelector('.container');
    
    if (container) {
        // Add fade-in animation
        container.style.opacity = '0';
        container.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            container.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);
    }
}

// Add collapsible sections functionality
function addCollapsibleSections() {
    const sectionHeaders = document.querySelectorAll('section h2');
    
    sectionHeaders.forEach(header => {
        const section = header.parentElement;
        const content = section.querySelector('.code, .output');
        
        if (content) {
            // Add collapse/expand functionality
            header.style.cursor = 'pointer';
            header.addEventListener('click', function() {
                toggleSection(content);
            });
            
            // Add visual indicator
            header.innerHTML += ' <span class="toggle-icon">▼</span>';
        }
    });
}

// Toggle section visibility
function toggleSection(content) {
    const isVisible = content.style.display !== 'none';
    
    if (isVisible) {
        content.style.display = 'none';
        content.previousElementSibling.querySelector('.toggle-icon').textContent = '▶';
    } else {
        content.style.display = 'block';
        content.previousElementSibling.querySelector('.toggle-icon').textContent = '▼';
    }
}

// Copy text to clipboard
function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).catch(err => {
            console.error('Failed to copy text: ', err);
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }
}

// Show notification
function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    
    // Style the notification
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Update footer with current year
function updateFooterYear() {
    const footer = document.querySelector('footer p');
    if (footer) {
        const currentYear = new Date().getFullYear();
        footer.innerHTML = footer.innerHTML.replace('2024', currentYear);
    }
}

// Add page load information
function addPageLoadInfo() {
    const loadTime = performance.now();
    const loadInfo = document.createElement('div');
    loadInfo.style.cssText = `
        position: fixed;
        bottom: 10px;
        left: 10px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        z-index: 1000;
    `;
    loadInfo.textContent = `Load time: ${loadTime.toFixed(2)}ms`;
    
    document.body.appendChild(loadInfo);
    
    // Remove after 5 seconds
    setTimeout(() => {
        if (loadInfo.parentNode) {
            loadInfo.parentNode.removeChild(loadInfo);
        }
    }, 5000);
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + K to focus on search (if we add search functionality)
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        console.log('Search shortcut pressed');
    }
    
    // Escape key to close any open modals or notifications
    if (e.key === 'Escape') {
        const notifications = document.querySelectorAll('.notification');
        notifications.forEach(notification => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        });
    }
});

// Add scroll to top functionality
function addScrollToTop() {
    const scrollButton = document.createElement('button');
    scrollButton.innerHTML = '↑';
    scrollButton.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #667eea;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
    `;
    
    document.body.appendChild(scrollButton);
    
    // Show/hide based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollButton.style.opacity = '1';
            scrollButton.style.visibility = 'visible';
        } else {
            scrollButton.style.opacity = '0';
            scrollButton.style.visibility = 'hidden';
        }
    });
    
    // Scroll to top on click
    scrollButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Hover effects
    scrollButton.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
        this.style.background = '#5a6fd8';
    });
    
    scrollButton.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.background = '#667eea';
    });
}

// Initialize scroll to top button
addScrollToTop(); 